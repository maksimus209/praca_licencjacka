<?php
/**
 * License information here.
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class AppFixtures.
 */
class AppFixtures extends Fixture
{
    /**
     * Loads data fixtures into the database.
     *
     * @param ObjectManager $manager the object manager for handling database operations
     */
    public function load(ObjectManager $manager): void
    {
        // Add your fixture data here

        $manager->flush();
    }
}
