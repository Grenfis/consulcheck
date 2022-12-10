<?php

namespace app\controllers;

use Klein\Request;
use Klein\Response;

class Controller
{
    private Request $request;
    private Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->response = $response;
        $this->request = $request;
    }

    public function request(): Request
    {
        return $this->request;
    }

    public function response(): Response
    {
        return $this->response;
    }

    public function isPOST(): bool
    {
        return $this->request->method('POST');
    }

    public function isGET(): bool
    {
        return $this->request->method('GET');
    }
}