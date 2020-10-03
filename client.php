<?php

include 'vendor/autoload.php';

use Service\EchoClient;
use Service\Message;

function request(string $msg)
{
    $cert = file_get_contents(__DIR__ . '/cert/server.crt');
    $credential = Grpc\ChannelCredentials::createSsl($cert);
    $client = new EchoClient('localhost:9001', [
        'credentials' => $credential,
    ]);

    $message = new Message();
    $message->setMsg($msg);

    $call = $client->Ping($message);
    $call2 = $client->Ping($message);

    [$reply, $status] = $call->wait();
    [$reply2, $status2] = $call2->wait();

    /** @var EchoResponse $reply */
    return $reply->getMsg() . ', ' .  $reply2->getMsg();
}

$msg = !empty($argv[1]) ? $argv[1] : 'Hello';
echo request($msg)."\n";
