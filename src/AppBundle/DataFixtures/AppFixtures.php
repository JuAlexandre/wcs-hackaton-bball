<?php
/**
 * Created by PhpStorm.
 * User: nooneexpectme
 * Date: 18/05/18
 * Time: 05:36
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Club;
use AppBundle\Entity\Player;
use AppBundle\Entity\Pool;
use AppBundle\Entity\Stadium;
use AppBundle\Entity\Team;
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
        $clubs = [];
        for ($i=0; $i < 15; $i++) {
            $clubs[] = ['club' . $i, 'image' . $i];
        }

        $i = 0;
        foreach ($clubs as $clubEntry) {
            $club = new Club();
            $club
                ->setName($clubEntry[0])
                ->setImage($clubEntry[1]);
            $manager->persist($club);


            $this->addReference('club' . $i, $club);
            $i++;
        }

        // Create pools (name)
        $pools = ['A', 'B', 'C', 'D'];

        $i = 0;
        foreach ($pools as $poolEntry) {
            $pool = new Pool();
            $pool->setName($poolEntry);
            $manager->persist($pool);

            $this->addReference('pool' . $i, $pool);
            $i++;
        }

        // Create teams (name, flag, pool)
        $teams = [
            ['Argentine', 'AR.png', $this->getReference('pool1')],
            ['Australie', 'AU.png', $this->getReference('pool1')],
            ['France', 'BL.png', $this->getReference('pool1')],
            ['Canada', 'CA.png', $this->getReference('pool1')],
            ['Chili', 'CL.png', $this->getReference('pool2')],
            ['Chine', 'CN.png', $this->getReference('pool2')],
            ['Allemagne', 'DE.png', $this->getReference('pool2')],
            ['Danemark', 'DK.png', $this->getReference('pool2')],
            ['Espagne', 'ES.png', $this->getReference('pool3')],
            ['Finlande', 'FI.png', $this->getReference('pool3')],
            ['Grèce', 'GR.png', $this->getReference('pool3')],
            ['Jamaïque', 'JM.png', $this->getReference('pool3')],
            ['Japon', 'JP.png', $this->getReference('pool0')],
            ['Portugal', 'PT.png', $this->getReference('pool0')],
            ['Russie', 'RU.png', $this->getReference('pool0')],
            ['Suède', 'SE.png', $this->getReference('pool0')],
        ];

        $i = 0;
        foreach ($teams as $teamEntry) {
            $team = new Team();
            $team->setName($teamEntry[0]);
            $team->setFlag($teamEntry[1]);

            $id = rand(0, count($pools) -1);
            $pool = $this->getReference('pool' . $id);
            $team->setPool($pool);

            $manager->persist($team);

            $this->addReference('team' . $i, $team);
            $i++;
        }

        // Create players (firstName, lastName, age, shirtNumber, club, team, picture)
        $players = [];
        for ($i=0; $i < 80; $i++) {
            $players[] = [
                'prénom' . $i,
                'nom' . $i,
                rand(20, 35),
                rand(0, 99),
                $this->getReference('club' . rand(0, count($clubs)-1)),
                $this->getReference('team' . rand(0, count($teams)-1)),
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5b0BEo3tPAeRcAmtCQFccN4lxAIEOe2BMbHCAoFkl_2DxMWkrug '
            ];
        }

        foreach ($players as $playerEntry) {
            $player = new Player();
            $player
                ->setFirstName($playerEntry[0])
                ->setLastName($playerEntry[1])
                ->setAge($playerEntry[2])
                ->setShirtNumber($playerEntry[3])
                ->setClub($playerEntry[4])
                ->setTeam($playerEntry[5])
                ->setPicture($playerEntry[6])
            ;

            $manager->persist($player);
            $manager->flush();
        }

        // Create stadiums (city, capacity)
        $stadiums = [
            ['Orléans', 1000],
            ['Paris', 100],
            ['Marseille', 1500],
            ['Tours', 3000],
            ['Bordeaux', 3500],
            ['Lyon', 10000],
        ];

        foreach ($stadiums as $stadiumEntry) {
            $stadium = new Stadium();
            $stadium
                ->setCity($stadiumEntry[0])
                ->setCapacity($stadiumEntry[1]);
            $manager->persist($stadium);
        }

        // Create games (localTeam, visitorTeam, stadium, beginAt, isPoolGame, isFinished)

        //flush
        $manager->flush();
    }
}