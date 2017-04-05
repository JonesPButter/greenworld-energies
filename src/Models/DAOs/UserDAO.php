<?php
/**
 * Created by PhpStorm.
 * User: Jones
 * Date: 24.11.2016
 * Time: 10:27
 */

namespace Source\Models\DAOs;

use Source\Models\User;

class UserDAO extends AbstractDAO {

    /**
     * Creates a new User and saves it into the database.
     * @param $email - the users email adress
     * @param $password - the users password
     * @param $role - the users role
     * @param $token - the security token
     * @return User - the created user
     * @throws \PDOException
     */
    public function createUser($email, $password, $role, $token) {
        $date = date($this->dbAdapter->getDateformat());
        $user = new User(null, $email, $password, $role, $token,false, $date,$date);
        try{
            $sql_query = sprintf('INSERT INTO' . ' %s (id, email, password, role, token, verified, createdAt, updatedAt) 
                VALUES (NULL, :email, :password, :role, :token, false, :date, :date)',$this->tablename);
            $stmt = $this->dbAdapter->getConnection()->prepare($sql_query);
            $stmt->execute(compact('email', 'password', 'role', 'token', 'date'));
        } catch (\PDOException $e) {
            throw $e;
        }
        return $user;
    }

    /**
     * Returns all Users.
     * @return array|null - the usertable represented as an array of User-objects
     * @throws
     */
    public function getUsers() {
        $users = null;
        try {
            $sql_query = sprintf('SELECT * FROM' . ' %s',$this->tablename);
            $result = $this->dbAdapter->getConnection()->query($sql_query);
            if($result){
                foreach($result as $row){
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
            }
        } catch (\Exception $e) {
            throw $e;
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
        try {
            $sql_query = sprintf('SELECT * FROM' . ' %s WHERE email = :email',$this->tablename);
            $stmt = $this->dbAdapter->getConnection()->prepare($sql_query);
            $stmt->execute(compact('email'));
            $result = $stmt->fetch();
            if($result){
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
     * @param $id
     * @return null|User
     */
    public function getUserByID($id) {
        $user = null;
        try {
            $sql_query = sprintf('SELECT * FROM' . ' %s WHERE id = :id',$this->tablename);
            $stmt = $this->dbAdapter->getConnection()->prepare($sql_query);
            $stmt->execute(compact('id'));
            $result = $stmt->fetch();
            if($result){
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
                verified=:verified, createdAt=:createdAT, updatedAt=:updatedAT WHERE id=:id',$this->tablename);
            $stmt = $this->dbAdapter->getConnection()->prepare($sql_query);
            $stmt->execute(compact('email','pw', 'role','token','verified','createdAt','updatedAt','id'));
        } catch (\PDOException $e) {
            throw $e;
        }
        return $user;
    }

    public function deleteUser($id){
        try {
            $sql_query = sprintf('DELETE FROM' . ' %s WHERE id = :id',$this->tablename);
            $stmt = $this->dbAdapter->getConnection()->prepare($sql_query);
            $stmt->execute(compact('id'));
        } catch (\PDOException $e) {
            throw $e;
        }
    }

}