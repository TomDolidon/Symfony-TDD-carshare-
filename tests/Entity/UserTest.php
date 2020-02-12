<?php
namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\User;

final class UserTest extends TestCase
{

    protected $user;

    public function setUp(): void
    {
        $this->user = new User();
    }

    public function testNewUser()
    {
        $this->assertInstanceOf(User::class, $this->user);
        $this->assertNull($this->user->getId());
    }

    public function testUserFirstName() {
        $this->user->setFirstName("Adil");
        $this->assertEquals("Adil", $this->user->getFirstName());
    }

    public function testUserLastName() {
        $this->user->setLastName("Sajide");
        $this->assertEquals("Sajide", $this->user->getLastName());
    }


}