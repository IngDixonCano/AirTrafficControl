# AirTrafficControl

## Features

- Boot – start the system
- Enqueue – Add an AC to the queue
- Dequeue- Remove an AC from the queue based on priority
- List – Provide the current order of the AC in the queue

## Tech

- [Yii2] - PHP Framework
- [PHP] - Version 7.2
- [MySQL] - Database.

## Installation

Add the project to the folder http or www of the webserver.
Restore the db with the file `config/db.php` with real data.
Run the webserver and go the browser `http://localhost/AirTrafficControl/web/`.

## CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```sh
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

Verifying the Installation 
--------------------------

After installation is done, either configure your web server or use the
[built-in PHP web server](https://secure.php.net/manual/en/features.commandline.webserver.php) by running the following
console command while in the project root directory:
 
```bash
php yii serve
```

> Note: By default the HTTP-server will listen to port 8080. However if that port is already in use or you wish to 
serve multiple applications this way, you might want to specify what port to use. Just add the --port argument:

```bash
php yii serve --port=8888
```

You can use your browser to access the installed Yii application with the following URL:

```
http://localhost:8080/
```

## Access

To start, you have to login with 
```sh
    'username' => 'admin',
    'password' => 'admin'
```
Now Enqueue and Dequeue to test.
