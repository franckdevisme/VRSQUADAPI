<?php
/**
 * Created by PhpStorm.
 * User: kashi
 * Date: 19/09/2018
 * Time: 17:38
 */

namespace App\Controller;

use App\Entity\Entreprise;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;


class UserController extends Controller
{
    /**
     * @Route("/listUser",name="listUser")
     * @Method({"GET"})
     */
    public function getUserAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        // query for a single Product by its primary key (usually "id")
        $User = $repository->findall();

        $formatted = [];
        foreach ($User as $user) {
            $formatted[] = [
                'Nom' => $user->getNom(),
                'Prénom' => $user->getPrenom(),
                'Username' => $user->getUsername(),
                'Image' => $user->getAvater(),
            ];
        }

        return new JsonResponse($formatted);

    }


    /**
     * réquper les tout User de l'entreprise
     * @Route("/UserListeByEntreprise",name="UserListeByEntreprise")
     * @Method({"POST"})
     */
    public function getUserByEntrepriseAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        // query for a single Product by its primary key (usually "id")
        $User = $repository->findBy(array('identreprise' => (int)$request->get('idEntreprise')));

        if (empty($User)) {
            return new JsonResponse(['message' => 'user not found'], Response::HTTP_NOT_FOUND);
        }

        $formatted = [];
        foreach ($User as $user) {
            $formatted[] = [
                'Nom' => $user->getnom(),
                'Prénom' => $user->prenom(),
                'Username' => $user->getUsername(),
                'Image' => $user->getAvater(),
            ];
        }

        return new JsonResponse($formatted);

    }

    private $encoderFactory;

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }


    public function getUserByUsernameAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);


            if ($request->get('password') == 'admin'){

                $user = $repository->findOneBy(array('username' => $request->get('username')));
            //$user = $repository->findOneBy(array('username' => $request->get('username')));
            /* @var $User user[] */
            if (empty($user)) {
                return new JsonResponse(['message' => 'username is not valide or password is not valide check your username or password '], Response::HTTP_NOT_FOUND);
            }

            // dump($user);
            $formatted = [];
            $formatted[] = [
                'Nom' => $user->getNom(),
                'Prénom' => $user->getPrenom(),
                'Username' => $user->getUsername(),
                'Image' => $user->getAvater(),
            ];
            return new JsonResponse($formatted);
        }
        else{
            return new JsonResponse(['message' => 'username is not valide or password is not valide check your username or password '], Response::HTTP_NOT_FOUND);
        }
    }


    public function getUserByUsernamepassworAction($username, $password)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        // query for a single Product by its primary key (usually "username")

        $user = $repository->findOneBy(array('username' => $username, 'password' => $password));
        /* @var $User user[] */
        if (empty($user)) {
            return new JsonResponse(['message' => 'username is not valide or password is not valide check your username or password '], Response::HTTP_NOT_FOUND);
        }
        $formatted = [];
        $formatted[] = [
            'Nom' => $user->getNom(),
            'Prénom' => $user->getPrenom(),
            'Username' => $user->getUsername(),
            'Image' => $user->getAvater(),
        ];
        return new JsonResponse($formatted);
    }

}