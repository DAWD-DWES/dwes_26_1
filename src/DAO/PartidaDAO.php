<?php

namespace App\DAO;

use PDO;
use App\Modelo\Partida;

class PartidaDAO {

    /**
     * @var $bd Conexión a la Base de Datos
     */
    private PDO $bd;

    /**
     * Constructor de la clase UsuarioDAO
     * 
     * @param PDO $bd Conexión a la base de datos
     * 
     * @returns UsuarioDAO
     */
    public function __construct(PDO $bd) {
        $this->bd = $bd;
    }

    public function crea(Partida $partida): int|bool {
        $sql = "INSERT INTO partidas (numErrores, palabraSecreta, palabraDescubierta, letras, maxNumErrores, inicio, fin, idUsuario) VALUES (:numErrores, :palabraSecreta, :palabraDescubierta, :letras, :maxNumErrores, FROM_UNIXTIME(:inicio), FROM_UNIXTIME(:fin), :idUsuario)";
        $stmt = $this->bd->prepare($sql);

// Creando un array de parámetros
        $params = [
            ':numErrores' => $partida->getNumErrores(),
            ':palabraSecreta' => $partida->getPalabraSecreta(),
            ':palabraDescubierta' => $partida->getPalabraDescubierta(),
            ':letras' => $partida->getLetras(),
            ':maxNumErrores' => $partida->getMaxNumErrores(),
            ':inicio' => $partida->getInicio()->getTimestamp(),
            ':fin' => $partida->getFin() ? $partida->getFin()->getTimestamp() : null,
            ':idUsuario' => $partida->getIdUsuario()
        ];
        $result = $stmt->execute($params);
        return ($result ? $this->bd->lastInsertId() : false);
    }

    public function modifica(Partida $partida): bool {
        $sql = "UPDATE partidas SET numErrores = :numErrores, palabraSecreta = :palabraSecreta, palabraDescubierta = :palabraDescubierta, letras = :letras, maxNumErrores = :maxNumErrores, inicio = FROM_UNIXTIME(:inicio), fin = FROM_UNIXTIME(:fin) WHERE id = :id";
        $stmt = $this->bd->prepare($sql);

// Creando un array de parámetros
        $params = [
            ':id' => $partida->getId(),
            ':numErrores' => $partida->getNumErrores(),
            ':palabraSecreta' => $partida->getPalabraSecreta(),
            ':palabraDescubierta' => $partida->getPalabraDescubierta(),
            ':letras' => $partida->getLetras(),
            ':maxNumErrores' => $partida->getMaxNumErrores(),
            ':inicio' => $partida->getInicio()->getTimestamp(),
            ':fin' => $partida->getFin() ? $partida->getFin()->getTimestamp() : null
        ];

        $result = $stmt->execute($params);
        return $result;
    }

    public function elimina(int $id): bool {
        
    }

    public function recuperaPorId(int $id): ?Partida {
        $sql = "select id, numErrores, palabraSecreta, palabraDescubierta, letras, maxNumErrores, UNIX_TIMESTAMP(inicio) as inicio, UNIX_TIMESTAMP(fin) as fin, idUsuario from partidas where id = :id;";
        $sth = $this->bd->prepare($sql);
        $sth->execute(["id" => $id]);
        $sth->setFetchMode(PDO::FETCH_CLASS, Partida::class);
        $partida = $sth->fetch();
        return $partida;
    }

}
