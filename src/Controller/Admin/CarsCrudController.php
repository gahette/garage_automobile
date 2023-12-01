<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use App\Form\ImageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CarsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cars::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('garage'),
            AssociationField::new('user'),
            IdField::new('id')->hideOnForm(),
            TextField::new('name')->setLabel('Ref'),
            SlugField::new('slug')->setTargetFieldName('name')->hideOnIndex(),
            TextField::new('brand')->setLabel('Marque'),
            TextField::new('model')->setLabel('Modèle'),
            NumberField::new('kilometer')->setLabel('Kilométrage'),
            TextField::new('year')->setLabel('Année'),
            TextareaField::new('content')->setLabel('Description'),
            MoneyField::new('price')->setLabel('Prix')->setCurrency('EUR'),
            CollectionField::new(propertyName: 'images')
                ->setEntryType(formTypeFqcn: ImageType::class)
                ->allowDelete()
                ->allowAdd(),
        ];
    }
}
