<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;


class Chat implements MessageComponentInterface {
    protected $clients;
    protected $array= array();

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        echo "server started! ";
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        $querystring = $conn->httpRequest->getUri()->getQuery();
        $this->array[$querystring] = $conn->resourceId;
        echo "New connection!({$querystring})({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        $data = json_decode($msg, true);
        $message = $data["message"];
        $id_destinataire = $data["destinataire"];
    
        if (isset($this->array[$id_destinataire])) {
            $idSocket = $this->array[$id_destinataire];
            foreach ($this->clients as $client) {
                if ($client->resourceId == $idSocket) {
                    $client->send($message);
                    break;
                }
            }
            include ('./../API/insertMsg.php?id='.$id_destinataire.'&message='.$message);
        }
        include ('./../API/insertMsg.php'.$id_destinataire.'&message='.$message);
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function existe_socket($val) {
        return isset($this->array[$val]);
    }
}


