<?php

interface Archivo {
    public function abrir(): string;
}

// Clase para archivos compatibles con Windows 10
class ArchivoWindows10 implements Archivo {
    private $nombreArchivo;

    public function __construct(string $nombreArchivo) {
        $this->nombreArchivo = $nombreArchivo;
    }

    public function abrir(): string {
        return "Abriendo '{$this->nombreArchivo}' en Windows 10.";
    }
}

// Clase para archivos de versiones anteriores de Windows (Windows 7)
class ArchivoWindows7 {
    private $nombreArchivo;

    public function __construct(string $nombreArchivo) {
        $this->nombreArchivo = $nombreArchivo;
    }

    public function abrirArchivoViejo(): string {
        return "Abriendo '{$this->nombreArchivo}' en formato Windows 7.";
    }
}

// Adaptador para hacer compatible los archivos de Windows 7 con Windows 10
class AdaptadorArchivoWindows7 implements Archivo {
    private $archivoWindows7;

    public function __construct(ArchivoWindows7 $archivoWindows7) {
        $this->archivoWindows7 = $archivoWindows7;
    }

    public function abrir(): string {
        // Convierte el archivo de Windows 7 a un formato compatible con Windows 10
        return $this->archivoWindows7->abrirArchivoViejo() . " Convertido para Windows 10.";
    }
}

// Ejemplo de uso
function abrirArchivoEnWindows10(Archivo $archivo) {
    echo $archivo->abrir() . "\n";
}

// Archivo nativo de Windows 10
$archivo10 = new ArchivoWindows10("documento_moderno.docx");
abrirArchivoEnWindows10($archivo10);

// Archivo antiguo de Windows 7
$archivo7 = new ArchivoWindows7("documento_viejo.doc");
$adaptador = new AdaptadorArchivoWindows7($archivo7);
abrirArchivoEnWindows10($adaptador);

?>
