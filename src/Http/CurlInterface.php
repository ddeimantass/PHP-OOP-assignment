<?php

declare(strict_types=1);

namespace App\Http;

interface CurlInterface
{
    public function sendRequest(array $data = [], string $method = 'GET'): string;

    public function setUrl(string $url): void;
}