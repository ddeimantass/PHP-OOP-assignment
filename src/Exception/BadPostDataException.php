<?php

declare(strict_types=1);

namespace App\Exception;

class BadPostDataException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Bad post response data');
    }
}