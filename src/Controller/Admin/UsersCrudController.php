<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use App\Form\ImageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Users::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            EmailField::new('email'),
            TextField::new('lastname'),
            TextField::new('firstname'),
            ChoiceField::new('roles')
            ->setChoices([
                'Super admin' => 'ROLE_SUPER_ADMIN',
                'Administrateur' => 'ROLE_ADMIN',
                'Employé' => 'ROLE_EMPLOYEES',
            ])
            ->setRequired(isRequired: false)
            ->allowMultipleChoices(),
            TextField::new('plainPassword')->onlyOnForms(),
//            AssociationField::new('cars')
//                ->setFormTypeOptions([
//                'by_reference' => false,
//            ]),
            CollectionField::new(propertyName: 'images')
                ->setEntryType(formTypeFqcn: ImageType::class)
                ->allowDelete()
                ->allowAdd(),
            TextareaField::new('content')
                ->setLabel('Description'),
        ];
    }
}
