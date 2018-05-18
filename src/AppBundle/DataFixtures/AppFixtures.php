<?php
/**
 * Created by PhpStorm.
 * User: nooneexpectme
 * Date: 18/05/18
 * Time: 05:36
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Club;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        // Create clubs (name, image)
        $clubs = [
            ['First', 'https://www.google.fr/first'],
            ['Second', 'https://www.google.fr/second'],
            ['Second', 'https://www.google.fr/third']
        ];
        foreach ($clubs as $clubEntry) {
            $club = new Club();
            $club
                ->setName($clubEntry[0])
                ->setImage($clubEntry[1]);
            $manager->persist($club);
            $clubEntry[] = $club->getId();
        }

        // Create pools (name)

        // Create teams (name, flag, pool)

        // Create players (firstName, lastName, age, shirtNumber, club, team)

        // Create stadiums (city, capacity)

        // Create games (localTeam, visitorTeam, stadium, beginAt, isPoolGame, isFinished)

        // FLEUSH
        $manager->flush();
    }
}