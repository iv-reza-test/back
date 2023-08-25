# if tests completely passed means everything work well

copy (.env.example) => .env

1) create two databases 

iv for user side

iv_test for test backend

2) run the test

```
php artisan test
```
if worked means everything is working

3) run migration
```
php artisan migrate
```

4) fill your database via factories

```
php artisan db:seed
```

# Thanks
