<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    private $hasher;

    static $users = [
        'admin' => ['admin', ['ADMIN']],
        'user' => ['user', ['USER']],
    ];

    public function __construct(UserPasswordHasherInterface $hasher) 
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::$users as $name => $u) {
            $entity = (new User()) 
                ->setUsername($name)
                ->setRoles($u[1])
            ;
            $entity->setPassword($this->hasher->hashPassword($entity, $u[0]));
            $manager->persist($entity);
        }
        $manager->flush();
    }
}
