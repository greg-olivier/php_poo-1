<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 07/02/2018
 * Time: 09:01
 */

namespace Controleur\Frontend;


use Modele\CategoryManager;
use \Modele\ProductManager;

class CatalogueControleur extends \Lib\Controleur
{


    protected function indexAction()
    {
        $cm = new CategoryManager();
        $all_categories = $cm->getAllCategories();
        $data = ['all_categories' => $all_categories, 'titre' => 'Bienvenue sur le catalogue'];
        $this->render('catalogue/categories.html.php', $data);
    }

    protected function categoryAction()
    {
        $pm = new ProductManager();
        $cat = $_GET['cat'];
        $category_products = $pm->getProductsByCategory($cat);
        $data = ['category_products' => $category_products, 'titre' => 'Bienvenue sur le catalogue'];
        $this->render('catalogue/category.html.php', $data);
    }

    protected function detailAction()
    {
        $pm = new ProductManager();
        $id = $_GET['id'];
        $current_product = $pm->getProductById($id);
        $data = ['current_product' => $current_product];
        $this->render('catalogue/produit.html.php', $data);
    }
    
    protected function allProductsAction()
    {
        $pm = new ProductManager();
        $data = $pm->getAllProducts();
        $this->render('catalogue/list.html.php', $data);
    }
}