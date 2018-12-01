<?php

namespace App\UMS\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\ORMInvalidArgumentException;

/**
 * @ORM\Table(name="ums_user")
 * @ORM\Entity(repositoryClass="App\UMS\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): self
    {
        if (trim($name) === '')
            throw new ORMInvalidArgumentException('Name should not be empty');

        $this->name = $name;

        return $this;
    }
}
