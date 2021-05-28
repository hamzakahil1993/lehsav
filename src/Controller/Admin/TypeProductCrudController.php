<?php

namespace App\Controller\Admin;

use App\Entity\TypeProduct;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypeProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeProduct::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
