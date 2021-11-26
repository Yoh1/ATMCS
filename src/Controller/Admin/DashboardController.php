<?php

namespace App\Controller\Admin;
use App\Controller\Admin\CarCrudController;
use App\Entity\Car;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Menu\MenuInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;



class DashboardController extends AbstractDashboardController 
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Amtcs');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::linkToCrud('Cars', 'fa fa-tags', Car::class),
            MenuItem::linkToCrud('Users', 'fa fa-tags', Users::class),

           
        ];
    }
}
