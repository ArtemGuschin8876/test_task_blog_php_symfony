<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\User\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

final class UserFixture extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('fr_FR');
        $usersToCreate = 500;

        for ($i = 0; $i < $usersToCreate; $i++) {
            $name = $faker->name;
            $email = $faker->unique()->safeEmail;


            $user = new User($name, $email, 'tmp');
            $user->setRoles(['ROLE_USER']);

            $hashed = $this->hasher->hashPassword($user, 'password');
            $user->setPassword($hashed);

            $manager->persist($user);
            $this->addReference('user-' . $i, $user);
        }
        $manager->flush();
    }
}
