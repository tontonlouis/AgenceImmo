<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class PropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
     */
    private $repository;

    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        // $this->em = $em;
    }

    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */

    public function index(): Response
    {
        //  CREER UN ENREGISTREMENT DANS LA BASE DE DONNEE
        // $property = new Property();
        // $property->setTitle('Mon premier bien')
        //     ->setPrice(200000)
        //     ->setRooms(4)
        //     ->setBedrooms(3)
        //     ->setDescription("Une petite description du bien")
        //     ->setSurface(60)
        //     ->setFloor(4)
        //     ->setHeat(1)
        //     ->setCity('Dunkerque')
        //     ->setAddress('25 rue Jean bart')
        //     ->setPostalCode('59140');
        // RECUPERE L'ENTITY MANAGER
        // $em = $this->getDoctrine()->getManager();
        // ENVOI LES DONNEES DANS LA BDD
        // $em->persist($property);
        // $em->flush();
        // $repository = $this->getDoctrine()->getRepository(Property::class);
        // dump($repository);

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties'
        ]);
    }


    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Property $property
     * @return Response
     */

    public function show(Property $property, string $slug): Response
    {
        if($property->getSlug() !== $slug)
        {
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }

        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties'
        ]);
    }
    
}
