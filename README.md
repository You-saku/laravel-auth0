# laravel-auth0
auth0を触るためのサンプル

# Setup
```
前提
phpとcomposerをlocalでダウンロード済み
php = 8.1.7
composer = 2.3.7
```

1. git clone
2. docker-compose up -d --build
3. php artisan migrate
4. php artisan serve


# Tips
## laravel

## postgres
### DB接続
docker-compose exec postgres psql -U user -d develop
