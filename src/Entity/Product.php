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
 *     "get"={"access_control"="is_granted('ROLE_ADMIN')", "normalization_context"={"groups"={"list"}}},
 *     "post"={"access_control"="is_granted('ROLE_SUPER_ADMIN')", "denormalization_context"={"groups"={"write"}}}
 *     },
 *     itemOperations={
 *     "get"={"access_control"="is_granted('ROLE_ADMIN')", "normalization_context"={"groups"={"detail"}}},
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
     * @var string $name A name property - this description will be available in the API documentation too.
     *
     * @ORM\Column
     * @Assert\NotBlank
     * @Groups({"list", "detail", "write"})
     */
    public $name;

    /**
     * @var string $name A name property - this description will be available in the API documentation too.
     *
     * @ORM\Column
     * @Assert\NotBlank
     * @Groups({"list", "detail", "write"})
     */
    public $reference;

    /**
     * @var string $price A name property - this description will be available in the API documentation too.
     *
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     * @Groups({"detail", "write"})
     */
    public $price;


    /**
     * @var string $price A name property - this description will be available in the API documentation too.
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

}