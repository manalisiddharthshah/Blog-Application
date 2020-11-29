<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\RegistrationFormType;


class SecurityController extends AbstractController
{
    
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $utils):Response
    {
        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
    
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            // do anything else you need here, like send an email
            // in this example, we are just redirecting to the homepage
            return $this->redirectToRoute("login");  
        }

        return $this->render('security/registration.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

}
