<?php
namespace App\Classes\Abstract;

use App\Interfaces\Combattant;
use App\Classes\Attaque;

abstract class Pokemon implements Combattant {
    protected string $nom;
    protected string $type;
    protected int $pointsDeVie;
    protected int $pointsDeVieMax;
    protected int $puissanceAttaque;
    protected int $defense;
    protected string $sprite;
    protected string $spriteBack; // Ajout de la colonne sprite_back
    /** @var Attaque[] */
    protected array $attaques = [];

    public function __construct(string $nom, string $type, int $pv, int $pa, int $def, string $sprite, string $spriteBack) {
        $this->nom = $nom;
        $this->type = $type;
        $this->pointsDeVie = $pv;
        $this->pointsDeVieMax = $pv;
        $this->puissanceAttaque = $pa;
        $this->defense = $def;
        $this->sprite = $sprite;
        $this->spriteBack = $spriteBack; // Initialisation
    }

    // Méthode pour ajouter une attaque
    public function ajouterAttaque(Attaque $attaque): void {
        $this->attaques[] = $attaque;
    }

    // Utiliser une attaque spécifique
    public function utiliserAttaqueSur(Combattant $adversaire, int $indexAttaque): string {
        if (!isset($this->attaques[$indexAttaque])) {
            return "{$this->nom} ne possède pas cette attaque !";
        }
        $attaque = $this->attaques[$indexAttaque];
        return $attaque->executerAttaque($this, $adversaire);
    }

    // Attaquer simplement (attaque de base si vous le souhaitez)
    public function attaquer(Combattant $adversaire): void {
        $degats = max(1, $this->puissanceAttaque - $adversaire->getDefense());
        $adversaire->recevoirDegats($degats);
    }

    public function recevoirDegats(int $degats): void {
        $this->pointsDeVie -= $degats;
        if ($this->pointsDeVie < 0) $this->pointsDeVie = 0;
    }

    public function estKO(): bool {
        return $this->pointsDeVie <= 0;
    }

    abstract public function capaciteSpeciale(Combattant $adversaire): void;

    public function utiliserAttaqueSpeciale(Combattant $adversaire): void {
        $this->capaciteSpeciale($adversaire);
    }

    public function seBattre(Combattant $adversaire): void {
        // Géré par la classe Combat
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getPointsDeVie(): int {
        return $this->pointsDeVie;
    }

    public function getDefense(): int {
        return $this->defense;
    }

    public function getSprite(): string {
        return $this->sprite;
    }

    public function getSpriteBack(): string {
        return $this->spriteBack; // Nouveau getter pour le sprite dorsal
    }

    public function getAttaques(): array {
        return $this->attaques;
    }

    public function getPointsDeVieMax(): int {
        return $this->pointsDeVieMax;
    }
}
