## install
pleace copy from .env.example to .env
```
copy .env.example .env
```
and change this var
```
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
so write this command in command line
```
docker-compose up -d

docker exec -it test-snapp-food-laravel.test-1 composer install

./vendor/bin/sail php artisan migrate --seed
```
after that you must import file [snapp food.postman_collection.json](snapp%20food.postman_collection.json) in postman

now you can use from this



## توضیحات

با سلام این پروژه با استفاده از داکر اجرا شده و به سادگی قابل اجراست سعی شده که بیشتر از فایل pdf چیزی در دیا بیس و کد اسفاده نکنم به جز مواردی که باعث بهتر شده یا زیبا شدن کار بشه چند سرویس اضافی برای فراخوانی ایندکس ها در پستمن قرار دادم برای راحتی کار به همراه اون سه سرویس اصلی که در pdf موجود بود تمام موادر اعتبار سنجی در ولیدیشن ها انجام شده و در قسمت های مختلف اررور هندلر قرار داده شده 
