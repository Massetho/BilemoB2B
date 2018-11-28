<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\User;

/**
 *
 * @ApiResource(
 *     collectionOperations={
 *     "get"={"normalization_context"={"groups"={"list"}}},
 *     "post"={"denormalization_context"={"groups"={"write"}}}
 *     },
 *     itemOperations={
 *     "get"={"normalization_context"={"groups"={"detail"}}},
 *     "delete"={"access_control"="(is_granted('ROLE_ADMIN') and object.user == user) or is_granted('ROLE_SUPER_ADMIN')"}
 *     }
 * )
 * @ORM\Entity
 */
class CustomerUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var string $name Customer name (needed).
     * @ORM\Column
     * @Assert\NotBlank
     * @Groups({"list", "write", "detail"})
     */
    public $name;

    /**
     * @var string $country Customer country.
     * @ORM\Column
     * @Groups({"write", "detail"})
     */
    public $country;

    /**
     * @var string $town Customer town.
     * @ORM\Column
     * @Groups({"write", "detail"})
     */
    public $town;

    /**
     * @var string $email Customer Mail (needed).
     * @ORM\Column
     * @Assert\NotBlank
     * @Assert\Email
     * @Groups({"write", "detail"})
     */
    public $email;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="customerUsers")
     * @ORM\JoinColumn(nullable=true)
     */
    public $user;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getTown(): string
    {
        return $this->town;
    }

    /**
     * @param string $town
     */
    public function setTown(string $town): void
    {
        $this->town = $town;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

}