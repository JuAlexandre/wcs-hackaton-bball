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
            ['team1', 'flag1', $this->getReference('pool' . rand(0, count($pools)-1))],
            ['team2', 'flag2', $this->getReference('pool' . rand(0, count($pools)-1))],
            ['team3', 'flag3', $this->getReference('pool' . rand(0, count($pools)-1))],
            ['team4', 'flag4', $this->getReference('pool' . rand(0, count($pools)-1))],
            ['team5', 'flag5', $this->getReference('pool' . rand(0, count($pools)-1))],
            ['team6', 'flag6', $this->getReference('pool' . rand(0, count($pools)-1))],
            ['team7', 'flag7', $this->getReference('pool' . rand(0, count($pools)-1))],
            ['team8', 'flag8', $this->getReference('pool' . rand(0, count($pools)-1))],
            ['team9', 'flag9', $this->getReference('pool' . rand(0, count($pools)-1))],
            ['team10', 'flag10', $this->getReference('pool' . rand(0, count($pools)-1))],
            ['team11', 'flag11', $this->getReference('pool' . rand(0, count($pools)-1))],
            ['team12', 'flag12', $this->getReference('pool' . rand(0, count($pools)-1))],
            ['team13', 'flag13', $this->getReference('pool' . rand(0, count($pools)-1))],
            ['team14', 'flag14', $this->getReference('pool' . rand(0, count($pools)-1))],
            ['team15', 'flag15', $this->getReference('pool' . rand(0, count($pools)-1))],
            ['team16', 'flag16', $this->getReference('pool' . rand(0, count($pools)-1))],
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
        for ($i=0; $i < 150; $i++) {
            $players[] = [
                'prénom' . $i,
                'nom' . $i,
                rand(20, 35),
                rand(0, 99),
                $this->getReference('club' . rand(0, count($clubs)-1)),
                $this->getReference('team' . rand(0, count($teams)-1)),
                'picture' . $i
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