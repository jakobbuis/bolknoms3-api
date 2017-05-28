<?php

namespace App\Exceptions;

class ApiError extends \Exception
{
    protected $code;
    private $description;
    private $httpStatus;

    public function __construct($httpStatus, $code, $description)
    {
        parent::__construct($code, $httpStatus, null);

        $this->code = $code;
        $this->description = $description;
        $this->httpStatus = $httpStatus;
    }

    public function format()
    {
        return [
            'errors' => [
                'code' => $this->code,
                'description' => $this->description,
                'href' => env('ERROR_DOCS_URL') . $this->code,
            ],
        ];
    }

    public function httpStatus()
    {
        return (string) $this->httpStatus;
    }

    public function __toString()
    {
        return "{$this->httpStatus} {$this->code}: {$this->description}";
    }
}
