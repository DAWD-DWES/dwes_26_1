<?php

/**
 *  --- Lógica del script --- 
 * 
 * Establece conexión a la base de datos PDO
 * Si el usuario ya está validado
 *   Recupero el usuario y la partida de la sesión
 *   Si se pide jugar con una letra
 *     Leo la letra
 *     Si no hay error en la letra introducida
 *       Solicito a la partida que compruebe la letra
 *     Si es el fin de la partida
 *       Establezco la fecha de fin
 *       Actualizo la partida en la BBDD
 *     Invoco la vista de juego con los datos obtenidos
 *   Si no si se solicita un inicio de partida
 *      Recupero las partidas inacabadas del usuario
 *      Invoco la vista de partidas inacabadas
 *   Si no si se solicita una nueva partida
 *      Crea una partida
 *      Se almacena en la sesión
 *      Crea la partida en la BBDD
 *      Invoco la vista del juego para empezar a jugar
 *   Si no si se solicita jugar con una partida inacabada
 *      Recupero la partida inacabada
 *      LA 
 *      Invoco la vista de juego con la partida inacabada
 *   Si no Invoco la vista de juego
 *  Si no (En cualquier otro caso)
 *      Invoco la vista del formulario de login
 */
require "../vendor/autoload.php";

use eftec\bladeone\BladeOne;
use App\BD\BD;
use App\Modelo\Partida;
use App\Almacen\AlmacenPalabrasFichero;
use App\DAO\PartidaDAO;

session_start();

define("MAX_NUM_ERRORES", 5);

$vistas = __DIR__ . '/../vistas';
$cache = __DIR__ . '/../cache';
$blade = new BladeOne($vistas, $cache, BladeOne::MODE_DEBUG);

// Establece conexión a la base de datos PDO
try {
    $bd = BD::getConexion();
} catch (Exception $error) {
    echo $blade->run("cnxbderror", compact('error'));
    die;
}

$partidaDAO = new PartidaDAO($bd);

// Si el usuario ya está validado
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $partida = $_SESSION['partida'] ?? null;

// Si se pide jugar con una letra
    if (filter_has_var(INPUT_POST, 'botonenviarjugada')) {
// Leo la letra
        $letra = trim(filter_input(INPUT_POST, 'letra', FILTER_UNSAFE_RAW));

// Compruebo si la letra no es válida (carácter no válido o ya introducida)
        $error = !$partida->esLetraValida($letra);
// Si no hay error compruebo la letra
        if (!$error) {
            $partida->compruebaLetra(strtoupper($letra));
            if ($partida->esFin()) {
                $partida->setFin(new DateTime('now'));
            }
            try {
                $partidaDAO->modifica($partida);
            } catch (PDOException $ex) {
                error_log($ex->getMessage());
            }
        }
// Sigo jugando
        echo $blade->run("juego", compact('usuario', 'partida', 'error'));
// Si no si se solicita una nueva partida
    } elseif (filter_has_var(INPUT_GET, 'botoniniciojuego')) {
        try {
            $partidasInacabadas = $partidaDAO->recuperaInacabadasPorIdUsuario($usuario->getId());
// Invoco la vista del juego para empezar a jugar
            echo $blade->run("juegoinicio", compact('usuario', 'partidasInacabadas'));
            // Si no si se resuelve la partida con una palabra
        } catch (PDOException $ex) {
            error_log("Error PDO: " . $ex->getMessage());
            header("Location:juego.php?botonnuevapartida");
            die;
        }
    } elseif (filter_has_var(INPUT_GET, 'botonnuevapartida')) { // Se arranca una nueva partida
        $rutaFichero = $_ENV['RUTA_ALMACEN_PALABRAS'];
        $almacenPalabras = new AlmacenPalabrasFichero($rutaFichero);
        $partida = new Partida($almacenPalabras, MAX_NUM_ERRORES);
        $partida->setIdUsuario($usuario->getId());
        try {
            $partidaId = $partidaDAO->crea($partida);
            $partida->setId($partidaId);
        } catch (PDOException $ex) {
            error_log($ex->getMessage());
        }
        $_SESSION['partida'] = $partida;
        echo $blade->run("juego", compact('usuario', 'partida'));
// Invoco la vista del juego para empezar a jugar
        // Si no si se resuelve la partida con una palabra
    } elseif (filter_has_var(INPUT_GET, 'botonjuegapartida')) {
        $partidaid = filter_input(INPUT_GET, 'partidaid', FILTER_VALIDATE_INT);
        try {
            $partida = $partidaDAO->recuperaPorId((int) $partidaid);
            $_SESSION['partida'] = $partida;
            echo $blade->run("juego", compact('usuario', 'partida'));
        } catch (PDOException $ex) {
            error_log("Error PDO: " . $ex->getMessage());
            header("Location:juego.php?botonnuevapartida");
            die;
        }
    } else { //En cualquier otro caso
        echo $blade->run("juego", compact('usuario', 'partida'));
    }
    // En otro caso se muestra el formulario de login
} else {
    echo $blade->run("formlogin");
}
