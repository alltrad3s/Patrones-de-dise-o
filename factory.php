<?php

// Interfaz para los personajes
interface Personaje {
    public function atacar();
    public function getVelocidad();
}

// Clase Esqueleto
class Esqueleto implements Personaje {
    private $velocidad = 5;
    private $danoAtaque = 10;

    public function atacar() {
        return "Esqueleto ataca con " . $this->danoAtaque . " puntos de daño";
    }

    public function getVelocidad() {
        return $this->velocidad;
    }
}

// Clase Zombi
class Zombi implements Personaje {
    private $velocidad = 3;
    private $danoAtaque = 15;

    public function atacar() {
        return "Zombi ataca con " . $this->danoAtaque . " puntos de daño";
    }

    public function getVelocidad() {
        return $this->velocidad;
    }
}

// Factory para crear personajes
class PersonajeFactory {
    public function crearPersonaje($nivel) {
        switch ($nivel) {
            case 'facil':
                return new Esqueleto();
            case 'dificil':
                return new Zombi();
            default:
                throw new Exception("Nivel no válido");
        }
    }
}

// Ejemplo de uso
try {
    $factory = new PersonajeFactory();
    
    // Crear personaje para nivel fácil
    $personajeFacil = $factory->crearPersonaje('facil');
    echo $personajeFacil->atacar() . "\n";
    echo "Velocidad: " . $personajeFacil->getVelocidad() . "\n";
    
    // Crear personaje para nivel difícil
    $personajeDificil = $factory->crearPersonaje('dificil');
    echo $personajeDificil->atacar() . "\n";
    echo "Velocidad: " . $personajeDificil->getVelocidad() . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>
