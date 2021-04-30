#Setup Project

composer install

npm install

php artisan key:generate

composer require munafio/chatify

php artisan vendor:publish --tag=chatify-migrations

php artisan migrate
php artisan db:seed

php artisan storage:link

#####if want
php artisan migrate:refresh --seed


###after composer install use command composer "require munafio/chatify"




