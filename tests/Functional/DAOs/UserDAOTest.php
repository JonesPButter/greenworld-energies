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

class UserDAOTest extends BaseDAOTest {

    /**
     * Test the CRUD-Operations
     */
    public function testCRUD() {
        $this->init();
        $userDAO = new UserDAO($this->dbAdapter);

        // *** Get all Users ***
        $usertable = $userDAO->getUsers();
        $numberOfUsers = count($usertable);
        $this->assertNotEmpty($usertable,"The user table is empty.");
        for($i=0; $i<10; $i++){
            $randomNumber = rand(0,$numberOfUsers-1);
            $randomUser = $usertable[$randomNumber];
            $this->assertTrue($randomUser instanceof User, "The given Object ist not an instance of User.");
        }

        // *** Create User ***
        $email = "123456789@123456789.de";
        $userDAO->createUser($email,"password", "user", "" );
        $user = $userDAO->getUserByEmail($email);
        $this->assertNotEmpty($user, "The user couldn't be created.");
        $this->assertTrue($user instanceof User, "The given Object ist not an instance of User.");
        $this->assertEquals($user->getEmail(),$email, "The given user is not the expected one.");

        // *** Get User By ID ***
        $anotherUser = $userDAO->getUserByID($user->getId());
        $this->assertEquals($anotherUser, $user, "The User-objects aren't equal.");

        // *** Get User by email
        $anotherUser = $userDAO->getUserByEmail($user->getEmail());
        $this->assertEquals($anotherUser, $user, "The User-objects aren't equal.");

        // *** Delete User ***
        $userDAO->deleteUser($user->getId());
        $anotherUser = $userDAO->getUserByID($user->getId());
        $this->assertEquals($anotherUser, null, "The User couldn't be deleted.");
    }
}