<?php
namespace App\Classes;

class Attaque {
    protected string $nom;
    protected int $puissance;
    protected float $precision;
    protected string $type;

    public function __construct(string $nom, int $puissance, float $precision, string $type) {
        $this->nom = $nom;
        $this->puissance = $puissance;
        $this->precision = $precision;
        $this->type = $type;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getPuissance(): int {
        return $this->puissance;
    }

    public function getPrecision(): float {
        return $this->precision;
    }

    public function getType(): string {
        return $this->type;
    }

    // Méthode d'exécution de l'attaque (si nécessaire)
    public function executerAttaque($attaquant, $adversaire): string {
        if(rand(0,100) <= $this->precision * 100) {
            $degats = max(1, $this->puissance - $adversaire->getDefense());
            $adversaire->recevoirDegats($degats);
            return "{$attaquant->getNom()} utilise {$this->nom} et inflige {$degats} dégâts à {$adversaire->getNom()} !";
        } else {
            return "{$attaquant->getNom()} utilise {$this->nom} mais l'attaque échoue !";
        }
    }
}
