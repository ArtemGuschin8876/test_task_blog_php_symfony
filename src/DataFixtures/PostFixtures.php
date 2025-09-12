<?php

namespace App\DataFixtures;

use App\Post\Entity\Post;
use App\User\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;
final class PostFixtures extends Fixture implements FixtureGroupInterface
{

    public static function getGroups(): array { return ['posts']; }

    /**
     * @throws ORMException
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('ru_RU');
        $postsToCreate = 4000;

        /** @var EntityManagerInterface $em */
        $em = $manager;

        $conn = $em->getConnection();
        /** @var int[] $userIds */
        $userIds = array_map('intval', $conn->fetchFirstColumn('SELECT id FROM users'));

//        $raw = $manager->getRepository(User::class)
//            ->createQueryBuilder('u')
//            ->select('u.id')
//            ->getQuery()
//            ->getScalarResult();

//        $userIds = array_map(static fn(array $r) => (int)$r['id'], $raw);
        if (!$userIds) {
            return;
        }

        for ($i = 0; $i < $postsToCreate; $i++)
        {
            $title = $faker->unique()->sentence(6, true);
            $content = implode("\n\n", $faker->paragraphs(mt_rand(2, 6)));

            $authorId = $userIds[array_rand($userIds)];
            $author = $em->getReference(User::class, $authorId);

            $post = new Post($author, $title, $content);

            $em->persist($post);

            if ($i > 0 && $i % 200 === 0) {
                $em->flush();
                $em->clear();
            }
        }
        $em->flush();
    }
}
