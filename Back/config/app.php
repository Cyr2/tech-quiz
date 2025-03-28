<?php

return [

    /*
    |--------------------------------------------------------------------------
    | NOM DE L'APPLICATION
    |--------------------------------------------------------------------------
    |
    | Ce nom est utilisé par l'application pour identifier l'application
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | ENVIRONNEMENT DE L'APPLICATION
    |--------------------------------------------------------------------------
    |
    | Cette valeur détermine l'environnement dans lequel 
    | l'application est actuellement en cours d'exécution.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | MODE DE DEBBUG DE L'APPLICATION
    |--------------------------------------------------------------------------
    |
    | Lorsque votre application est en mode débogage,
    | des messages d'erreur détaillés avec des traces de pile s'affichent
    | pour chaque erreur survenue dans votre application. 
    | Si cette option est désactivée, une simple page d'erreur générique s'affiche.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | URL DE L'APPLICATION
    |--------------------------------------------------------------------------
    |
    | Cette URL est utilisée par la console pour générer correctement 
    | les URL lors de l'utilisation de l'outil de ligne de commande Artisan. 
    | Vous devez la définir à la racine de l'application 
    | afin qu'elle soit disponible dans les commandes Artisan.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | FUSEAU HORAIRE DE L'APPLICATION
    |--------------------------------------------------------------------------
    |
    | Vous pouvez spécifier ici le fuseau horaire par défaut de votre application, 
    | qui sera utilisé par les fonctions PHP date et date-heure. 
    | Le fuseau horaire est défini par défaut sur « UTC », 
    | car il convient à la plupart des cas d'utilisation.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by Laravel's translation / localization methods. This option can be
    | set to any locale for which you plan to have translation strings.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | CLÉ DE CHIFFREMENT DE L'APPLICATION
    |--------------------------------------------------------------------------
    |
    | Cette clé est utilisée par les services de chiffrement de Laravel 
    | et doit être définie sur une chaîne aléatoire de 32 caractères 
    | pour garantir la sécurité de toutes les valeurs chiffrées. 
    | Cette opération doit être effectuée avant le déploiement de l'application.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | PILOTE DU MODE MAINTENANCE
    |--------------------------------------------------------------------------
    |
    | Ces options de configuration déterminent le pilote utilisé 
    | pour déterminer et gérer l'état du « mode maintenance » de Laravel. 
    | Le pilote « cache » permettra de contrôler le mode maintenance sur plusieurs machines.
    |
    | Drivers supportés: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];
