<?php

namespace App\Http;

use App\Exceptions\ApiError;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Log\Writer;

class OAuth
{
    const LEVEL_NONE = 'none';
    const LEVEL_MEMBER = 'lid';
    const LEVEL_BOARD = 'bestuur';

    private $accessToken;
    private $token;
    private $guzzle;
    private $request;
    private $log;

    public function __construct(Client $guzzle, Request $request, Writer $log)
    {
        $this->guzzle = $guzzle;
        $this->request = $request;
        $this->log = $log;
    }

    /**
     * Ensures a valid token
     * @throws ApiError when the token has expired
     */
    public function mustBeFresh()
    {
        if (!$this->token) {
            $this->getFullToken();
        }

        // Sanity check that the token actually expires
        if (empty($this->token->expires)) {
            throw new ApiError(400, 'oauth_token_invalid',
                                    'Your token is invalid: tokens must have an expires value');
        }

        if (Carbon::now() > new Carbon($this->token->expires)) {
            throw new ApiError(400, 'oauth_token_expired', 'Your token has expired');
        }
    }

    /**
     * Whether the token has board level authorisation
     * @throws ApiError
     */
    public function mustBeBoard()
    {
        $this->mustBeFresh();

        if (!$this->isLevel(self::LEVEL_BOARD)) {
            throw new ApiError(403, 'oauth_insufficient_authorization',
                                    'You must be a board member to do this');
        }
    }

    /**
     * Whether the token has member level authorisatino
     * @throws ApiError
     */
    public function mustBeMember()
    {
        $this->mustBeFresh();
        if (!$this->isLevel(self::LEVEL_MEMBER) || !$this->isLevel(self::LEVEL_BOARD)) {
            throw new ApiError(403, 'oauth_insufficient_authorization',
                                    'You must be a (board) member to do this');
        }
    }

    /**
     * Whether the token is a specific level
     * @param  string  $level
     * @throws ApiError
     */
    private function isLevel($level)
    {
        return $this->getResource($level)->getStatusCode() === '200';
    }

    /**
     * Parse the Authorization header
     * @throws ApiError when the header is missing or malformed
     */
    private function parseHeader()
    {
        $authorization = $this->request->header('Authorization', null);

        if ($authorization === null) {
            throw new ApiError(400, 'oauth_header_missing',
                                    'Must send an Authorization header');
        }

        $parts = explode(" ", $authorization);
        if (sizeof($parts) !== 2 || $parts[0] !==  'Token') {
            throw new ApiError(400, 'oauth_header_wrong',
                'Authorization header must start with Token and a space, followed by a valid token');
        }

        $this->accessToken = $parts[1];
    }

    /**
     * Download the full access token details from the authorization server
     * @throws ApiError when the token request fails
     */
    private function getFullToken()
    {
        $this->parseHeader();
        $response = $this->getResource('resource');
        $this->token = json_decode((string) $response->getBody());
    }

    /**
     * Get a resource from the authorization server
     * @param  string $resource
     * @throws ApiError when the authorization server is unreachable
     * @return GuzzleHttp\Psr7\Response
     */
    private function getResource($resource)
    {
        try {
            return $this->guzzle->request('GET', env('OAUTH_AUTHORIZATION') . $resource, [
                'query' => ['access_token' => $this->accessToken],
                'timeout' => 2,
            ]);
        } catch(RequestException $e) {
            $this->log->error('Cannot retrieve OAuth data', [
                'request' => (string) $e->getRequest()->getBody(),
                'response' => ($e->hasResponse() ? (string) $e->getResponse()->getBody() : 'none'),
            ]);
        } catch (GuzzleException $e) {
            $this->log->error('Cannot retrieve OAuth data', [
                'request' => 'error in transferring request',
                'response' => 'none',
            ]);
        }

        throw new ApiError(502, 'oauth_authorization_unreachable',
                                'Cannot contact the authorization server');
    }
}
