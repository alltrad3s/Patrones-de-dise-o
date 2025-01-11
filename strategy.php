<?php

// Interfaz Strategy
interface MensajeStrategy {
    public function mostrarMensaje($mensaje);
}

// Estrategia concreta para mostrar en consola
class ConsolaMensaje implements MensajeStrategy {
    public function mostrarMensaje($mensaje) {
        echo "Consola: " . $mensaje . "\n";
    }
}

// Estrategia concreta para formato JSON
class JSONMensaje implements MensajeStrategy {
    public function mostrarMensaje($mensaje) {
        $datos = [
            'tipo' => 'json',
            'contenido' => $mensaje,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        echo json_encode($datos) . "\n";
    }
}

// Estrategia concreta para archivo TXT
class TXTMensaje implements MensajeStrategy {
    public function mostrarMensaje($mensaje) {
        $archivo = 'mensaje_' . date('Y-m-d_H-i-s') . '.txt';
        file_put_contents($archivo, $mensaje);
        echo "Mensaje guardado en archivo: " . $archivo . "\n";
    }
}

// Contexto que usa la estrategia
class ContextoMensaje {
    private $strategy;

    public function setStrategy(MensajeStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function mostrarMensaje($mensaje) {
        return $this->strategy->mostrarMensaje($mensaje);
    }
}

// Ejemplo de uso
$contexto = new ContextoMensaje();
$mensaje = "Hola, este es un mensaje de prueba";

// Usar estrategia de consola
$contexto->setStrategy(new ConsolaMensaje());
$contexto->mostrarMensaje($mensaje);

// Usar estrategia JSON
$contexto->setStrategy(new JSONMensaje());
$contexto->mostrarMensaje($mensaje);

// Usar estrategia TXT
$contexto->setStrategy(new TXTMensaje());
$contexto->mostrarMensaje($mensaje);

?>
