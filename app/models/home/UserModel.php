<?php
require_once __DIR__ . '/../../database/dbConfig/DBConnection.php';

class UserModel
{
    private ?PDO $db;

    public function __construct()
    {
        $this->db = DBConnection::openConnection();
    }

    public function userNameCorrect(string $userName): bool
    {
        $query = $this->db->prepare('SELECT COUNT(*) FROM users WHERE name = ?');
        $query->execute([$userName]);
        return $query->fetchColumn() > 0;
    }

    public function passwordVerify(string $userName, string $password): bool
    {

        $query = $this->db->prepare('SELECT password FROM users WHERE name = ? LIMIT 1');
        $query->execute([$userName]);
        $user = $query->fetch(PDO::FETCH_OBJ);

        if (!$user || empty($user->password)) {
            return false;
        }

        return password_verify($password, $user->password);
    }

    public function getUserByName(string $userName): ?object
    {
        $query = $this->db->prepare('SELECT id_user, name, email, profile_photo FROM users WHERE name = ? LIMIT 1');
        $query->execute([$userName]);
        $user = $query->fetch(PDO::FETCH_OBJ);

        return $user ?: null;
    }
}
