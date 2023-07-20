<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Server\IoServer;
use App\WebSocketServer;

class WebSocketServerCommand extends Command
{
    protected $signature = 'websocket:server';
    protected $description = 'Start the WebSocket server';

    public function handle()
    {
        $server = IoServer::factory(new WebSocketServer(), 6001);
        $this->info('WebSocket server started on port 6001');
        $server->run();
    }
}