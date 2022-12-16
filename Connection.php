<?php

class Connection
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=mp;host=127.0.0.1', 'root', '');
    }

    public function getUserById($id)
    {
        $query = 'SELECT * FROM user WHERE id = :id';

        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert(User $user): bool
    {
        $query = 'INSERT INTO user (mail, first_name, last_name, password, date_creation_acc)
                    VALUES (:mail, :first_name, :last_name, :password, NOW())';

        $a = $this->login($user->mail, $user->password);

        if ($a) {
            echo 'Un Utilisateur avec cet email existe déja ';
            return false;
        } else {
            $statement = $this->pdo->prepare($query);
            return $statement->execute([
                'mail' => $user->mail,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'password' => md5($user->password . 'FSRTGHBVCDSEZRFG')
            ]);
        }

    }

    public function login($mail, $pass):bool
    {
        $query = "SELECT * FROM user WHERE mail = :mail and password= :password";

        $statement = $this->pdo->prepare($query);

        $statement->execute([
            'mail' => $mail,
            'password' => md5($pass . 'FSRTGHBVCDSEZRFG')
        ]);

        $user = $statement->fetchAll(PDO::FETCH_ASSOC);

        if($statement->rowCount() === 1){
            $_SESSION['user_id'] = $user[0]['id'];
            var_dump($_SESSION);
            return true;
        }
        else{
            return false;
        }

    }

    public function insertRenovation(Renovation $renovation): bool
    {
        $query = 'INSERT INTO `réservation_renovation` 
        (product_name, description, heure_de_reservation, en_boutique, user_id) 
        VALUES(:product_name, :description, :heure_de_reservation, :en_boutique, :user_id)';

        $stmt = $this->pdo->prepare($query);

        return $stmt->execute([
            'product_name' => $renovation->productName, 
            'description' => $renovation->description, 
            'heure_de_reservation' => $renovation->reservationDate,
            'en_boutique' => $renovation->inStore, 
            'user_id' => $renovation->userId
        ]);
    }

    public function insert_phone($telephone): bool
    {
        $query = 'UPDATE user SET telephone = :telephone WHERE id = :id';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
                'telephone' => $telephone,
                'id' => $_SESSION['user_id']
            ]);
    }

    public function insert_mail($data_mail): bool
    {
        $query = 'UPDATE user SET mail = :mail WHERE id = :id';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
                'mail' => $data_mail,
                'id' => $_SESSION['user_id']
            ]);
    }

    public function insert_mdp($password): bool
    {
        $query = 'UPDATE user SET password = :password WHERE id = :id';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
                'password' => md5($password . 'FSRTGHBVCDSEZRFG'),
                'id' => $_SESSION['user_id']
            ]);
    }

    public function insert_adress($adresse): bool
    {
        $query = 'UPDATE user SET adresse = :adress WHERE id = :id';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
                'adress' => $adresse,
                'id' => $_SESSION['user_id']
            ]);
    }

    public function insert_names($first_name, $last_name): bool
    {
        $query = 'UPDATE user SET first_name = :first_name, last_name = :last_name WHERE id = :id';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'id' => $_SESSION['user_id']
            ]);
    }
}