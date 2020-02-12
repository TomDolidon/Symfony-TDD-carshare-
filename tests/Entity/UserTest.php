<?php


namespace App\Tests\Entity;



use App\Entity\User;

final class UserTest extends TestCase
{

    public function testNewUser()
    {
        $user = new User();
        $this->assertInstanceOf(User::class, $user);
        $this->assertNull($user->getId());
    }

    public function testUserName() {
        $user = new User();
        $user->setName("Adil");
        $this->assertEquals("Adil", $user->getName());
    }


}