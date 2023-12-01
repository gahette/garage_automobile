<?php

namespace App\Controller\Admin;

use App\Entity\Garage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GarageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Garage::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')->setLabel('Nom'),
            SlugField::new('slug')->setTargetFieldName('name')->hideOnIndex(),
            TextField::new('Address')->setLabel('Adresse'),
            IntegerField::new('zipCode')->setLabel('Code postal'),
            TextField::new('city')->setLabel('Ville'),
            TelephoneField::new('phone')->setLabel('Téléphone'),
        ];
    }
}
