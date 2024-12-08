<?php
session_start();
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/Classes/utils.php';

use App\Classes\Combat;

// Vérifie si une session de combat existe
if (!isset($_SESSION['combat'])) {
    die("Pas de combat en cours.");
}

// Récupère les données du combat
/** @var Combat $combat */
$combat = unserialize($_SESSION['combat']);

// Détermine le vainqueur
$vainqueur = $combat->determinerVainqueur();

// Si le combat n'est pas terminé ou pas de vainqueur, redirige
if (!$vainqueur) {
    die("Le combat n'est pas encore terminé.");
}

// Récupère les informations du vainqueur
$nomVainqueur = $vainqueur->getNom();
$typeVainqueur = $vainqueur->getType();
$pvRestant = $vainqueur->getPointsDeVie();
$spriteVainqueur = $vainqueur->getSprite();

// Nettoie la session pour réinitialiser le combat
unset($_SESSION['combat']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fin du combat</title>
    <link rel="stylesheet" href="assets/css/end_screen.css">
</head>

<body>
    <div class="end-screen">
        <h1>Victoire !</h1>
        <div class="winner-info">
            <img src="<?= $spriteVainqueur ?>" alt="<?= $nomVainqueur ?>">
            <h2><?= $nomVainqueur ?> (<?= $typeVainqueur ?>)</h2>
            <p>PV Restants : <?= $pvRestant ?></p>
        </div>
        <a href="./index.php" class="btn">Revenir à la sélection</a>
    </div>
</body>

</html>
