<?php

namespace App\Controller\Admin;

use App\Entity\Formateur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FormateurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formateur::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('firstname'),
            TextField::new('lastname'),

        ];
    }

}
