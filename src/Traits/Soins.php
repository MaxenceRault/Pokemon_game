<?php
namespace App\Traits;

trait Soins {
    public function soigner(): void {
        if (property_exists($this, 'pointsDeVieMax')) {
            $this->pointsDeVie = $this->pointsDeVieMax;
        } else {
            $this->pointsDeVie = 100; // Valeur par défaut si non spécifié
        }
    }
}
