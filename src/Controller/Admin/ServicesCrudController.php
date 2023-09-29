<?php

namespace App\Controller\Admin;

use App\Entity\Services;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ServicesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Services::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('garage'),
            IdField::new('id')->hideOnForm(),
            TextField::new('category')->setLabel('Catégorie'),
            TextField::new('name')->setLabel('Nom'),
            TextEditorField::new('content')->setLabel('Description'),
            BooleanField::new('isApproved')->setLabel('Activé/Désactivé'),
            MoneyField::new('price')->setLabel('Tarif')->setCurrency('EUR'),
        ];
    }
}
