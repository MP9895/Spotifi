<?php

namespace App\Controller\Admin;

use App\Entity\Album;
use App\Entity\Genre;
use App\Entity\Musique;
use App\Entity\User;
use App\Entity\Artiste;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Spotifi');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Le site', 'fa fa-home','/');
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Musique', 'fas fa-list', Musique::class);
        yield MenuItem::linkToCrud('Albums', 'fas fa-list', Album::class);
        yield MenuItem::linkToCrud('Artistes', 'fas fa-list', Artiste::class);
        yield MenuItem::linkToCrud('Genres', 'fas fa-list', Genre::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', User::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
