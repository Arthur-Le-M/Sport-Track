<?php
class Database extends \PDO
{

    public function __construct
    (   $username = '',
        $password = '',
        $host = '',
        $port = 3306,
        $db = ''
    ) {
        $dsn = 'mysql:dbname=' . $db . ';host=' . $host . ':' . $port;
        parent::__construct($dsn, $username, $password);
    }


    public function insert($message = '',$from_id = 0,$to_id = 0): void {
        $dt=NOW();
        $statement = $this->prepare("INSERT INTO messages SET message=:message,
                                                            id_destinataire=:id_destinataire,
                                                            id_auteur=:id_auteur,
                                                            date=:NOW())");
        $statement->execute(
            [
                'message' => $message,
                'id_destinataire' => $to_id,
                'id_auteur' => $from_id,
                'date' => $dt
            ]
        );
    }
}
