<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *     "get"={"normalization_context"={"groups"={"list"}}},
 *     "post"={"access_control"="is_granted('ROLE_SUPER_ADMIN')", "denormalization_context"={"groups"={"write"}}}
 *     },
 *     itemOperations={
 *     "get"={"normalization_context"={"groups"={"detail"}}},
 *     "put"={"access_control"="is_granted('ROLE_SUPER_ADMIN')", "denormalization_context"={"groups"={"write"}}},
 *     "delete"={"access_control"="is_granted('ROLE_SUPER_ADMIN')"}
 *     })
 * @ORM\Entity
 */
class Product
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var string $name Product name.
     *
     * @ORM\Column
     * @Assert\NotBlank
     * @Groups({"list", "detail", "write"})
     */
    public $name;

    /**
     * @var string $name Product reference/SKU.
     *
     * @ORM\Column
     * @Assert\NotBlank
     * @Groups({"list", "detail", "write"})
     */
    public $reference;

    /**
     * @var string $price Product price.
     *
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     * @Groups({"detail", "write"})
     */
    public $price;


    /**
     * @var string $description A short description of the product.
     *
     * @ORM\Column
     * @Assert\Length(
     *     min = 4,
     *     max = 500,
     *     groups={"postValidation"}
     *     )
     * @Groups({"detail", "write"})
     */
    public $description;

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
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

}