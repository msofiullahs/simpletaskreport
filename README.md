<center><a href="https://sofiullah.my.id/" target="_blank"><img src="https://task.sofiullah.my.id/public/favicon/apple-touch-icon.png" width="100"></a></center>

<center>
Build with <strong style="color:#ff2d20">Laravel 8</strong> and <strong style="color:#7C11F8">Bootstrap 5</strong>
</center>

## About SimpleTaskReport
SimpleTaskReport is a **free** web application that supports you especially for remote workers to make a daily task report and manage task request. You can invite your co-workers to join your SimpleTaskReport.

### Requirements
- PHP >= 7.3
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- jQuery DataTables v1.10.x

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

```bash
$ php artisan key:generate
```

```bash
$ php artisan migrate --seed
```

### Calendar Setting
- Go to google calendar iframe generator [here](https://calendar.google.com/calendar/embedhelper)
- Replace the iframe embed code on [resources > views > calendar.blade.php](/resources/views/calendar.blade.php)


## License
The SimpleTaskReport is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

### Contact
[me@sofiullah.my.id](mailto:me@sofiullah.my.id)
