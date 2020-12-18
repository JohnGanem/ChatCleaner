# ChatCleaner

## Installation :
``` composer install ```

## Paramétrage
copier le .env.example en .env et y renseigner le bot Token trouvable ici : [Discord](https://discord.com/developers/applications), cliquez sur votre application et dans l'onglet bot cliquez sur "Click to Reveal Token".

## Configuration
Le fichier config.json doit être configurer avec les channels que vous souhaitez écouter, les actions à y mener et les exceptions possibles à chaque action.

Le format est le suivant :
```
[
    {
        "channel": "channel_id",
        "action": "supprimer",
        "exceptions": [
            {
                "type": "commence par",
                "parametre": "WTB"
            }
        ]
    },
    {
        ...
    }
]
```

Le channel id est trouvable en cliquant droit sur un channel et en cliquant sur "Copier l'identifiant".

Les différentes actions possibles sont les suivantes :
- supprimer

Les différentes exceptions possibles sont les suivantes (avec leurs paramètres) :
- commence par, 1 paramètre

## Lancement
Lancez à la racine du projet la commande ```php ccleaner.php``` et laisser le bot tourner.
Vous pouvez aussi paramétrer un cron pour relancer automatiquement cette commande au redémarrage de la machine.