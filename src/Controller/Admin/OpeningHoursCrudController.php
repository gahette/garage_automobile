<?php

namespace App\Controller\Admin;

use App\Entity\OpeningHours;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OpeningHoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OpeningHours::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('garage'),
            IdField::new('id')->hideOnForm(),
            TextField::new('day')->setLabel('Jour'),
            TextField::new('amOpenHours')->setLabel('Ouverture matin'),
            TextField::new('amCloseHours')->setLabel('Fermeture matin'),
            TextField::new('pmOpenHours')->setLabel('Ouverture après-midi'),
            TextField::new('pmCloseHours')->setLabel('Fermeture après-midi'),
        ];
    }
}
