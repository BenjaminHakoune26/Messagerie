<?php

namespace App\Controller;

use App\Entity\Discussion;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @Route("/message", name="message")
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $discussions = $this->getDoctrine()->getRepository(Discussion::class)->findAll();
        foreach ($discussions as $d) {
            $messages = $d->getMessage();
        }

        return $this->render('message/index.html.twig', [
                'users' => $users,
                'discussions' => $discussions,
                'messages' => $messages
            ]
        );
    }
}

