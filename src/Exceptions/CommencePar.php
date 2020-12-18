<?php

namespace Ccleaner\Exceptions;

class CommencePar
{
    public function __invoke($message, string $parametre): bool
    {
        $lengthToCheck = strlen($parametre);
        if (
            strtolower(
                substr($message->content, 0, $lengthToCheck)
            ) == strtolower($parametre)
        ) {
            return true;
        } else {
            return false;
        }
    }
}
