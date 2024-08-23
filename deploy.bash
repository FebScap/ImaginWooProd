#!/bin/bash
#Ce fichier permet de déployer le projet sur un WEBHOST
echo "Instalation de COMPOSER :"
curl -sS https://getcomposer.org/installer | php

echo "Check Requirements :"
php composer.phar require symfony/requirements-checker
php composer.phar require symfony/apache-pack


echo "Configure your Environment Variables :"
php composer.phar dump-env prod

echo "Mise à jour des dépendances :"
bash remoteinstall.bash

echo "Deploy terminée"
