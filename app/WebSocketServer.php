<?php

namespace App;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketServer implements MessageComponentInterface
{
    public function onOpen(ConnectionInterface $conn)
    {
        // Logika ketika koneksi WebSocket dibuka
    }

    public function onClose(ConnectionInterface $conn)
    {
        // Logika ketika koneksi WebSocket ditutup
    }

    public function onMessage(ConnectionInterface $from, $message)
    {
        // Logika ketika pesan diterima dari koneksi WebSocket
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        // Logika ketika terjadi kesalahan pada koneksi WebSocket
    }
}