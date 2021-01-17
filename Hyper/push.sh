cd api

vendor/bin/phpunit

vendor/bin/phpcbf --standard=PSR2 app
vendor/bin/phpcs --standard=PSR2 app

git add .

git commit -m "PSR2 Fixes"

git push