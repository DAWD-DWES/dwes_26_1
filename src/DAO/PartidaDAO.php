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
        $sql = "INSERT INTO partidas (numErrores, palabraSecreta, palabraDescubierta, maxNumErrores, inicio, fin, idUsuario) VALUES (:numErrores, :palabraSecreta, :palabraDescubierta, :maxNumErrores, :inicio, :fin, :idUsuario)";
        $stmt = $this->bd->prepare($sql);

// Creando un array de parámetros
        $params = [
            ':numErrores' => $partida->getNumErrores(),
            ':palabraSecreta' => $partida->getPalabraSecreta(),
            ':palabraDescubierta' => $partida->getPalabraDescubierta(),
            ':maxNumErrores' => $partida->getMaxNumErrores(),
            ':inicio' => ($partida->getInicio())->format('Y-m-d H:i:s'),
            ':fin' => $partida->getFin() ? ($partida->getFin())->format('Y-m-d H:i:s') : null,
            ':idUsuario' => $partida->getIdUsuario()
        ];
        $result = $stmt->execute($params);
        return ($result ? $this->bd->lastInsertId() : false);
    }

    public function modifica(Partida $partida): bool {
        $sql = "UPDATE partidas SET numErrores = :numErrores, palabraSecreta = :palabraSecreta, palabraDescubierta = :palabraDescubierta, maxNumErrores = :maxNumErrores, inicio = :inicio, fin = :fin WHERE id = :id";
        $stmt = $this->bd->prepare($sql);

// Creando un array de parámetros
        $params = [
            ':id' => $partida->getId(),
            ':numErrores' => $partida->getNumErrores(),
            ':palabraSecreta' => $partida->getPalabraSecreta(),
            ':palabraDescubierta' => $partida->getPalabraDescubierta(),
            ':maxNumErrores' => $partida->getMaxNumErrores(),
            ':inicio' => ($partida->getInicio())->format('Y-m-d H:i:s'),
            ':fin' => $partida->getFin() ? ($partida->getFin())->format('Y-m-d H:i:s') : null,
        ];

        $result = $stmt->execute($params);
        return $result;
    }

    public function elimina(int $id): bool {
        
    }

}
