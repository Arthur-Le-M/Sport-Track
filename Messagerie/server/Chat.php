<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
error_reporting(E_ALL ^ E_DEPRECATED);

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
<<<<<<< HEAD
        $query = $conn->WebSocket->request->getQuery();
        echo "$query";
        echo "New connection! ({$conn->resourceId})\n";
=======
        $querystring = $conn->httpRequest->getUri()->getQuery();
        $this->array[$querystring] = $conn->resourceId;
        echo "New connection!({$querystring})({$conn->resourceId})\n";
>>>>>>> websockets
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        $data = json_decode($msg, true);

        if ($data !== null) {
            $message = $data["message"];
            $id_destinataire = $data["destinataire"];
            $id_envoyeur = $data["envoyeur"];
            // votre code de traitement du message ici
            $params = array('id' => $id_destinataire, 'message' => $message);
            $query_str = http_build_query($params);

            if (isset($this->array[$id_destinataire])) {
                $idSocket = $this->array[$id_destinataire];
                foreach ($this->clients as $client) {
                    if ($client->resourceId == $idSocket) {
                        $client->send($message);
                        break;
                    }
                }
                //include("../API/insertMsg.php?".$query_str);
            }
            //include("../API/insertMsg.php?".$query_str);
           // Paramètres de connexion à la base de données
           if ($this->sauvegarderMessage($data)) {
            echo 'Saved message to DB';
            } else {
            echo 'Failed to save message';
            }


        } else {
            // gérer l'erreur de décodage JSON ici
            echo "Erreur de décodage JSON : " . json_last_error_msg() . "\n";
        }
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
    public function sauvegarderMessage($data)
    {
        echo("sauvegarde :");
        $db = new \PDO("mysql:host=127.0.0.1:3306;dbname=bd_sporttrack", "root", "root"); 
        
        $stmt = $db->prepare('INSERT INTO messages(message, id_destinataire, id_auteur, date) VALUES (?, ?, ?, NOW())');
        
        if ($stmt) {
            $stmt->bindParam(1, $data['message']);
            $stmt->bindParam(2, $data['destinataire']);
            $stmt->bindParam(3, $data['envoyeur']);
            $stmt->execute();
            return true;
        }

        return false;
    }
}


