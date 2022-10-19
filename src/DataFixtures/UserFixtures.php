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
        'admin' => ['admin', 'admin@localhost', ['ADMIN']],
        'user' => ['user', 'user@localhost', ['USER']],
    ];

    public function __construct(UserPasswordHasherInterface $hasher) 
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::$users as $name => $u) {
            $entity = $manager->getRepository(User::class)->findOneBy(['username' => $name]);
            if (! $entity) {
                $entity = (new User()) 
                ->setUsername($name);
            }
            $entity
                ->setEmail($u[1])
                ->setRoles($u[2])
            ;
            $entity->setPassword($this->hasher->hashPassword($entity, $u[0]));
            $manager->persist($entity);
        }
        $manager->flush();
    }
}
