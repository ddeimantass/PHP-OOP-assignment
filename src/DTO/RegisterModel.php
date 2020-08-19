<?php

declare(strict_types=1);

namespace App\DTO;

class RegisterModel
{
    private string $token;
    private string $clientId;
    private string $email;

    /**
     * @param string $token
     * @param string $clientId
     * @param string $email
     */
    public function __construct(string $token, string $clientId, string $email)
    {
        $this->token = $token;
        $this->clientId = $clientId;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
