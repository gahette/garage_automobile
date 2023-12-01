<?php

namespace App\Controller\Admin;

use App\Entity\Services;
use App\Form\ImageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
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
            SlugField::new('slug')->setTargetFieldName('name')->hideOnIndex(),
            TextareaField::new('content')->setLabel('Description'),
            BooleanField::new('isApproved')->setLabel('Activé/Désactivé'),
            MoneyField::new('price')->setLabel('Tarif')->setCurrency('EUR'),
        ];
    }
}
