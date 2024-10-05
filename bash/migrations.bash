#!/bin/bash
#Ce fichier permet de drop et rebase la DB rapidement (à partir des fichier '/migrations/sql-dump.sql' et '/migrations/VersionYYYYMMDDHHMMSS'
echo "Drop de la DB :"
php bin/console doctrine:migrations:execute DoctrineMigrations\\Version20241005103343 --down --no-interaction

echo "Up de la DB :"
php bin/console doctrine:migrations:execute DoctrineMigrations\\Version20241005103343 --up --no-interaction