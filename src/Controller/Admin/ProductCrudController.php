<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $sellProduct = Action::new('sellProduct', 'Vendre')
            ->linkToCrudAction('sellProduct');

        return $actions
            ->add(Crud::PAGE_INDEX, $sellProduct)
        ;
    }

    public function sellProduct(AdminContext $context)
    {
        $product = $context->getEntity()->getInstance();
        return $this->render('admin/sellproduct.html.twig', ['product' => $product]);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsAsDropdown()  
            ->setPageTitle('index', 'Produits');
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('model'),
            AssociationField::new('type'),
            TextEditorField::new('description'),
            MoneyField::new('prixAchat')->setCurrency('DZD'),
            MoneyField::new('prixVente')->setCurrency('DZD')->onlyOnIndex(),
            TextField::new('status')->onlyOnIndex(),
        ];
    }
    
}
