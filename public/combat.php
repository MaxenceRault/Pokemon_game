<?php
// Initialisation et récupération des données
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/Classes/utils.php';

use App\Classes\Database;
use App\Classes\Attaque;
use App\Classes\Combat;

session_start();

// Récupération des Pokémon sélectionnés et de leurs données
$p1Id = (int) ($_GET['pokemon1'] ?? 0);
$p2Id = (int) ($_GET['pokemon2'] ?? 0);
$attaquesJoueur = $_GET['attaques'] ?? [];

// Vérification des données des Pokémon
$p1Data = Database::getPokemonById($p1Id);
$p2Data = Database::getPokemonById($p2Id);
if (!$p1Data || !$p2Data) {
    die("Pokémon introuvable.");
}

// Création des instances des Pokémon
$pokemon1 = \App\Classes\createPokemonInstance($p1Data);
$pokemon2 = \App\Classes\createPokemonInstance($p2Data);

// Ajout des attaques sélectionnées pour Pokémon 1
if (empty($attaquesJoueur)) {
    die("Vous devez choisir au moins une attaque.");
}

foreach ($attaquesJoueur as $attId) {
    $attData = Database::getAttaqueById((int) $attId);
    if ($attData) {
        $pokemon1->ajouterAttaque(new Attaque(
            $attData['nom'],
            (int) $attData['puissance'],
            (float) $attData['prec'],
            $attData['type']
        ));
    }
}

// Attribution d'attaques aléatoires pour Pokémon 2 (adversaire)
$attaquesAdversaire = Database::getAttaquesByType($p2Data['type'], 3);
foreach ($attaquesAdversaire as $attAdverse) {
    $pokemon2->ajouterAttaque(new Attaque(
        $attAdverse['nom'],
        (int) $attAdverse['puissance'],
        (float) $attAdverse['prec'],
        $attAdverse['type']
    ));
}

// Création du combat
$combat = new Combat($pokemon1, $pokemon2);

// Sauvegarde dans la session
$_SESSION['combat'] = serialize($combat);

// Redirection immédiate si un Pokémon est déjà KO
if ($pokemon1->estKO() || $pokemon2->estKO()) {
    header('Location: ecran_fin.php');
    exit;
}

// Points de vie max pour les barres de vie
$pvMax_p1 = $pokemon1->getPointsDeVieMax();
$pvMax_p2 = $pokemon2->getPointsDeVieMax();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Combat en cours</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const logArea = document.getElementById('log');
            const btnAttaques = document.querySelectorAll('.btn-attaque');

            const pvMax_p1 = <?= $pvMax_p1 ?>;
            const pvMax_p2 = <?= $pvMax_p2 ?>;

            // Fonction pour mettre à jour les barres de vie
            function updateHPBar(barId, currentPV, maxPV) {
                const bar = document.getElementById(barId);
                const pourcent = (currentPV / maxPV) * 100;
                bar.style.width = pourcent + '%';
                bar.classList.remove('hp-medium', 'hp-low');

                if (pourcent <= 25) {
                    bar.classList.add('hp-low');
                } else if (pourcent <= 50) {
                    bar.classList.add('hp-medium');
                }
            }

            // Gestion des attaques
            btnAttaques.forEach(btn => {
                btn.addEventListener('click', function () {
                    const indexAttaque = this.getAttribute('data-index');
                    fetch('ajax.php?action=tour&attaque=' + indexAttaque)
                        .then(response => response.json())
                        .then(data => {
                            data.log.forEach(line => {
                                const p = document.createElement('p');
                                p.textContent = line;
                                logArea.appendChild(p);
                            });

                            document.getElementById('pv_p1').textContent = data.pv1;
                            document.getElementById('pv_p2').textContent = data.pv2;

                            updateHPBar('hp_bar_p1', data.pv1, pvMax_p1);
                            updateHPBar('hp_bar_p2', data.pv2, pvMax_p2);

                            if (data.vainqueur) {
                                const p = document.createElement('p');
                                p.textContent = data.vainqueur + " a gagné !";
                                logArea.appendChild(p);

                                btnAttaques.forEach(b => b.disabled = true);

                                setTimeout(() => {
                                    window.location.href = 'ecran_fin.php';
                                }, 3000);
                            }
                        });
                });
            });
        });
    </script>
</head>

<body>
    <div class="battle-screen">
        <!-- Sprite et informations du Pokémon 2 (Adversaire) -->
        <div class="pokemon-area enemy-side">
            <img class="pokemon-sprite" id="sprite_p2" src="<?= $pokemon2->getSprite() ?>" alt="<?= $pokemon2->getNom() ?>">
        </div>
        <div class="pokemon-info enemy">
            <h2><?= $pokemon2->getNom() ?> (<?= $pokemon2->getType() ?>)</h2>
            <div class="hp-bar-container">
                <div class="hp-bar" id="hp_bar_p2"></div>
            </div>
            <p>PV: <span id="pv_p2"><?= $pokemon2->getPointsDeVie() ?></span></p>
        </div>

        <!-- Sprite et informations du Pokémon 1 (Joueur) -->
        <div class="pokemon-area player-side">
            <img class="pokemon-sprite" id="sprite_p1" src="<?= $pokemon1->getSpriteBack() ?>" alt="<?= $pokemon1->getNom() ?>">
        </div>
        <div class="pokemon-info player">
            <h2><?= $pokemon1->getNom() ?> (<?= $pokemon1->getType() ?>)</h2>
            <div class="hp-bar-container">
                <div class="hp-bar" id="hp_bar_p1"></div>
            </div>
            <p>PV: <span id="pv_p1"><?= $pokemon1->getPointsDeVie() ?></span></p>
        </div>
    </div>

    <div id="choixAttaques">
        <h3>Choisissez une attaque pour <?= $pokemon1->getNom(); ?> :</h3>
        <?php foreach ($pokemon1->getAttaques() as $index => $attaque): ?>
            <button class="btn-attaque btn-<?= $attaque->getType() ?>" data-index="<?= $index ?>"><?= $attaque->getNom() ?></button>
        <?php endforeach; ?>
    </div>

    <div id="log" class="log"></div>
</body>

</html>
