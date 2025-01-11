<?php

// Interfaz base para personajes
interface Personaje {
    public function atacar();
    public function obtenerDescripcion();
}

// Personaje base
class Guerrero implements Personaje {
    protected $nombre;

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    public function atacar() {
        return 10;
    }

    public function obtenerDescripcion() {
        return "Guerrero " . $this->nombre;
    }
}

// Decorador abstracto
abstract class DecoradorArma implements Personaje {
    protected $personaje;

    public function __construct(Personaje $personaje) {
        $this->personaje = $personaje;
    }

    abstract public function atacar();
    abstract public function obtenerDescripcion();
}

// Decorador concreto - Espada
class Espada extends DecoradorArma {
    public function atacar() {
        return $this->personaje->atacar() + 15;
    }

    public function obtenerDescripcion() {
        return $this->personaje->obtenerDescripcion() . " con Espada";
    }
}

// Decorador concreto - Arco
class Arco extends DecoradorArma {
    public function atacar() {
        return $this->personaje->atacar() + 10;
    }

    public function obtenerDescripcion() {
        return $this->personaje->obtenerDescripcion() . " con Arco";
    }
}

// Ejemplo de uso
$guerrero1 = new Guerrero("Juan");
echo $guerrero1->obtenerDescripcion() . "\n";
echo "Daño base: " . $guerrero1->atacar() . "\n";

// Añadir una espada al guerrero
$guerreroConEspada = new Espada($guerrero1);
echo $guerreroConEspada->obtenerDescripcion() . "\n";
echo "Daño con espada: " . $guerreroConEspada->atacar() . "\n";

// Añadir un arco al guerrero con espada
$guerreroCompleto = new Arco($guerreroConEspada);
echo $guerreroCompleto->obtenerDescripcion() . "\n";
echo "Daño total: " . $guerreroCompleto->atacar() . "\n";

?>
