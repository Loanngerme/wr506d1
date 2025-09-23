<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Acteur;
use App\Entity\Movie;
use App\Entity\Category;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Person($faker));

        // --- Création des acteurs ---
        $actors = $faker->actors($gender = null, $count = 50, $duplicates = false);

        foreach ($actors as $item) {
            $actor = new Acteur();

            // Découpe prénom + nom
            $names = explode(' ', $item);
            $firstname = $names[0] ?? '';
            $lastname = $names[1] ?? '';

            $actor->setFirstname($firstname);
            $actor->setLastname($lastname);

            // Date de naissance (DateTime)
            $actor->setDob($faker->dateTimeThisCentury());

            // Création automatique avec DateTimeImmutable pour éviter l'erreur "cannot be null"
            $actor->setCreatedAt(
                \DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-100 years', 'now'))
            );

            $manager->persist($actor);
        }


        // --- Création des films ---
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));
        $movies = $faker->movies(100);

        foreach ($movies as $item) {
            $movie = new Movie();
            $movie->setTitle($item);
            $movie->setReleaseDate($faker->dateTimeBetween('-50 years', 'now'));
// Assigner createdAt avec DateTimeImmutable
            $movie->setCreatedAt(
                \DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-5 years', 'now'))
            );

            $manager->persist($movie);

        }

        $categories = ['Action', 'Comedy', 'Drama', 'Horror', 'Sci-Fi', 'Romance', 'Thriller'];

        foreach ($categories as $name) {
            $category = new Category();
            $category->setName($name);

            // Assigner createdAt avec DateTimeImmutable
            $category->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($category);
        }



        // Sauvegarde en BDD
        $manager->flush();
    }
}