<?php
/**
 * Created by PhpStorm.
 * User: Jones
 * Date: 24.11.2016
 * Time: 10:27
 */

namespace Source\Models\DAOs;

use Source\Models\DBAdapters\DatabaseAdapter;
use Source\Models\User;

class UserDAO extends AbstractDAO {

    private $table;

    /**
     * AbstractDAO constructor.
     * @param DatabaseAdapter $dbAdapter
     */
    public function __construct(DatabaseAdapter $dbAdapter) {
        parent::__construct($dbAdapter);
        $this->table = $this->tables['user_table'];
    }

    /**
     * Creates a new User and saves it into the database.
     * @param $email - the users email adress
     * @param $password - the users password
     * @param $role - the users role
     * @param $token - the security token
     * @returns string | false - the id or false if inserting was not possible
     */
    public function createUser($email, $password, $role, $token) {
        $verified = false;
        $createdAt = date($this->dbAdapter->getDateFormat());
        $updatedAt = $createdAt;
        $values = compact('id', 'email', 'password', 'role', 'token', 'verified', 'createdAt', 'updatedAt');
        return $this->fpdo->insertInto($this->table, $values)->execute();
    }

    /**
     * Returns all Users.
     * @return array|null - the user table represented as an array of User-objects
     * @throws
     */
    public function getUsers() {
        $users = null;
        $query = $this->fpdo->from($this->table);
        foreach ($query as $row) {
            $user = new User($row["id"],
                $row["email"],
                $row["password"],
                $row["role"],
                $row["token"],
                $row["verified"],
                $row["createdAt"],
                $row["updatedAt"]);
            $users[] = $user;
        }
        return $users;
    }

    /**
     * Returns a user for a given email adress.
     * @param $email
     * @return null|User
     */
    public function getUserByEmail($email) {
        $user = null;
        $result = $this->fpdo->from($this->table)->where('email', $email)->fetch();
        if ($result) {
            $user = new User($result["id"],
                $result["email"],
                $result["password"],
                $result["role"],
                $result["token"],
                $result["verified"],
                $result["createdAt"],
                $result["updatedAt"]);
        }
        return $user;
    }

    /**
     * @param $id
     * @return null|User
     */
    public function getUserByID($id) {
        $user = null;
        try {
            $sql_query = sprintf('SELECT * FROM' . ' %s WHERE id = :id', $this->table);
            $stmt = $this->dbAdapter->getConnection()->prepare($sql_query);
            $stmt->execute(compact('id'));
            $result = $stmt->fetch();
            if ($result) {
                $user = new User($result["id"],
                    $result["email"],
                    $result["password"],
                    $result["role"],
                    $result["token"],
                    $result["verified"],
                    $result["createdAt"],
                    $result["updatedAt"]);
            }
        } catch (\PDOException $e) {
            throw $e;
        }
        return $user;
    }

    /**
     * @param User $user
     * @return User the updated User-Object
     */
    public function updateUser(User $user) {
        $id = $user->getID();
        $email = $user->getEmail();
        $pw = $user->getPassword();
        $role = $user->getRole();
        $token = $user->getToken();
        $verified = $user->isVerified();
        $createdAt = $user->getCreatedAt();
        $updatedAt = $user->getUpdatedAt();
        try {
            $sql_query = sprintf('UPDATE ' . '%s SET email=:email, password=:pw, role=:role, token=:token, 
                verified=:verified, createdAt=:createdAT, updatedAt=:updatedAT WHERE id=:id', $this->table);
            $stmt = $this->dbAdapter->getConnection()->prepare($sql_query);
            $stmt->execute(compact('email', 'pw', 'role', 'token', 'verified', 'createdAt', 'updatedAt', 'id'));
        } catch (\PDOException $e) {
            throw $e;
        }
        return $user;
    }

    /**
     * @param $id
     * @return bool | int 1 if it was a success, false if it failed
     */
    public function deleteUser($id) {
        return $this->fpdo->deleteFrom($this->table,$id)->execute();
    }

}