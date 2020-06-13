<?php
namespace App\Tests\Entity;

use App\Entity\Path;
use PHPUnit\Framework\TestCase;
use App\Entity\User;

final class UserTest extends TestCase
{

    protected $user;

    public function setUp(): void
    {
        $this->user = new User();
    }

    public function testIdShouldBeNull()
    {
        $this->assertInstanceOf(User::class, $this->user);
        $this->assertNull($this->user->getId());
    }

    public function testShouldSetFirstName() {
        $this->user->setFirstName("Adil");
        $this->assertEquals("Adil", $this->user->getFirstName());
    }

    public function testShouldSetLastName() {
        $this->user->setLastName("Sajide");
        $this->assertEquals("Sajide", $this->user->getLastName());
    }
    public function testShouldSetEmail() {
        $this->user->setEmail("test@free.fr");
        $this->assertEquals("test@free.fr", $this->user->getEmail());
    }
    public function testShouldSetRole() {
        $roles[] = 'ROLE_USER';
        $this->user->setRoles($roles);
        $this->assertIsArray($this->user->getRoles());
        $this->assertEquals("ROLE_USER", $this->user->getRoles()[0]);
    }
    public function testShouldSetPassword() {
        $this->user->setPassword("azerty");
        $this->assertEquals("azerty", $this->user->getPassword());
    }

    public function testShouldAddPath() {
        $path = new Path();
        $this->user->addPath($path);
        $this->assertInstanceOf(Path::class, $this->user->getOwnedPaths()[0]);
    }
    public function testShouldAddParticipatedPath() {
        $path = new Path();
        $this->user->addParticipatedPath($path);
        $this->assertInstanceOf(Path::class, $this->user->getParticipatedPaths()[0]);
    }

    public function testShouldRemovePath() {
        $path = new Path();
        $this->user->addPath($path);
        $this->user->removePath($path);
        $this->assertEmpty($this->user->getOwnedPaths());
    }

    public function testShouldRemoveParticipatedPath() {
        $path = new Path();
        $this->user->addParticipatedPath($path);
        $this->user->removeParticipatedPath($path);
        $this->assertEmpty($this->user->getParticipatedPaths());
    }
}