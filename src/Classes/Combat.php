<?php
namespace App\Classes;

use App\Interfaces\Combattant;

class Combat {
    private Combattant $pokemon1;
    private Combattant $pokemon2;
    private int $tour = 1;

    public function __construct(Combattant $p1, Combattant $p2) {
        $this->pokemon1 = $p1;
        $this->pokemon2 = $p2;
    }

    public function demarrerCombat(): array {
        return []; // Pas forcément utilisé, géré en AJAX
    }

    public function tourDeCombat(): array {
        $log = [];
        // Pokemon1 attaque
        $log[] = "{$this->pokemon1->getNom()} attaque {$this->pokemon2->getNom()} !";
        $this->pokemon1->attaquer($this->pokemon2);
        if($this->pokemon2->estKO()) {
            $log[] = "{$this->pokemon2->getNom()} est K.O.!";
            return $log;
        }

        // Pokemon2 attaque
        $log[] = "{$this->pokemon2->getNom()} attaque {$this->pokemon1->getNom()} !";
        $this->pokemon2->attaquer($this->pokemon1);
        if($this->pokemon1->estKO()) {
            $log[] = "{$this->pokemon1->getNom()} est K.O.!";
            return $log;
        }

        $this->tour++;
        return $log;
    }

    public function determinerVainqueur(): ?Combattant {
        if($this->pokemon1->estKO() && !$this->pokemon2->estKO()) {
            return $this->pokemon2;
        } elseif($this->pokemon2->estKO() && !$this->pokemon1->estKO()) {
            return $this->pokemon1;
        }
        return null;
    }

    public function getPokemon1(): Combattant {
        return $this->pokemon1;
    }

    public function getPokemon2(): Combattant {
        return $this->pokemon2;
    }

    public function getTour(): int {
        return $this->tour;
    }
}
