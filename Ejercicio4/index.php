<?php
// Interfaz Strategy: Define el comportamiento común para todas las estrategias
interface SalidaStrategy
{
    public function mostrarMensaje(string $mensaje): void;
}

// Estrategia concreta: Mostrar el mensaje en consola
class SalidaConsola implements SalidaStrategy
{
    public function mostrarMensaje(string $mensaje): void
    {
        echo "Mensaje en consola: " . $mensaje . "\n";
    }
}

// Estrategia concreta: Mostrar el mensaje en formato JSON
class SalidaJSON implements SalidaStrategy
{
    public function mostrarMensaje(string $mensaje): void
    {
        echo json_encode(["mensaje" => $mensaje], JSON_PRETTY_PRINT) . "\n";
    }
}

// Estrategia concreta: Guardar el mensaje en un archivo TXT
class SalidaArchivoTXT implements SalidaStrategy
{
    private $archivo;

    public function __construct(string $archivo)
    {
        $this->archivo = $archivo;
    }

    public function mostrarMensaje(string $mensaje): void
    {
        file_put_contents($this->archivo, $mensaje . "\n", FILE_APPEND);
        echo "Mensaje guardado en archivo: {$this->archivo}\n";
    }
}

// Clase Contexto: Permite cambiar la estrategia de salida
class Mensaje
{
    private $estrategia;

    public function __construct(SalidaStrategy $estrategia)
    {
        $this->estrategia = $estrategia;
    }

    // Cambia la estrategia en tiempo de ejecución
    public function setEstrategia(SalidaStrategy $estrategia): void
    {
        $this->estrategia = $estrategia;
    }

    // Ejecuta la estrategia actual
    public function mostrar(string $mensaje): void
    {
        $this->estrategia->mostrarMensaje($mensaje);
    }
}


$salidaConsola = new SalidaConsola();
$salidaJSON = new SalidaJSON();
$salidaArchivoTXT = new SalidaArchivoTXT("salida.txt");

// Crear el contexto con la estrategia inicial
$mensaje = new Mensaje($salidaConsola);

$mensaje->mostrar("Hola, soy un mensaje en consola");

// Cambiar estrategia a JSON y mostrar mensaje
$mensaje->setEstrategia($salidaJSON);
$mensaje->mostrar("Hola, soy un mensaje en formato JSON");

// Cambiar estrategia a archivo TXT y mostrar mensaje
$mensaje->setEstrategia($salidaArchivoTXT);
$mensaje->mostrar("Hola, soy un mensaje en un archivo TXT");
