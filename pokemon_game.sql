-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 08 déc. 2024 à 18:28
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pokemon_game`
--

-- --------------------------------------------------------

--
-- Structure de la table `attaques`
--

CREATE TABLE `attaques` (
  `id` int NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `puissance` int NOT NULL,
  `prec` float NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `attaques`
--

INSERT INTO `attaques` (`id`, `nom`, `puissance`, `prec`, `type`) VALUES
(104, 'Flammèche', 25, 0.9, 'feu'),
(105, 'Lance-Flammes', 35, 0.9, 'feu'),
(106, 'Boutefeu', 45, 0.85, 'feu'),
(107, 'Pistolet à O', 25, 0.9, 'eau'),
(108, 'Hydrocanon', 35, 0.9, 'eau'),
(109, 'Surf', 40, 0.95, 'eau'),
(110, 'Fouet-Lianes', 25, 0.85, 'plante'),
(111, 'Tranch’Herbe', 30, 0.95, 'plante'),
(112, 'Canon Graine', 40, 0.9, 'plante'),
(113, 'Éclair', 25, 0.8, 'electrique'),
(114, 'Tonnerre', 35, 0.9, 'electrique'),
(115, 'Fatal-Foudre', 45, 0.7, 'electrique'),
(116, 'Charge', 20, 1, 'normal'),
(117, 'Tacle', 30, 1, 'normal'),
(118, 'Damoclès', 45, 0.9, 'normal'),
(119, 'Griffe', 25, 1, 'normal'),
(120, 'Morsure', 28, 1, 'tenebres'),
(121, 'Psyko', 38, 0.9, 'psy'),
(122, 'Ball’Ombre', 35, 0.9, 'spectre'),
(123, 'Draco-Rage', 30, 1, 'dragon'),
(124, 'Colère', 45, 0.9, 'dragon'),
(125, 'Poing-Karate', 34, 0.95, 'combat'),
(126, 'Close Combat', 50, 0.9, 'combat'),
(127, 'Seisme', 40, 0.9, 'sol'),
(128, 'Lame de Roc', 35, 0.8, 'roche'),
(129, 'Vent Argenté', 25, 0.9, 'insecte'),
(130, 'Bec Vrille', 30, 0.95, 'vol'),
(131, 'Laser Glace', 35, 0.9, 'glace'),
(132, 'Vent Glacé', 25, 0.9, 'glace');

-- --------------------------------------------------------

--
-- Structure de la table `pokemons`
--

CREATE TABLE `pokemons` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `pointsDeVie` int NOT NULL,
  `puissanceAttaque` int NOT NULL,
  `defense` int NOT NULL,
  `sprite` varchar(255) NOT NULL,
  `sprite_back` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `pokemons`
--

INSERT INTO `pokemons` (`id`, `nom`, `type`, `pointsDeVie`, `puissanceAttaque`, `defense`, `sprite`, `sprite_back`) VALUES
(97, 'Salameche', 'feu', 100, 20, 10, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/4.png'),
(98, 'Carapuce', 'eau', 120, 15, 15, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/7.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/7.png'),
(99, 'Bulbizarre', 'plante', 110, 18, 12, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/1.png'),
(100, 'Rattata', 'normal', 90, 15, 8, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/19.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/19.png'),
(101, 'Pikachu', 'electrique', 95, 22, 9, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/25.png'),
(102, 'Dracaufeu', 'feu', 180, 40, 30, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/6.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/6.png'),
(103, 'Tortank', 'eau', 200, 38, 35, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/9.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/9.png'),
(104, 'Florizarre', 'plante', 190, 37, 33, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/3.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/3.png'),
(105, 'Roucarnage', 'vol', 170, 36, 28, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/18.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/18.png'),
(106, 'Raichu', 'electrique', 160, 42, 25, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/26.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/26.png'),
(107, 'Mackogneur', 'combat', 210, 45, 32, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/68.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/68.png'),
(108, 'Alakazam', 'psy', 150, 50, 20, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/65.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/65.png'),
(109, 'Dracolosse', 'dragon', 220, 48, 40, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/149.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/149.png'),
(110, 'Rhinoféros', 'sol', 230, 46, 42, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/112.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/112.png'),
(111, 'Aéromite', 'insecte', 160, 35, 25, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/49.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/49.png'),
(112, 'Goupix', 'feu', 120, 28, 22, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/37.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/37.png'),
(113, 'Spectrum', 'spectre', 140, 38, 20, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/93.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/93.png'),
(114, 'Onix', 'roche', 190, 30, 50, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/95.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/95.png');

-- --------------------------------------------------------

--
-- Structure de la table `pokemon_attaques`
--

CREATE TABLE `pokemon_attaques` (
  `id` int NOT NULL,
  `pokemon_id` int NOT NULL,
  `attaque_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pokemon_attaques`
--

INSERT INTO `pokemon_attaques` (`id`, `pokemon_id`, `attaque_id`) VALUES
(1, 97, 104),
(2, 97, 119),
(3, 97, 113),
(4, 98, 107),
(5, 98, 116),
(6, 99, 110),
(7, 99, 116),
(8, 99, 119),
(9, 100, 119),
(10, 100, 116),
(11, 101, 113),
(12, 101, 116),
(13, 101, 119),
(14, 102, 104),
(15, 102, 105),
(16, 102, 130),
(17, 103, 107),
(18, 103, 108),
(19, 103, 109),
(20, 104, 110),
(21, 104, 111),
(22, 104, 112),
(23, 105, 130),
(24, 105, 117),
(25, 105, 118),
(26, 106, 113),
(27, 106, 114),
(28, 106, 115),
(29, 107, 125),
(30, 107, 126),
(31, 107, 116),
(32, 108, 121),
(33, 108, 122),
(34, 108, 119),
(35, 109, 123),
(36, 109, 124),
(37, 109, 127),
(38, 110, 127),
(39, 110, 128),
(40, 110, 116),
(41, 111, 129),
(42, 111, 130),
(43, 111, 119),
(44, 112, 131),
(45, 112, 132),
(46, 112, 116),
(47, 113, 122),
(48, 113, 120),
(49, 113, 119),
(50, 114, 128),
(51, 114, 127),
(52, 114, 117);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `attaques`
--
ALTER TABLE `attaques`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pokemons`
--
ALTER TABLE `pokemons`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pokemon_attaques`
--
ALTER TABLE `pokemon_attaques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pokemon_id` (`pokemon_id`),
  ADD KEY `attaque_id` (`attaque_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `attaques`
--
ALTER TABLE `attaques`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT pour la table `pokemons`
--
ALTER TABLE `pokemons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT pour la table `pokemon_attaques`
--
ALTER TABLE `pokemon_attaques`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `pokemon_attaques`
--
ALTER TABLE `pokemon_attaques`
  ADD CONSTRAINT `pokemon_attaques_ibfk_1` FOREIGN KEY (`pokemon_id`) REFERENCES `pokemons` (`id`),
  ADD CONSTRAINT `pokemon_attaques_ibfk_2` FOREIGN KEY (`attaque_id`) REFERENCES `attaques` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
