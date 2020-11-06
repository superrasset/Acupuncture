<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Synthese;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Matiere;

class SyntheseController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('synthese/home.html.twig'
        );
    }

    /**
     * @Route("/syntheses", name="syntheses")
     */
    public function index()
    {
        $today = new \Datetime();
        //$date = $today->modify('-5 day');
        $nextsunday = new \DateTime("next sunday");
        $repo = $this->getDoctrine()->getRepository(Synthese::class);
        $syntheses = $repo->findByOrderedDate($today,$nextsunday);


        return $this->render('synthese/index.html.twig',[
            'syntheses'=>$syntheses
        ]);
    }
    /**
     * @Route("/synthese/create", name="synthese_create")
     * @Route("/synthese/{id}/edit",name="synthese_edit")
     */
    public function form(Synthese $synthese=null, Request $request,EntityManagerInterface $entityManager)
    {
        //dump($request);
        if (!$synthese){
            $synthese = new Synthese();
        } 
        

        $form = $this->createformBuilder($synthese)
                    ->add('title')
                    ->add('content')
                    ->add('nombreMaxParticipants')
                    ->add('matiere',EntityType::class,[
                        'class'=>Matiere::class,
                        'choice_label'=>'title'
                        ])
                    ->getForm();


        $form->handleRequest($request);
        dump($synthese);

        if ($form->isSubmitted() && $form->isValid()){
            if(!$synthese->getId()){
                $synthese->SetCreatedAt(new \DateTime());
                $synthese->SetNombreParticipants(0);
            }
            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );
            $entityManager->persist($synthese);
            $entityManager->flush();
            return $this->redirectToRoute('synthese_show',['id'=>$synthese->getId()]);

        }
        
        return $this->render('synthese/create.html.twig', ['formSynthese'=>$form->createView()]);
    }

    /**
     * @Route("/synthese/{id}", name="synthese_show")
     */
    public function show(Synthese $synthese, Request $request,EntityManagerInterface $entityManager)
    {



        $form = $this->createformBuilder($synthese)
        ->getForm();

        $form->handleRequest($request);  

        if ($form->isSubmitted() && $form->isValid()){

            $synthese->SetNombreParticipants($synthese->GetNombreParticipants() + 1);
            $entityManager->persist($synthese);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );
            return $this->redirectToRoute('syntheses');

        }


        return $this->render('synthese/show.html.twig',['synthese'=>$synthese, 'form'=>$form->createView()]);
    }


}
