<?php


namespace App\Controller;


use App\Entity\Quack;
use App\Form\QuackType;
use App\Repository\QuackRepository;
use App\Service\FileUploader;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request):Response
    {
        $quacks = $paginator->paginate(
            $this->repository->findAllDesc(),
            $request->query->getInt('page', 1),
            4
        );

        return $this->render('quack/index.html.twig', [
            'in_cours' => 'quacks',
            'quacks' => $quacks
        ]);
    }

    /**
     * @Route("/quack/new", name="quack.new")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return RedirectResponse|Response
     * @throws \Exception
     */
    public function new(Request $request, FileUploader $fileUploader){
        $quack = new Quack();
        $form = $this->createForm(QuackType::class, $quack);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $image = $form['imageFile']->getData();
            if($image){
                $imageFileName = $fileUploader->upload($image);
                $quack->setImageFilename($imageFileName);
            }
            $this->manager->persist($quack);
            $this->manager->flush();
            $this->addFlash('success', 'Ajouté avec Success');
            return $this->redirectToRoute('quack.index');
        }

        return $this->render('quack/new.html.twig', [
            'in_cours' => 'quacks',
            'val' => 'index',
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
            'in_cours' => 'quacks',
            'val' => 'show',
            'quack' => $quack
        ]);
    }

    /**
     * @Route("/quack/edit/{id}", name="quack.edit", methods="GET|POST")
     * @param Quack $quack
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     * @throws \Exception
     */
    public function edit(Quack $quack, Request $request, FileUploader $fileUploader){

        $form = $this->createForm(QuackType::class, $quack);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $image = $form['imageFile']->getData();
            if($image){
                $imageFileName = $fileUploader->upload($image);
                $quack->setImageFilename($imageFileName);
            }
            $this->manager->flush();
            $this->addFlash('success', 'Modifié avec Success');
            return $this->redirectToRoute('quack.index');
        }

        return $this->render('quack/edit.html.twig', [
            'in_cours' => 'quacks',
            'quack' => $quack,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/quack/delete/{id}", name="quack.delete", methods="DELETE")
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Quack $quack, Request $request){
        if($this->isCsrfTokenValid('delete' . $quack->getId(), $request->get('_token'))){
            $this->manager->remove($quack);
            $this->manager->flush();
            $this->addFlash('success', 'Supprimé avec Success');
        }
        return $this->redirectToRoute('quack.index');
    }
}