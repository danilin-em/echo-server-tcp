<?php

const ADDRESS = '0.0.0.0';

$PORT = getenv('LISTEN_PORT') ?: 8080;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_bind($socket, ADDRESS, $PORT);
socket_listen($socket);

echo 'Listen ' . ADDRESS . ':' . $PORT . "\r\n";

while (true) {
    if (($client = socket_accept($socket)) === false) {
        continue;
    }
    $client_name = 'Unknown';
    socket_getpeername($client, $client_name);
    $input = socket_read($client, 1024);
    echo $input . "\r\n";
    if ($input === 'STOP') {
        break;
    }
}
