<?php
/**
 * @description : Service for managing image upload
 * @Author : Quentin Thomasset
 */

namespace App\Service;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordEncryptor
{
    /**
     * @var UserPasswordEncoderInterface $passwordEncoder
     */
    private $passwordEncoder;

    /**
     * PasswordEncryptor constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param User $user
     */
    public function encodePassword(User $user)
    {
        $password = $this->passwordEncoder->encodePassword($user, $user->getPassword());
        $user->setPassword($password);
    }
}
