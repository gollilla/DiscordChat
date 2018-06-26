<?php 

namespace soradore\DiscordChat;

use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

class ReceiveTask extends AsyncTask {

	public $message = '';

	public function onRun(){
		$socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
		socket_bind($socket, 'localhost', 8080);
		socket_recvfrom($socket, $buf, 1000, 0, $from, $port);
		$this->message = $buf;
	}

	public function onCompletion(Server $server){
		$server->bloasCastMessage($this->message);
		$task = new ReceiveTask();
		$server->getAsyncPool()->submitTask($task);
	}
}