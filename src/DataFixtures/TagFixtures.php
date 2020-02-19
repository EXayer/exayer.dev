<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    private $faker;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $tag = new Tag();
            $tag->setSlug($this->faker->unique()->slug(1));
            $tag->setTitle($this->faker->word);
            $manager->persist($tag);
        }

        $manager->flush();
    }
}