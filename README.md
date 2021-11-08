
## News API

### Установка

```shell
git clone https://github.com/bak-ja/news-service.git
docker-compose up -d
docker-compose exec php-cli composer install
docker-compose exec php-cli cp .env.example .env
docker-compose exec php-cli php artisan key:generate
docker-compose exec php-cli php artisan migrate
docker-compose exec php-cli  vendor/bin/phpunit

http://localhost:8080/api/documentation

```
