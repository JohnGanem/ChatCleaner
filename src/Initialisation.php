<?php

namespace Ccleaner;

use Ccleaner\Actions\Supprimer;
use Discord\Discord;
use Discord\Parts\User\Activity;

class Initialisation
{
    private $discord;

    private $activityType;
    private $activityName;

    private $configurationArray;

    public function __construct()
    {
        $this->discord = new Discord([
            'token' => $_ENV['BOT_TOKEN'],
        ]);
        $this->activityType = $_ENV['ACTIVITY_TYPE'];
        $this->activityName = $_ENV['ACTIVITY_NAME'];

        $string = file_get_contents(__DIR__ . "/../config.json");
        $this->configurationArray = json_decode($string, true);
    }

    public function __invoke(): void
    {
        $this->discord->on('ready', function ($discord) {
            $this->updatePresence();

            $this->discord->on('message', function ($message, $discord) {
                $channelConfiguration = $this->findChannelConfiguration($message->channel_id);

                if (!is_null($channelConfiguration)) {
                    $this->callAction($channelConfiguration, $message);
                }
            });
        });

        $this->discord->run();
    }

    private function updatePresence(): void
    {
        $activity = $this->discord->factory(Activity::class, [
            'type' => (int) $this->activityType,
            'name' => $this->activityName
        ]);
        $this->discord->updatePresence($activity);
    }

    private function findChannelConfiguration(int $channel): ?array
    {
        foreach ($this->configurationArray as $configuration) {
            if ($configuration['channel'] == $channel) {
                return $configuration;
            }
        }
        return null;
    }

    private function callAction(array $configuration, $message): void
    {
        $exceptions = (!empty($configuration['exceptions'])) ? $configuration['exceptions'] : null;

        if ($configuration['action'] == "supprimer") {
            (new Supprimer)($message, $exceptions);
        }
    }
}
