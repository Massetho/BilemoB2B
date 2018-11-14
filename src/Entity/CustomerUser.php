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
     * @var string $name A name property - this description will be available in the API documentation too.
     * @ORM\Column
     * @Assert\NotBlank
     * @Groups({"list", "write", "detail"})
     */
    public $name;

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