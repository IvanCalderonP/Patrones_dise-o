<?php

interface Personaje
{
    public function atacar(): string;
    public function obtenerVelocidad(): int;
}


class Esqueleto implements Personaje
{
    public function atacar(): string
    {
        return "El Esqueleto lanza un flechazo!";
    }

    public function obtenerVelocidad(): int
    {
        return 10; // Velocidad del Esqueleto
    }
}


class Zombi implements Personaje
{
    public function atacar(): string
    {
        return "El Zombi muerde ferozmente!";
    }

    public function obtenerVelocidad(): int
    {
        return 5; // Velocidad del Zombi
    }
}

// Clase Factory para crear los personajes
class PersonajeFactory
{
    public static function crearPersonaje(string $nivel): Personaje
    {
        switch ($nivel) {
            case 'facil':
                return new Esqueleto();
            case 'dificil':
                return new Zombi();
            default:
                throw new Exception("Nivel no válido: $nivel");
        }
    }
}

// Simulación del juego
try {
    $nivelJuego = 'facil'; // Cambiar a 'difícil' para probar el Zombi
    $personaje = PersonajeFactory::crearPersonaje($nivelJuego);

    echo "Personaje creado para nivel $nivelJuego:\n";
    echo $personaje->atacar() . "\n";
    echo "Velocidad del personaje: " . $personaje->obtenerVelocidad() . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
