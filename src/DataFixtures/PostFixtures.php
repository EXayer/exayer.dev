<?php

namespace App\DataFixtures;

use Faker;
use DateTime;
use App\Entity\Tag;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        $tags = $manager->getRepository(Tag::class)->findAll();
        $user = $manager->getRepository(User::class)->findOneBy([]);

        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->setSlug($this->faker->unique()->slug(3));
            $post->setUser($user);
            $post->setTitle($this->faker->sentence);
            $post->setBody($this->faker->text($maxNbChars = 65000));
            $post->setDescription($this->faker->text($maxNbChars = 255));
            $post->addTag($tags[array_rand($tags)]);
            $post->addTag($tags[array_rand($tags)]);
            $post->setPublishedAt(new DateTime());
            $manager->persist($post);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            TagFixtures::class,
        );
    }
}