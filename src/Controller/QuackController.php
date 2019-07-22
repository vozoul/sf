<?php


namespace App\Controller;


use App\Entity\Quack;
use App\Form\QuackType;
use App\Repository\QuackRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class QuackController extends AbstractController
{

    /**
     * @var QuackRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(QuackRepository $repository, ObjectManager $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @Route("/quacks/", name="quack.index")
     * @return Response
     */
    public function index():Response
    {

//        $quack = new Quack();
//        $quack->setTitle('DuckApp show you in the past and in the futur')
//            ->setContent('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi cumque ipsam placeat! Adipisci dolore doloremque eveniet iusto libero nesciunt sequi! Animi dolore exercitationem ipsa magni molestiae placeat reprehenderit ullam voluptatem.');
//        $this->manager->persist($quack);
//        $this->manager->flush();
        $quacks = $this->repository->findAllDesc();
        return $this->render('quack/index.html.twig', [
            'in_cours' => 'quacks',
            'quacks' => $quacks
        ]);

    }

    /**
     * @Route("/quack/{id}", name="quack.show")
     * @return Response
     */
    public function show(Quack $quack):Response
    {
        return $this->render('quack/show.html.twig', [
            'in_cours' => 'quacks',
            'quack' => $quack
        ]);
    }

    /**
     * @Route("/quack/edit/{id}", name="quack.edit")
     * @param Quack $quack
     * @return Response
     */
    public function edit(Quack $quack, Request $request){
        $form = $this->createForm(QuackType::class, $quack);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->manager->flush();
            return $this->redirectToRoute('quack.index');
        }

        return $this->render('quack/edit.html.twig', [
            'in_cours' => 'quacks',
            'quack' => $quack,
            'form' => $form->createView()
        ]);
    }
}