<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;

class CustomMissingScopeException extends AuthorizationException
{
    public function __construct($scopes)
    {
        $scopes = is_array($scopes) ? implode(', ', $scopes) : $scopes;

        parent::__construct("You are missing the required scope(s): {$scopes}.");
    }
}
