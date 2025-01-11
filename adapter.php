<?php

// Interfaz para Windows 10
interface ArchivoWindows10 {
    public function abrirArchivo($nombre);
}

// Clase que maneja archivos de Windows 7
class ArchivoWindows7 {
    public function abrirArchivoAntiguo($nombre) {
        return "Abriendo archivo de Windows 7: " . $nombre;
    }
}

// Adaptador para hacer compatible Windows 7 con Windows 10
class AdaptadorArchivo implements ArchivoWindows10 {
    private $archivoWindows7;

    public function __construct(ArchivoWindows7 $archivoWindows7) {
        $this->archivoWindows7 = $archivoWindows7;
    }

    public function abrirArchivo($nombre) {
        // Convertir el formato si es necesario
        $nombreConvertido = $this->convertirFormato($nombre);
        return $this->archivoWindows7->abrirArchivoAntiguo($nombreConvertido);
    }

    private function convertirFormato($nombre) {
        // Aquí iría la lógica de conversión
        return $nombre . " (convertido)";
    }
}

// Cliente que usa Windows 10
class Cliente {
    public function abrirDocumento(ArchivoWindows10 $archivo, $nombre) {
        return $archivo->abrirArchivo($nombre);
    }
}

// Ejemplo de uso
$archivoW7 = new ArchivoWindows7();
$adaptador = new AdaptadorArchivo($archivoW7);
$cliente = new Cliente();

// Probando con diferentes tipos de archivos
$archivos = ['documento.doc', 'hoja.xls', 'presentacion.ppt'];

foreach ($archivos as $archivo) {
    echo $cliente->abrirDocumento($adaptador, $archivo) . "\n";
}

?>
