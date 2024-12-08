<?php
namespace App\Classes;

use PDO;
use PDOException;

class Database {
    private static ?PDO $instance = null;

    public static function getConnection(): PDO {
        if (self::$instance === null) {
            $host = $_ENV['DB_HOST'];
            $dbname = $_ENV['DB_NAME'];
            $user = $_ENV['DB_USER'];
            $pass = $_ENV['DB_PASS'];

            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
            try {
                self::$instance = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                die("Erreur de connexion: " . $e->getMessage());
            }
        }
        return self::$instance;
    }

    public static function getAllPokemons(): array {
        $pdo = self::getConnection();
        $stmt = $pdo->query("SELECT * FROM pokemons");
        return $stmt->fetchAll();
    }

    public static function getPokemonById(int $id) {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM pokemons WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function getAttaquesByPokemonId(int $pokemonId): array {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("
            SELECT a.* FROM attaques a
            JOIN pokemon_attaques pa ON a.id = pa.attaque_id
            WHERE pa.pokemon_id = ?
        ");
        $stmt->execute([$pokemonId]);
        return $stmt->fetchAll();
    }
    
    public static function getAttaquesByType(string $type, int $limit = 3): array {
        // Récupère quelques attaques du même type (ou normal) pour l'adversaire
        $pdo = self::getConnection();
        $limit = (int)$limit; // On s'assure que c'est bien un entier
        $sql = "SELECT * FROM attaques WHERE type IN (?, 'normal') ORDER BY RAND() LIMIT $limit";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$type]);
        return $stmt->fetchAll();
    }
    
    public static function getAttaqueById(int $id) {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM attaques WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
