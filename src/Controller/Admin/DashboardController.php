<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use App\Entity\Garage;
use App\Entity\Images;
use App\Entity\Messages;
use App\Entity\OpeningHours;
use App\Entity\Opinions;
use App\Entity\Services;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route(path: '/admin', name: 'admin_dashboard_index')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->renderContentMaximized()
            ->setTitle('Garage Automobile');
    }

    public function configureCrud(): Crud
    {
        return parent::configureCrud()
            ->renderContentMaximized()
            ->showEntityActionsInlined()
            ->setDefaultSort([
                'id' => 'DESC',
            ]);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Garages', 'fa fa-solid fa-warehouse', Garage::class);
        yield MenuItem::linkToCrud('Services', 'fa fa-solid fa-laptop', Services::class);
        yield MenuItem::linkToCrud('Horaires D\'ouverture', 'fa fa-solid fa-clock', OpeningHours::class);
        yield MenuItem::linkToCrud('Avis', 'fa fa-solid fa-gavel', Opinions::class);
        yield MenuItem::linkToCrud('Voitures d\'occasion', 'fa fa-solid fa-car', Cars::class);
        yield MenuItem::linkToCrud('Messages', 'fa fa-solid fa-comment', Messages::class);
        yield MenuItem::linkToCrud('Images', 'fa fa-solid fa-photo', Images::class);
    }
}
