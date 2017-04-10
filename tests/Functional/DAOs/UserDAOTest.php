<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 04.04.2017
 * Time: 15:47
 */

namespace Tests\Functional\DAOs;


use Slim\App;
use Source\Models\DAOs\UserDAO;
use Source\Models\DBAdapters\DatabaseAdapter;
use Source\Models\User;

/**
 * Class UserDAOTest
 *
 * This class is testing the UserDAOs functionality.
 *
 * @package Tests\Functional\DAOs
 */
class UserDAOTest extends BaseDAOTest {

    /**
     * Tests if user can be created.
     */
    public function testCreateUser() {
        $this->init();
        $userDAO = new UserDAO($this->dbAdapter);

        // Case 1. A user can be created
        $email = "test@test.de";
        $id = $userDAO->createUser($email, "password", "user", "");
        $user = $userDAO->getUserByID($id);

        $this->assertNotEmpty($user);
        $this->assertTrue($user instanceof User);
        $this->assertEquals($user->getID(), $id);
        $this->assertEquals($email,$user->getEmail());

        // Case 2. A user can't be created if there is already another user with the same email address
        $idTwo = $userDAO->createUser("test@test.de", "password", "user", "");
        $this->assertFalse($idTwo);

        // rollback
        $userDAO->deleteUser($id);
    }

    /**
     * Tests if users can be deleted.
     */
    public function testDeleteUser() {
        $this->init();
        $userDAO = new UserDAO($this->dbAdapter);

        // Case 1. A created user can be deleted.
        $id = $userDAO->createUser("willBeDeleted@test.de", "password", "user", "");
        $result = $userDAO->deleteUser($id);

        $this->assertTrue(1 == $result); // 1 removed rows from the table
        $user = $userDAO->getUserByID($id); // trying to still get the deleted user by his id
        $this->assertNull($user);

        // Case 2. A non existent user can't be deleted.
        $unknownID = "99ASD675JJUFNAK1242";
        $result = $userDAO->deleteUser($unknownID);
        $this->assertTrue(0 == $result);
    }
    /**
     * Tests if users can be found by their id.
     */
    public function testGetUserById() {
        $this->init();
        $userDAO = new UserDAO($this->dbAdapter);

        $email = "test@test.de";
        $password = "password";
        $role = "user";
        $token = "";

        // Case 1. A created user can be found by his id
        $id = $userDAO->createUser($email, $password, $role, $token);
        $user = $userDAO->getUserByID($id);

        $this->assertEquals($user->getID(), $id);
        $this->assertEquals($user->getEmail(), $email);
        $this->assertEquals($user->getPassword(), $password);

        // Case 2. A non existent user can't be found.
        $unknownID = "99ASD675JJUFNAK1242";
        $user = $userDAO->getUserByID($unknownID);
        $this->assertNull($user);

        // rollback
        $userDAO->deleteUser($id);
    }

    /**
     * Tests if users can be found by their email address.
     */
    public function testGetUserByEmail() {
        $this->init();
        $userDAO = new UserDAO($this->dbAdapter);

        $email = "test@test.de";
        $password = "password";
        $role = "user";
        $token = "";

        // Case 1. A created User can be found by his email address
        $id = $userDAO->createUser($email, $password, $role, $token);
        $user = $userDAO->getUserByEmail($email);

        $this->assertEquals($user->getID(), $id);
        $this->assertEquals($user->getEmail(), $email);
        $this->assertEquals($user->getPassword(), $password);

        // Case 2. A non existent user can't be found.
        $unknownEmail = "99ASD675JJUF@NAK1242.de";
        $user = $userDAO->getUserByEmail($unknownEmail);
        $this->assertNull($user);

        // rollback
        $userDAO->deleteUser($id);
    }


    /**
     * Tests if the user table is available.
     */
    public function testGetUsers() {
        $this->init();
        $userDAO = new UserDAO($this->dbAdapter);

        // Case 1. All object are instances of users
        $usertable = $userDAO->getUsers();
        $numberOfUsers = count($usertable);
        for ($i = 0; $i < 10; $i++) {
            $randomNumber = rand(0, $numberOfUsers - 1);
            $randomUser = $usertable[$randomNumber];
            $this->assertTrue($randomUser instanceof User);
        }
    }

}