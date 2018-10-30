<?php
/**
 * Created by PhpStorm.
 * User: kashi
 * Date: 30/10/2018
 * Time: 14:38
 */

namespace App\DataFixtures;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;


class UserFixture
{
    private $passwordEncoder;
     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $user =  new User();


                $user->setPassword($this->passwordEncoder->encodePassword($user,
                'admin'
                ));


        }

}