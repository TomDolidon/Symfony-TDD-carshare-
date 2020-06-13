<?php


namespace App\Tests\Entity;


use App\Entity\Path;
use App\Entity\Location;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class PathTest extends TestCase
{
    protected $path;

    public function setUp(): void
    {
        $this->path = new Path();
    }

    public function testIdShouldBeNull()
    {
        $this->assertNull($this->path->getId());
    }

    public function testShouldBeInstanceOfPath()
    {
        $this->assertInstanceOf(Path::class, $this->path);
    }

    public function testShouldSetSeats()
    {
        $this->path->setSeats(4);
        $this->assertSame($this->path->getSeats(), 4);
    }

    public function testShouldSetStartTime()
    {
        $dateTime = new \DateTime();
        $this->path->setStartTime($dateTime);
        $this->assertSame($this->path->getStartTime(), $dateTime);
    }

    public function testShouldSetStartLocation()
    {
        $location = new Location();
        $this->path->setStartLocation($location);
        $this->assertSame($this->path->getStartLocation(), $location);
    }

    public function testShouldSetEndLocation()
    {
        $location = new Location();
        $this->path->setEndLocation($location);
        $this->assertSame($this->path->getEndLocation(), $location);
    }

    public function testShouldSetDrive()
    {
        $user = new User();
        $this->path->setDriver($user);
        $this->assertSame($this->path->getDriver(), $user);
    }

    public function testShouldAddPassenger()
    {
        $user = new User();
        $this->path->addPassenger($user);
        $this->assertSame($this->path->getPassengers()[0],$user);
    }
    public function testShouldRemovePassenger()
    {
        $user = new User();
        $this->path->addPassenger($user);
        $this->path->removePassenger($user);
        $this->assertEmpty($this->path->getPassengers());
    }


    public function testShouldSetLeftSeat()
    {
        $this->path->setLeftSeats(5);
        $this->assertSame($this->path->getLeftSeats(), 5);
    }

}