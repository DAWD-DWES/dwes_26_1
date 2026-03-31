<?php

namespace App\DAO;

use PDO;
use App\Modelo\Jugada;

class JugadaDAO {

    /**
     * @var $bd Conexión a la Base de Datos
     */
    private PDO $bd;

    /**
     * Constructor de la clase JugadaDAO
     * 
     * @param PDO $bd Conexión a la base de datos
     * 
     * @returns JugadaDAO
     */
    public function __construct(PDO $bd) {
        $this->bd = $bd;
    }

    public function crea(Jugada $jugada): int|bool {
        $sql = "INSERT INTO jugadas (letra, fechaCreacion, idPartida) VALUES (:letra, :fechaCreacion, :idPartida)";
        $stmt = $this->bd->prepare($sql);

// Creando un array de parámetros
        $params = [
            ':letra' => $jugada->getLetra(),
            ':fechaCreacion' => ($jugada->getFechaCreacion())->format('Y-m-d H:i:s'),
            ':idPartida' => $jugada->getIdPartida(),
        ];
        $result = $stmt->execute($params);
        return ($result ? $this->bd->lastInsertId() : false);
    }

    public function modifica(Jugada $jugada): bool {
    }

    public function elimina(int $id): bool {
        
    }

    public function recuperaPorIdPartida(int $idPartida): array {
        $sql = "select id, letra, UNIX_TIMESTAMP(fechaCreacion) as fechaCreacion, esCorrecta, idPartida from jugadas where idPartida = :idPartida;";
        $sth = $this->bd->prepare($sql);
        $sth->execute(["idPartida" => $idPartida]);
        $sth->setFetchMode(PDO::FETCH_CLASS, Jugada::class);
        $jugadas = $sth->fetchAll();
        return $jugadas;
    }

}
