# Laravel Blog

To instal configure a Virtual host like any Laravel project

Configure the .env file to connect the database

run 


```artisan migrate```

to install the tables


run 

```
artisan db:seed --class Tags
artisan db:seed --class Sections
artisan db:seed --class PostsSeed
```


