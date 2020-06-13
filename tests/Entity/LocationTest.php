<?php

namespace App\Tests\Entity;

use App\Entity\Location;
use App\Entity\Path;
use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    protected $location;
    public function setUp(): void
    {
        $this->location = new Location();
    }

    public function testShouldBeInstanceOfLocation()
    {
        $this->assertInstanceOf(Location::class, $this->location);
    }

    public function testToStringShouldReturnName()
    {
        $this->location->setName("Grenoble");
        $this->assertSame($this->location->__toString(), "Grenoble");
    }

    public function testShouldSetAName()
    {
        $this->location->setName("Grenoble");
        $this->assertSame($this->location->getName(), "Grenoble");
    }

    public function testShouldSetLat()
    {
        $this->location->setLat(1.25);
        $this->assertSame($this->location->getLat(), 1.25);
    }

    public function testShouldSetLon()
    {
        $this->location->setLon(1.33);
        $this->assertSame($this->location->getLon(), 1.33);
    }

    public function testIdShouldBeNull()
    {
        $this->assertNull($this->location->getId());
    }

    public function testShouldAddStartPath()
    {
        $path = new Path();
        $this->location->addStartPath($path);
        $this->assertInstanceOf(Path::class, $this->location->getStartPaths()[0]);
    }

    public function testShouldAddEndPath()
    {
        $path = new Path();
        $this->location->addEndPath($path);
        $this->assertInstanceOf(Path::class, $this->location->getEndPaths()[0]);
    }
    public function testShouldRemoveStartPath()
    {
        $path = new Path();
        $this->location->addStartPath($path);
        $this->location->removeStartPath($path);
        $this->assertEmpty($this->location->getStartPaths());
    }
    public function testShouldRemoveEndPath()
    {
        $path = new Path();
        $this->location->addEndPath($path);
        $this->location->removeEndPath($path);
        $this->assertEmpty($this->location->getEndPaths());
    }

}