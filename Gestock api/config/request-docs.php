<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Request Docs Configuration
    |--------------------------------------------------------------------------
    |
    | Ce fichier est pour configurer les paramètres du package Laravel Request Docs.
    |
    */

    // Activer ou désactiver la génération de documentation des requêtes
    'enabled' => env('REQUEST_DOCS_ENABLED', true),

    // Chemin d'accès aux documents des requêtes
    'path' => env('REQUEST_DOCS_PATH', 'request-docs'),

    // Middleware appliqués à la route d'accès aux documents des requêtes
    'middleware' => ['web'],

    // Liste des contrôleurs à exclure de la documentation
    'except_controllers' => [],

    // Configuration pour le stockage des fichiers de documentation
    'storage' => [
        'enabled' => env('REQUEST_DOCS_STORAGE_ENABLED', false),
        'disk' => env('REQUEST_DOCS_STORAGE_DISK', 'local'),
    ],

    // Autres configurations possibles...
    'docs' => [
        // Par exemple, spécifier les types de requêtes à inclure dans la documentation
        'include' => ['GET', 'POST', 'PUT', 'DELETE'],
    ],

    // Configuration de la personnalisation de la documentation
    'customization' => [
        'title' => 'Documentation des Requêtes API',
        'description' => 'Ceci est la documentation des requêtes pour notre API.',
    ],
];
