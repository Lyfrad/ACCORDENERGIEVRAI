<?php

namespace App;

use PDO;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Page
{
    private Environment $twig;
    private PDO $pdo;
    public $session;

    function __construct()
    {
        $this->session = new Session();

        try {
            $this->pdo = new \PDO('mysql:host=mysql;dbname=ProjetPHP', "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            die();
        }

        $loader = new FilesystemLoader('../templates');
        $this->twig = new Environment($loader, [
            'cache' => '../var/cache/compilation_cache',
            'debug' => true
        ]);
    }

    public function renderTable(string $table_name, array $data)
    {
        // Assurez-vous que la table_name fournie est valide pour éviter les attaques d'injection SQL
        $valid_tables = ['user', 'intervention', 'statut', 'commentaire', 'intervenantintervention'];
        if (!in_array($table_name, $valid_tables)) {
            throw new InvalidArgumentException("Nom de table invalide.");
        }

        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table_name ($columns) VALUES ($values)";
        $stmt = $this->pdo->prepare($sql);

        // Affichage des données pour débogage
        //echo "Requête SQL : $sql <br>";
        //echo "Données insérées : <pre>" . print_r($data, true) . "</pre>";

        $stmt->execute($data);
    }

    public function getUserByUsername(string $email)
    {
        $sql = "SELECT * FROM user WHERE mail = :mail";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':mail' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllInterventions()
    {
        $sql = "SELECT * FROM intervention";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    

    public function getInterventionByDate(string $date)
    {
        $sql = "SELECT * FROM intervention WHERE date_prevue = :date";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':date' => $date]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    
    // Pour supprimer une intervention
    public function deleteIntervention(int $idIntervention)
    {
        $sql = "DELETE FROM intervention WHERE idIntervention = :idIntervention";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':idIntervention' => $idIntervention]);
        // Retourne le nombre de lignes affectées
        return $stmt->rowCount();
    }


    // Pour modifier une intervention
    public function updateIntervention(array $data)
    {
        $sql = "UPDATE intervention SET 
                date_prevue = :date_prevue,
                id_client = :id_client,
                date_fin = :date_fin,
                date_debut = :date_debut,
                statut = :statut,
                degre_urgence = :degre_urgence,
                id_standardiste = :id_standardiste,
                commentaire = :commentaire
                WHERE idIntervention = :idIntervention";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);

        return $stmt->rowCount();
    }



    // Pour l'affichage des interventions d'un seul utilisateur
    public function getUserInterventions()
    {
        $idUser = $_SESSION["idUser"] ?? null;
        if ($idUser) {
            $sql = "SELECT * FROM intervention WHERE id_client = :idUser";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':idUser' => $idUser]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Gérer le cas où aucun utilisateur n'est connecté
            return [];
        }
    }




    // Pour lire la liste des utilisateurs
    public function getAllUsers()
    {
        $sql = "SELECT * FROM user";
        $stmt = $this->pdo->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Regrouper les utilisateurs par statut
        $usersByStatut = [];
        foreach ($users as $user) {
            $usersByStatut[$user['statut']][] = $user;
        }

        return $usersByStatut;
    }



    // Pour modifier le statut d'un utilisateur
    public function updateUserStatut(int $userId, int $newStatut)
    {
        $sql = "UPDATE user SET statut = :statut WHERE idUser = :userId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':statut' => $newStatut, ':userId' => $userId]);

        // Si la mise à jour réussi
        return $stmt->rowCount() > 0;
    }




    // Pour supprimer un utilisateur
    public function deleteUser(int $userId)
    {
        $sql = "DELETE FROM user WHERE idUser = :userId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':userId' => $userId]);

        // Si la suppression réussi
        return $stmt->rowCount() > 0;
    }




    // Pour créer une nouvelle intervention
    public function addIntervention(array $data)
    {
        $sql = "INSERT INTO intervention (date_prevue, id_client, date_fin, date_debut, statut, degre_urgence, id_standardiste, commentaire) VALUES (:date_prevue, :id_client, :date_fin, :date_debut, :statut, :degre_urgence, :id_standardiste, :commentaire)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
    }




    // Pour vérifier le mot de passe de l'utilisateur
    public function getPasswordByUser(string $email)
    {
        $sql = "SELECT password FROM user WHERE mail = :mail";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':mail' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['password']; // Retourne directement le mot de passe
    }





    public function render(string $name, array $data): string
    {
        return $this->twig->render($name, $data);
    }
}
