<?php

use Service\EchoInterface;
use Spiral\Goridge\StreamRelay;
use Spiral\GRPC\Server;
use Spiral\RoadRunner\Worker;

ini_set('display_errors', 'stderr');
require "vendor/autoload.php";

$server = new Server();
$server->registerService(EchoInterface::class, new EchoService());

$worker = new Worker(new StreamRelay(STDIN, STDOUT));
$server->serve($worker);
