#!/bin/sh
set -e

# Attendre que MySQL soit prêt avant de migrer
echo "Attente de la base de données..."
until php artisan db:monitor > /dev/null 2>&1; do
  sleep 1
done

echo "Exécution des migrations..."
php artisan migrate --force

# Lancer la commande principale du Dockerfile (CMD)
exec "$@"
