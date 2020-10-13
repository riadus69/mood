<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct (UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('user1');
        #chiffrement du mot de passe
        $user->setPassword($this->encoder->encodePassword($user, 'admin'));
        $user->setAvatar('avatar1');
        $manager->persist($user);
        $manager->flush();

        $user2 = new User();
        $user2->setUsername('user2');
        #chiffrement du mot de passe
        $user2->setPassword($this->encoder->encodePassword($user2, 'admin'));
        $user2->setAvatar('avatar2');
        $manager->persist($user2);
        $manager->flush();

        $user3 = new User();
        $user3->setUsername('user3');
        #chiffrement du mot de passe
        $user3->setPassword($this->encoder->encodePassword($user3, 'admin'));
        $user3->setAvatar('avatar3');
        $manager->persist($user3);
        $manager->flush();


    }
}