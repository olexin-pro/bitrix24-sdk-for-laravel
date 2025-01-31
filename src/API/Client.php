<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\API;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class Client
{
    /**
     * Send an ApiRequest to the API and return the response.
     */
    public function send(ApiRequest $request): Response
    {
        return $this->getBaseRequest()
            ->withHeaders($request->getHeaders())
            ->{$request->getMethod()->value}(
                $request->getUri(),
                $request->getMethod() === HttpMethod::GET
                    ? $request->getQuery()
                    : $request->getBody()
            );
    }

    /**
     * Get a base request for the API.
     * This method has some helpful defaults for API requests.
     * The base request is a PendingRequest with JSON acceptance, a content type
     * of 'application/json', and the base URL for the API.
     * It also throws exceptions for non-successful responses.
     */
    protected function getBaseRequest(): PendingRequest
    {
        $request = Http::acceptJson()
            //->withMiddleware() // todo: configured
            ->contentType('application/json')
            ->throw()
            ->baseUrl($this->baseUrl());

        return $this->authorize($request);
    }

    /**
     * Get the base URL for the API.
     * This method must be implemented by subclasses to provide the base URL for
     * the API.
     */
    abstract protected function baseUrl(): string;

    /**
     * Authorize a request for the API.
     * This method is intended to be overridden by subclasses to provide
     * API-specific authorization.
     * By default, it simply returns the given request.
     */
    protected function authorize(PendingRequest $request): PendingRequest
    {
        return $request;
    }
}
