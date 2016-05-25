<?php

return [
    'requirements' => [
        'slug' => 'requirements',
        'title' => 'Wymagania',
        'breadcrumb' => '<i class="fa fa-server"></i>',
        'description' => 'Sprawdzenie konfiguracji serwera',
        'view' => [
            'php_version' => 'PHP w wersji co najmniej :ver',
            'php_extension' => 'PHP ma aktywne rozszerzenie: :name',
        ],
    ],

    'folders' => [
        'slug' => 'folders',
        'title' => 'Dostęp do folderów',
        'breadcrumb' => '<i class="fa fa-folder"></i>',
        'description' => 'Sprawdzenie dostępu do folderów aplikacji',
        'view' => [
            'granted' => 'Folder <code class="text-success">:path</code> ma uprawnienia <code class="text-success">:perm</code>',
            'missing' => 'Folder <code class="text-danger">:path</code> ma uprawnienia <code class="text-danger">:perm_actual</code> zamiast <code class="text-danger">:perm</code>',
        ],
    ],

    'env' => [
        'slug' => 'env',
        'title' => 'Plik env',
        'breadcrumb' => '<i class="fa fa-file-o"></i>',
        'description' => 'Główna konfiguracja serwera',
        'errors' => [
            'cannot_write_file' => 'Nie udało się zapisać pliku .env. Proszę sprawdzić uprawnienia',
            'cannot_backup_file' => 'Nie udało się odtworzyć kopii zapasowej pliku .env, z pliku .env.backup',
        ],
        'view' => [
            'help_text' => 'Tworzenie wymaganego pliku konfiguracyjnego <code>.env</code> do konfiguracji bazy danych, wysyłania wiadomości, itd. Jeśli masz plik <code>.env.example</code>, będzie on użyty jako szablon'
        ],
    ],

    'database' => [
        'slug' => 'database',
        'title' => 'Baza danych',
        'breadcrumb' => '<i class="fa fa-database"></i>',
        'description' => 'Instalacja tabel i inicjowanie danych',
        'view' => [
            'refresh_db' => 'Zamiana schematu bazy danych z użyciem <code>artisan migrate:refresh</code> <em>(w innym przypadku baza danych zostanie zaktualizowana z użyciem <code>artisan migrate</code>)</em>',
            'enable_seeding' => 'Wysłanie danych do tabel w bazie danych z użyciem komendy<code>artisan db:seed</code>',
        ],
    ],

    'final' => [
        'slug' => 'congratulations',
        'title' => 'Gratulacje',
        'breadcrumb' => '<i class="fa fa-child"></i>',
        'description' => 'Instalacja zakończona',
        'view' => [
            'ready_to_go' => 'Aplikacja jest poprawnie skonfigurowana. Można w pełni korzystać z aplikcaji. Powodzenia!',
        ],
    ],
];