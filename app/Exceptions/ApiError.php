<?php

namespace App\Exceptions;

class ApiError extends \Exception
{
    protected $errorId;
    private $description;
    private $httpStatus;

    public function __construct($httpStatus, $errorId, $description)
    {
        parent::__construct($errorId, 0, null);

        $this->errorId = $errorId;
        $this->description = $description;
        $this->httpStatus = $httpStatus;
    }

    public function format()
    {
        return [
            'errors' => [
                'code' => $this->errorId,
                'description' => $this->description,
                'href' => env('ERROR_DOCS_URL') . $this->errorId,
            ],
        ];
    }

    public function httpStatus()
    {
        return (string) $this->httpStatus;
    }

    public function __toString()
    {
        return "{$this->httpStatus} {$this->errorId}: {$this->description}";
    }
}
