<?php

namespace App\EntityListener;

use App\Entity\Users;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserListener
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function prePersist(Users $user): void
    {
        $this->encodePassword($user);
    }

    public function preUpdate(Users $user): void
    {
        $this->encodePassword($user);
    }

    /**
     * Encode password based on plain password.
     */
    public function encodePassword(Users $user): void
    {
        if (null === $user->getPlainPassword()) {
            return;
        }
        $user->setPassword(
            $this->hasher->hashPassword(
                $user,
                $user->getPlainPassword()
            )
        );
        $user->setPlainPassword(null);
    }
}
