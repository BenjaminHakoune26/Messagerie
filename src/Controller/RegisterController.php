<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ResgisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/inscription", name="register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {

        $user = new User();        $form = $this->createForm(ResgisterType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $password = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($password);

            $this->entityManager->persist($user);
            $this->entityManager->flush();
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        Vous êtes inscrit !
          </div>";
        }

        return $this->render('register/index.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
