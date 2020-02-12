<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Path", mappedBy="driver")
     */
    private $ownedPath;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Path", mappedBy="passengers")
     */
    private $participatedPaths;

    public function __construct()
    {
        $this->ownedPath = new ArrayCollection();
        $this->participatedPaths = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Collection|Path[]
     */
    public function getOwnedPath(): Collection
    {
        return $this->ownedPath;
    }

    public function addPath(Path $path): self
    {
        if (!$this->ownedPath->contains($path)) {
            $this->ownedPath[] = $path;
            $path->setDriver($this);
        }

        return $this;
    }

    public function removePath(Path $path): self
    {
        if ($this->ownedPath->contains($path)) {
            $this->ownedPath->removeElement($path);
            // set the owning side to null (unless already changed)
            if ($path->getDriver() === $this) {
                $path->setDriver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Path[]
     */
    public function getParticipatedPaths(): Collection
    {
        return $this->participatedPaths;
    }

    public function addParticipatedPath(Path $participatedPath): self
    {
        if (!$this->participatedPaths->contains($participatedPath)) {
            $this->participatedPaths[] = $participatedPath;
            $participatedPath->addPassenger($this);
        }

        return $this;
    }

    public function removeParticipatedPath(Path $participatedPath): self
    {
        if ($this->participatedPaths->contains($participatedPath)) {
            $this->participatedPaths->removeElement($participatedPath);
            $participatedPath->removePassenger($this);
        }

        return $this;
    }
    
}
