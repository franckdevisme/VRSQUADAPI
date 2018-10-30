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


class UserController extends Controller
{
    /**
     * @Route("/listusers",name="listusers")
     * @Method({"GET"})
     */
    public function getUserAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        // query for a single Product by its primary key (usually "id")
        $users = $repository->findall();

        $formatted = [];
        foreach ($users as $user) {
            $formatted[] = [
                'Nom' => $user->getName(),
                'Prénom' => $user->getLastname(),
                'Username' => $user->getUsername(),
                'Image' => $user->getProfileImage(),
            ];
        }

        return new JsonResponse($formatted);

    }


    /**
     * réquper les tout users de l'entreprise
     * @Route("/UsersListeByEntreprise",name="UsersListeByEntreprise")
     * @Method({"POST"})
     */
    public function getUserByEntrepriseAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        // query for a single Product by its primary key (usually "id")
        $users = $repository->findBy(array('identreprise' => (int)$request->get('idEntreprise')));

        if (empty($users)) {
            return new JsonResponse(['message' => 'user not found'], Response::HTTP_NOT_FOUND);
        }

        $formatted = [];
        foreach ($users as $user) {
            $formatted[] = [
                'Nom' => $user->getName(),
                'Prénom' => $user->getLastname(),
                'Username' => $user->getUsername(),
                'Image' => $user->getProfileImage(),
            ];
        }

        return new JsonResponse($formatted);

    }


    public function getUserByUsernameAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        // query for a single Product by its primary key (usually "username")

        $user = $repository->findOneBy(array('username' => $request->get('username')));
        /* @var $users user[] */
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

    /**
     * function find user with user name and password in bdd if user is not empty else show error user not found
     * @Route("/login/{username}/{password}", name="login")
     * @Method({"GET"})
     */
    public function getUserByUsernamepassworAction($username, $password)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        // query for a single Product by its primary key (usually "username")

        $user = $repository->findOneBy(array('username' => $username));
        /* @var $users user[] */
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