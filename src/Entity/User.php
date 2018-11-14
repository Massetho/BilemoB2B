<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *     "get"={"access_control"="is_granted('ROLE_SUPER_ADMIN')", "normalization_context"={"groups"={"list"}}},
 *     "post"={"access_control"="is_granted('ROLE_ADMIN')"}
 *     },
 *     itemOperations={
 *     "get"={"access_control"="(is_granted('ROLE_ADMIN') and object == user) or is_granted('ROLE_SUPER_ADMIN')", "normalization_context"={"groups"={"list", "detail"}}},
 *     "put"={"access_control"="(is_granted('ROLE_ADMIN') and object == user) or is_granted('ROLE_SUPER_ADMIN')"},
 *     "delete"={"access_control"="is_granted('ROLE_ADMIN')"}
 *     }
 * )
 * @ORM\Entity
 * @UniqueEntity("username", message="Username already taken")
 * @UniqueEntity("email", message="Email already taken")
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("list")
     */
    private $id;

    /**
     * @var string $username A name property - this description will be available in the API documentation too.
     *
     * @ORM\Column
     * @Assert\NotBlank
     * @Groups("list")
     */
    private $username;

    /**
     * @var string $email
     *
     * @ORM\Column
     * @Assert\NotBlank
     * @Assert\Email
     * @Groups("detail")
     */
    private $email;

    /**
     * @var array $roles
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @var string $password
     * @ORM\Column(type="string", length=500)
     */
    private $password;

    /**
     * @var \DateTime $dateCreated
     * @ORM\Column(type="datetime", name="date_created")
     * @Groups("detail")
     */
    private $dateCreated;

    /**
     * @var string $plainPassword
     */
    private $plainPassword;

    /**
     * @ORM\OneToMany(targetEntity="CustomerUser", mappedBy="user", cascade={"persist"})
     */
    private $customerUsers;

    public function __construct()
    {
        $this->customerUsers = new ArrayCollection();
    }

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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
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
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateCreated
     */
    public function setDateCreated(\DateTime $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return mixed
     */
    public function getCustomerUsers()
    {
        return $this->customerUsers;
    }

    /**
     * @param mixed $customerUsers
     */
    public function setCustomerUsers($customerUsers): void
    {
        $this->customerUsers = $customerUsers;
    }

    /**
     * @see UserInterface
     * @return array
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array $roles
     * @return User
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function addCustomerUser(CustomerUser $customerUser): void
    {
        $customerUser->user = $this;
        $this->customerUsers->add($customerUser);
    }

    public function removeCustomerUser(CustomerUser $customerUser): void
    {
        $customerUser->user = null;
        $this->customerUsers->removeElement($customerUser);
    }


    //NEEDED FUNCTIONS FOR USERINTERFACE
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function eraseCredentials()
    {
    }
}