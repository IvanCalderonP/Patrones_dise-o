<?php
namespace Videojuego\Decorator;

// Interfaz para los personajes
interface Personaje {
    public function obtenerDescripcion(): string;
    public function obtenerPoderAtaque(): int;
}

// Clase Guerrero
class Guerrero implements Personaje {
    public function obtenerDescripcion(): string {
        return "Guerrero básico";
    }

    public function obtenerPoderAtaque(): int {
        return 10;
    }
}

// Clase Mago
class Mago implements Personaje {
    public function obtenerDescripcion(): string {
        return "Mago básico";
    }

    public function obtenerPoderAtaque(): int {
        return 8;
    }
}

// Decorador base
abstract class ArmaDecorator implements Personaje {
    protected $personaje;

    public function __construct(Personaje $personaje) {
        $this->personaje = $personaje;
    }

    public function obtenerDescripcion(): string {
        return $this->personaje->obtenerDescripcion();
    }

    public function obtenerPoderAtaque(): int {
        return $this->personaje->obtenerPoderAtaque();
    }
}

// Decorador Espada
class EspadaDecorator extends ArmaDecorator {
    public function obtenerDescripcion(): string {
        return $this->personaje->obtenerDescripcion() . ", con una espada";
    }

    public function obtenerPoderAtaque(): int {
        return $this->personaje->obtenerPoderAtaque() + 15;
    }
}

// Decorador Arco
class ArcoDecorator extends ArmaDecorator {
    public function obtenerDescripcion(): string {
        return $this->personaje->obtenerDescripcion() . ", con un arco";
    }

    public function obtenerPoderAtaque(): int {
        return $this->personaje->obtenerPoderAtaque() + 10;
    }
}

// Decorador Bastón Mágico
class BastonMagicoDecorator extends ArmaDecorator {
    public function obtenerDescripcion(): string {
        return $this->personaje->obtenerDescripcion() . ", con un bastón mágico";
    }

    public function obtenerPoderAtaque(): int {
        return $this->personaje->obtenerPoderAtaque() + 20;
    }
}


use Videojuego\Decorator\Guerrero;
use Videojuego\Decorator\Mago;
use Videojuego\Decorator\EspadaDecorator;
use Videojuego\Decorator\ArcoDecorator;
use Videojuego\Decorator\BastonMagicoDecorator;

// Crear Guerrero con decorador
$guerrero = new Guerrero();
$guerreroConEspada = new EspadaDecorator($guerrero);
$guerreroConEspadaYArco = new ArcoDecorator($guerreroConEspada);

// Crear Mago con decorador
$mago = new Mago();
$magoConBaston = new BastonMagicoDecorator($mago);

//Resultados
echo $guerreroConEspadaYArco->obtenerDescripcion() . "\n";
echo "Poder de ataque: " . $guerreroConEspadaYArco->obtenerPoderAtaque() . "\n\n";

echo $magoConBaston->obtenerDescripcion() . "\n";
echo "Poder de ataque: " . $magoConBaston->obtenerPoderAtaque() . "\n";
