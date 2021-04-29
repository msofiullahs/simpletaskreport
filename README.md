<p align="center"><a href="https://sofiullah.my.id/" target="_blank"><img src="https://task.sofiullah.my.id/public/favicon/apple-touch-icon.png" width="100"></a></p>

<p align="center">Build with Laravel 8</p>

## About SimpleTaskReport

SimpleTaskReport is a **free** web application that supports you especially for remote workers to make a daily task report and manage task request. You can invite your co-workers to join your SimpleTaskReport.

## Instalation

```bash 
$ cd /your-project-dir
```

```git 
$ git clone git@gitlab.com:sofiullah.work/simple-task.git
# or
$ git clone https://gitlab.com/sofiullah.work/simple-task.git
```

```bash 
$ composer install
```

```bash 
$ cp .env.example .env
```

Set your database and SMTP email on ```.env``` file

```nginx
$ php artisan key:generate
```

```nginx
$ php artisan migrate --seed
```

## Calendar Setting

- Go to google calendar iframe generator [here](https://calendar.google.com/calendar/embedhelper)
- Replace the iframe embed code on ```resources > views > calendar.blade.php```


## License

The SimpleTaskReport is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Contact
[me@sofiullah.my.id](mailto:me@sofiullah.my.id)
