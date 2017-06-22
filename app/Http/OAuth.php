<?php

namespace App\Http;

use App\Exceptions\ApiError;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OAuth
{
    const LEVEL_NONE = 'none';
    const LEVEL_MEMBER = 'bekend';
    const LEVEL_BOARD = 'bestuur';

    private $accessToken;
    private $token;
    private $guzzle;
    private $request;

    public function __construct(Client $guzzle, Request $request)
    {
        $this->guzzle = $guzzle;
        $this->request = $request;
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
            throw new ApiError(
                400,
                'oauth_token_invalid',
                'Your token is invalid: tokens must have an expires value'
            );
        }

        if (Carbon::now() > new Carbon($this->token->expires)) {
            throw new ApiError(401, 'oauth_token_expired', 'Your token has expired');
        }
    }

    /**
     * Whether the token has board level authorisation
     * @return boolean
     */
    public function isBoard()
    {
        $this->mustBeFresh();
        return $this->isLevel(self::LEVEL_BOARD);
    }

    /**
     * Whether the token has member level authorisatino
     * @return boolean
     */
    public function isMember()
    {
        $this->mustBeFresh();
        return $this->isLevel(self::LEVEL_MEMBER);
    }

    /**
     * The user of the current token
     * @return App\Models\User
     */
    public function user()
    {
        $this->mustBeFresh();
        return \App\Models\User::where('username', $this->token->user_id)->first();
    }

    /**
     * Whether the token is a specific level
     * @param  string  $level
     * @return boolean
     */
    private function isLevel($level)
    {
        try {
            return $this->getResource($level)->getStatusCode() === 200;
        } catch (BadResponseException $e) {
        } catch (TransferException $e) {
            Log::error('Cannot retrieve OAuth data', [
                'request' => (string) $e->getRequest()->getBody(),
                'response' => ($e->hasResponse() ? (string) $e->getResponse()->getBody() : 'none'),
            ]);
        }

        return false;
    }

    /**
     * Parse the Authorization header
     * @throws ApiError when the header is missing or malformed
     */
    private function parseHeader()
    {
        $authorization = $this->request->header('Authorization', null);

        if ($authorization === null) {
            throw new ApiError(
                401,
                'oauth_header_missing',
                'Must send an Authorization header'
            );
        }

        $parts = explode(" ", $authorization);
        if (sizeof($parts) !== 2 || $parts[0] !==  'Token') {
            throw new ApiError(
                400,
                'oauth_header_wrong',
                'Authorization header must start with Token and a space, followed by a valid token'
            );
        }

        $this->accessToken = $parts[1];
    }

    /**
     * Download the full access token details from the authorization server
     * @throws ApiError when the token request fails
     */
    private function getFullToken()
    {
        try {
            $this->parseHeader();
            $response = $this->getResource('resource');
            $this->token = json_decode((string) $response->getBody());
        } catch (BadResponseException $e) {
            if ($e->hasResponse()) {
                $body = json_decode((string) $e->getResponse()->getBody());
                if ($body->error === 'expired_token') {
                    throw new ApiError(401, 'oauth_token_expired', 'Your token has expired');
                } else {
                    throw new ApiError(400, 'oauth_token_invalid', 'Your token is invalid');
                }
            }

            throw new ApiError(
                502,
                'oauth_authorization_server_wrong',
                'Your token produced an invalid response from the OAuth Authorization server'
            );
        } catch (TransferException $e) {
            Log::error('Cannot retrieve OAuth data', [
                'request' => (string) $e->getRequest()->getBody(),
                'response' => ($e->hasResponse() ? (string) $e->getResponse()->getBody() : 'none'),
            ]);

            throw new ApiError(
                502,
                'oauth_authorization_server_wrong',
                'Your token produced an invalid response from the OAuth Authorization server'
            );
        }
    }

    /**
     * Get a resource from the authorization server
     * @param  string $resource
     * @throws TransferException
     * @return GuzzleHttp\Psr7\Response
     */
    private function getResource($resource)
    {
        return $this->guzzle->request('GET', env('OAUTH_AUTHORIZATION') . $resource, [
            'query' => ['access_token' => $this->accessToken],
            'timeout' => 2,
        ]);
    }
}
