Introduction
------------

Aplikasi ini dibuat dari proker para anggora DPM FRS UTS

Features
--------

- Crud Kandidat
- Crud Pemilih
- Crud User
- Crud Token
- Chart
- Datatable Server Side
- dll

Requirements
--------

- PHP 7.2 keatas
- Composer

Setup
--------

*1.* Clone repo ini

```bash
git clone https://github.com/rizkyadiryanto14/dpmfrsuts-project
```

*2.* Buka directory project dengan terminal dan jalankan composer install
```bash
composer install
```

*3.* import database yang ada di root project

*4.* set .env

Buat file .env di root project dan copy semua yang ada di file env kemudian ubah `CI_ENVIRONMENT`, `app.baseURL`, `app.indexPage`,  `database`:

```bash
# file .env
CI_ENVIRONMENT = development

app.baseURL    = 'http://localhost:8080'

app.indexPage  = ''

database.default.hostname = localhost
database.default.database =  ['bebas diisi']
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

*4.* Jalankan Development server di terminal

```php
cd dpmfrsuts-project

php spark serve
```

*5.* Buka web browser kemudian ketikan url berikut http://localhost:8080
