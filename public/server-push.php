<?php

require __DIR__.'/../vendor/autoload.php';

use App\Http\Controllers\PushController;

$notification = new PushController();

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
socket_bind($socket, 0, '8000');
socket_listen($socket);

$clientSocketArray = [$socket];

while(true) {
    $newSocketArray = $clientSocketArray;
    $null = [];
    socket_select($newSocketArray, $null, $null, 0, 10);

    if (in_array($socket, $newSocketArray)) {
        $newSocket = socket_accept($socket);
        $clientSocketArray[] = $newSocket;

        $header = socket_read($newSocket, 5000);
        $notification->sendHeaders($header, $newSocket, 'ibgame', '8000');

        $newSocketArrayIndex = array_search($socket, $newSocketArray);
        unset($newSocketArray[$newSocketArrayIndex]);
    }

    foreach ($newSocketArray as $newSocketArrayResource) {
        while (socket_recv($newSocketArrayResource, $socketData, 5000, 0) >= 1) {
            $socketMsg = $notification->unseal($socketData);
            $msgObj = json_decode($socketMsg);
            $notificationMessage = $notification->createNotification(
                $msgObj->team_id,
                $msgObj->team_name,
                $msgObj->team_answer,
                $msgObj->team_move
            );
            $notification->send($notificationMessage, $clientSocketArray);
            break 2;
        }

        $socketData = @socket_read($newSocketArrayResource, 5000, PHP_NORMAL_READ);
        if ($socketData === false) {
            socket_getpeername($newSocketArrayResource, $newSocket, $client_ip_address);
            $connection = $notification->newDisconnected($client_ip_address);
            $notification->send($connection, $clientSocketArray);

            $newSocketArrayIndex = array_search($newSocketArrayResource, $clientSocketArray);
            unset($clientSocketArray[$newSocketArrayIndex]);
        }
    }

}

socket_close($socket);