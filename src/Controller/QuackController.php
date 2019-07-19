<?php


namespace App\Controller;


use App\Entity\Quack;
use App\Form\QuackType;
use App\Repository\QuackRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class QuackController extends AbstractController
{

    /**
     * @var QuackRepository
     */
    private $repository;

    public function __construct(QuackRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/quacks/", name="quack.index")
     * @return Response
     */
    public function index():Response
    {
        $quacks = $this->repository->findAll();
        return $this->render('quack/index.html.twig', [
            'in_cours' => 'quacks',
            'quacks' => $quacks
        ]);
    }

    /**
     * @Route("/quack/edit/{id}", name="quack.edit")
     * @param Quack $quack
     * @return Response
     */
    public function edit(Quack $quack){
        $form = $this->createForm(QuackType::class, $quack);
        return $this->render('quack/edit.html.twig', [
            'quack' => $quack,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/quack/{id}", name="quack.show")
     * @return Response
     */
    public function show(Quack $quack):Response
    {
        return $this->render('quack/show.html.twig', [
            'quack' => $quack
        ]);
    }

}