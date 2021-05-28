<?php

namespace App\Controller\Admin;

use App\Entity\Depense;
use App\Entity\Product;
use App\Entity\TypeProduct;
use App\Repository\ProductRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/sellmyproduct/{id}", name="sellmyproduct")
     */
    public function sellmyproduct($id, ProductRepository $productRepository, Request $request)
    {
        $product = $productRepository->find($id);
        $price = $request->request->get('prixVente');
        $product->setPrixVente($price);
        $product->setStatus(1);
        $product->setDateVente(new \DateTime());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        return $this->redirectToRoute('admin');
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Maha');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Types de produits', 'fas fa-list', TypeProduct::class);
        yield MenuItem::linkToCrud('Produits', 'fas fa-mobile-alt', Product::class);
        yield MenuItem::linkToCrud('Dépenses', 'fas fa-money-bill', Depense::class);
    }
}
