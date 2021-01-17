cd docker

docker-compose up -d

docker-compose exec php composer install

docker-compose exec php php artisan migrate