<?php

namespace App\Modelo;

use DateTime;

/**
 * Clase que representa una partida del juego del ahorcado
 */
class Jugada {

    /**
     * @var int $id Identificador de la partida
     */
    private ?int $id;

    /**
     * @var string $letra Letra de la jugada
     */
    private string $letra;

    /**
     * @var int $fechaCreacion Timestamp de la llegada de la jugada
     */
    private int $fechaCreacion;


    /**
     * @var int $idPartida Identificador de la partida a la que pertenece
     */
    private int $idPartida;
    
    public function __construct(string $letra, DateTime $fechaCreacion) {
        $this->setLetra($letra);
        $this->setFechaCreacion($fechaCreacion);
    }
    
    public function getId(): ?int {
        return $this->id;
    }

    public function getLetra(): string {
        return $this->letra;
    }

    public function getFechaCreacion(): DateTime {
        return ($this->fechaCreacion ? (new DateTime())->setTimestamp($this->fechaCreacion) : null);
    }

    public function getIdPartida(): int {
        return $this->idPartida;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function setLetra(string $letra): void {
        $this->letra = $letra;
    }

    public function setFechaCreacion(DateTime $fechaCreacion): void {
        $this->fechaCreacion = $fechaCreacion->getTimestamp();
    }

    public function setIdPartida(int $idPartida): void {
        $this->idPartida = $idPartida;
    }
    
}
