<?php
namespace App\Interfaces;

interface Combattant {
    public function seBattre(Combattant $adversaire): void;
    public function utiliserAttaqueSpeciale(Combattant $adversaire): void;
    public function estKO(): bool;
    public function getNom(): string;
    public function getType(): string;
    public function getPointsDeVie(): int;
    public function recevoirDegats(int $degats): void;
    public function getDefense(): int;
    public function attaquer(Combattant $adversaire): void;
}
