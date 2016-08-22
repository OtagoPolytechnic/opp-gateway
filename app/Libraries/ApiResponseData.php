<?php

namespace App\Libraries;

/**
 * API Response class
 * 
 * Helps us keep all our API responses in the same format
 */
class ApiResponseData
{
    private $response = [
        'success'   => true,
        'messages'  => [],
        'data'      => [],
    ];

    /**
     * The request failed
     */
    public function failed()
    {
        $this->response['success'] = false;
    }
    
    /**
     * Add a message to the response (eg. Permissions denied)
     */
    public function addMessage($message)
    {
        $this->response['messages'][] = $message;
    }

    /**
     * Add data to the response array
     */
    public function addData($key, $data)
    {
        $this->response['data'][$key] = $data;
    }

    /**
     * Get the response
     */
    public function get()
    {
        return $this->response;
    }
}
