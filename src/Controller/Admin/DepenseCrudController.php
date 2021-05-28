<?php

namespace App\Controller\Admin;

use App\Entity\Depense;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class DepenseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Depense::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsAsDropdown()  
            ->setPageTitle('index', 'Dépenses');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('type')->setChoices(['Transport'=>'Transport']),
            MoneyField::new('prix')->setCurrency('DZD'),
            DateField::new('createdAt')->onlyOnIndex(),
        ];
    }
}
