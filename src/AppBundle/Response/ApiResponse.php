<?php

namespace AppBundle\Response;

class ApiResponse
{
    /** @var bool */
    private $status;
    private $data;
    /** @var string */
    private $errorKey;

    public function __construct(bool $status = true, $data = null, string $errorKey = '')
    {
        $this->status = $status;
        $this->data = $data;
        $this->errorKey = $errorKey;
    }

    public function getFormattedResponse(): array
    {
        $formattedResponse = [];
        $formattedResponse['status'] = $this->status ? 'success' : 'error';
        if (null !== $this->data) {
            $formattedResponse['data'] = $this->data;
        }
        if (!empty($this->errorKey)) {
            $formattedResponse['error_key'] = $this->errorKey;
        }
        return $formattedResponse;
    }
}
