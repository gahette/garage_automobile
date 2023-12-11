<?php

namespace App\Controller\Admin;

use App\Entity\Opinions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OpinionsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Opinions::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
//            AssociationField::new('users')->setLabel('Staff'),
            IdField::new('id')->hideOnForm()->hideOnIndex(),

            TextField::new('name')->setLabel('Nom'),
            NumberField::new('mark')->setLabel('Note'),
            TextEditorField::new('content')->setLabel('Message'),
            BooleanField::new('isApproved')->setLabel('Activé/Désactivé'),
            DateTimeField::new('createdAt')->setLabel('Date de l\'envoie'),
            DateTimeField::new('updatedAt')->setLabel('Date de validation'),
        ];
    }
}
