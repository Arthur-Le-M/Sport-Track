<?php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
require 'Database.php';
require 'configDB.php';
use MyApp\Chat;

require dirname(__DIR__) . '/vendor/autoload.php';

if (ENABLE_DATABASE == true) {
    $db = new Database(
        DATABASE_USERNAME,
        DATABASE_PASSWORD,
        DATABASE_HOST,
        DATABASE_PORT,
        DATABASE_DB
    );
} else {
    $db = null;
}


$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat($db)
        )
    ),
    8080
);

$server->run();