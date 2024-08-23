#!/bin/bash
#Ce fichier permet de mettre toute les dépendance à jour sur le web host uniquement
echo "Mise à jour des dépendance via GIT :"
git pull

echo "Mise à jour des dépendance via COMPOSER :"
php composer.phar install --no-dev --optimize-autoloader

echo "Clear du cache en mémoire ..."
APP_ENV=prod APP_DEBUG=0 php bin/console cache:clear

echo "Mise à jour des dépendance via IMPORTMAP ..."
php bin/console importmap:install

echo "Compilation des assets ..."
php bin/console asset-map:compile

echo "Instalation des dépendance terminée"
