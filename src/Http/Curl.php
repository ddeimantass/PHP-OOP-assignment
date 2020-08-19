<?php

declare(strict_types=1);

namespace App\Http;

class Curl implements CurlInterface
{
    private string $url;

    /**
     * @param array $data
     * @param string $method
     * @return string
     */
    public function sendRequest(array $data = [], string $method = 'GET'): string
    {
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ('POST' === $method) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        $response = curl_exec($ch);
        $error    = curl_error($ch);
        $errno    = curl_errno($ch);

        if (is_resource($ch)) {
            curl_close($ch);
        }

        if (0 !== $errno) {
            throw new \RuntimeException($error, $errno);
        }

        return $response;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}
