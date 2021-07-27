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
Restore the mysql db with the file `config/air_traffic_control.sql`.
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

## Access

To start, you have to login with 
```sh
    'username' => 'admin',
    'password' => 'admin'
```
Now Enqueue and Dequeue to test.
