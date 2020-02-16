<?php


namespace App\Http\Controllers;


class PushController extends Controller
{
    public function sendHeaders($headersText, $newSocket, $host, $port)
    {
        $headers = [];
        $lines = preg_split("/\r\n/", $headersText);

        foreach ($lines as $line) {
            $line = rtrim($line);
            if (preg_match('/\A(\S+): (.*)\z/', $line, $matches)) {
                $headers[$matches[1]] = $matches[2];
            }
        }

        $key = $headers['Sec-WebSocket-Key'];
        $sKey = base64_encode(pack('H*', sha1($key . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));

        $strHeader = "HTTP/1.1 101 Switching Protocols \r\n" .
            "Connection: Upgrade\r\n" .
            "Upgrade: websocket\r\n" .
            "Origin: $host\r\n" .
            "WebSocket-Location: ws://$host:$port/server.php\r\n" .
            "Sec-WebSocket-Accept:$sKey\r\n\r\n";
        socket_write($newSocket, $strHeader, strlen($strHeader));
    }

    public function seal($socketData)
    {
        $b1 = 0x81;
        $length = strlen($socketData);
        $header = '';

        if ($length <= 125) {
            $header = pack('CC', $b1, $length);
        } else if ($length > 125 && $length < 65536) {
            $header = pack('CCn', $b1, 126, $length);
        } else if ($length > 65536) {
            $header = pack('CCNN', $b1, 127, $length);
        }
        return $header . $socketData;
    }

    public function send($msg, $clientSocketArray)
    {
        $messageLength = strlen($msg);
        foreach ($clientSocketArray as $clientSocket) {
            @socket_write($clientSocket, $msg, $messageLength);
        }
        return true;
    }

    public function unseal($socketData)
    {
        $length = ord($socketData[1]) & 127;
        if ($length == 126) {
            $mask = substr($socketData, 4, 4);
            $data = substr($socketData, 8);
        } else if ($length == 127) {
            $mask = substr($socketData, 10, 4);
            $data = substr($socketData, 14);
        } else {
            $mask = substr($socketData, 2, 4);
            $data = substr($socketData, 6);
        }

        $socketStr = '';
        for ($i = 0; $i < strlen($data); ++$i) {
            $socketStr .= $data[$i] ^ $mask[$i%4];
        }

        return $socketStr;
    }

    public function createNotification($team_id, $team_name, $msgStr, $team_move)
    {
        $msgArray = [
            'team_id' => $team_id,
            'team_name' => $team_name,
            'type' => 'answer',
            'team_message' => $msgStr,
            'team_move' => $team_move
        ];

        return $this->seal(json_encode($msgArray));
    }

    public function newDisconnected($client_ip_address)
    {
        $msg = 'Client ' . $client_ip_address;
        $msgArray = [
            'msg' => $msg,
            'type' => 'newConnect'
        ];

        return $this->seal(json_encode($msgArray));
    }
}