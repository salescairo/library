## Sobre a plataforma

Library é uma plataforma gestora de livros.


## Instalação
1. Copy .env.exemple to .env file
2. Verify ``USER_EMAIL_DEFAULT`` and ``USER_PASSWORD_DEFAULT`` to .env
3. Execute:
``` 
docker-compose up
docker-compose exec app composer install 
docker-compose exec app npm install 
docker-compose exec app npm run build 
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate --seed
```