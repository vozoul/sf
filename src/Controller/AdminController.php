<?php


namespace App\Controller;


use App\Repository\QuackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     * @return Response
     */
    public function index():Response
    {
        return $this->render('admin/index.html.twig', [
        ]);
    }
}