<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Firebase Credentials
    |--------------------------------------------------------------------------
    |
    | The file containing the service account credentials for your Firebase
    | project. Use the absolute path or the path relative to the base path.
    |
    */

    'credentials' => [
        'file' => env('FIREBASE_CREDENTIALS', storage_path('app/service.json')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Firebase Database URL
    |--------------------------------------------------------------------------
    |
    | The URL for the Firebase database. This should match the database URL
    | provided in your Firebase project's settings.
    |
    */

    'database' => [
        'url' => env('FIREBASE_DATABASE_URL'),
    ],
];
