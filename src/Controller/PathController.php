<?php


namespace App\Controller;


use App\Entity\Path;
use App\Form\PathType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PathController extends AbstractController
{
    public function new(Request $request) {
        $path = new Path();
        $form = $this->createForm(PathType::class, $path);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($request);
           $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('path/new.html.twig', [
            'path' => $path,
            'form' => $form->createView(),
        ]);
    }
}
