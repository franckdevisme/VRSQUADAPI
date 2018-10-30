<?php
/**
 * Created by PhpStorm.
 * User: kashi
 * Date: 19/09/2018
 * Time: 17:38
 */

namespace App\Controller;

use App\Entity\Entreprise;
use App\Entity\user;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


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

    /**
     * function find user with user name and password in bdd if user is not empty else show error user not found
     * @Route("/login", name="login")
     * @Method({"Get"})
     */
    public function getUserByUsernameAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        // query for a single Product by its primary key (usually "username")

        $user = $repository->findOneBy(array('username' => $request->get('username'), 'password' => $request->get('password')));
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

    /**
     * function find user with user name and password in bdd if user is not empty else show error user not found
     * @Route("/login/{username}/{password}", name="login")
     * @Method({"GET"})
     */
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