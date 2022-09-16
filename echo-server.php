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
    $out = "\r\n ---------------------- \r\n";
    $out .= socket_read($client, 1024 ** 2);
    echo $out . "\r\n";
    socket_write($client, "HTTP/1.1 200 OK\r\n");
    socket_close($client);
}
