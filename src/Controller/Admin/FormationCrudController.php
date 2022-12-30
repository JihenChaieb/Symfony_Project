<?php

namespace App\Controller\Admin;

use App\Entity\Formation;
use Doctrine\DBAL\Types\DateType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use Symfony\Component\DomCrawler\Field\FileFormField;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class FormationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formation::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('NomFormation'),
            DateTimeField::new('DateDebut'),
            DateTimeField::new('Datefin'),
            TimeField::new('Horaire'),
            NumberField::new('prix'),
            TextareaField::new('description')->hideOnIndex(),
            ImageField::new('image')
                ->setBasePath($this->getParameter("app.path.product_images"))
                ->onlyOnIndex(),
            TextareaField::new('imageFile','affiche de formation')
            ->setFormType(VichImageType::class)
            ->hideOnIndex()
            ->setFormTypeOption('allow_delete',false),
            BooleanField::new('status'),




        ];
    }

}
