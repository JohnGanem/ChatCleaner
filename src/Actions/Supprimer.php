<?php

namespace Ccleaner\Actions;

use Ccleaner\Exceptions\CommencePar;

class Supprimer
{
    public function __invoke($message, ?array $exceptions): void
    {
        $shouldDelete = true;
        foreach ($exceptions as $exception) {
            if ($exception['type'] == "commence par") {
                $shouldDelete = !(new CommencePar)($message, $exception['parametre']);
            }
            if ($shouldDelete == false) {
                break;
            }
        }

        if ($shouldDelete) {
            $message->channel->messages->delete($message);
        }
    }
}
