<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 07/02/2018
 * Time: 09:21
 */

namespace Modele;
 use \Lib\EntiteManager;
use \PDO;
 use Tools\Date_Locale;

 class ProductManager extends EntiteManager
{
     use Date_Locale;

public function getAllProducts()
    {

        $sql = 'SELECT id, titre, image, contenu, prix, date, id_cat category FROM produit WHERE publier = 1';
        $result =  $this->query($sql);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Product::class);
        $all_products = $result->fetchAll();
        foreach ($all_products as $all_product) {
            $all_product->setDate(new \DateTime($all_product->getDate()));
            $cm = new CategoryManager();
            $all_product->setCategory($cm->getCategoryById($all_product->getCategory()));
        }

        $sql = 'SELECT COUNT(id) nb FROM produit WHERE publier = 1';
        $result = $this->query($sql);
        $nb_items = $result->fetch();
        $nb_items = $nb_items['nb'];



        return ['all_products' => $all_products,'nb_items' => $nb_items];
    }

    public function getProductsByCategory($cat)
    {
       
        $sql = 'SELECT p.id_cat category, p.id, p.titre, prix, p.image, p.contenu, p.date FROM produit p  WHERE id_cat = ? ORDER BY p.prix DESC';
        $result =  $this->prepare($sql);
        $result->execute([$cat]);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Product::class);
        $category_products = $result->fetchAll();
        foreach ($category_products as $category_product) {
            $category_product->setDate(new \DateTime($category_product->getDate()));
            $cm = new CategoryManager();
            $category_product->setCategory($cm->getCategoryById($category_product->getCategory()));
        }



        return  $category_products;

    }

    public function getLastProducts()
    {

        $sql = 'SELECT id_cat category, id, titre, prix, image, contenu, date FROM produit p  ORDER BY date DESC LIMIT 3';
        $result = $this->query($sql);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Product::class);
        $last_products = $result->fetchAll();
        foreach ($last_products as $last_product) {
            $last_product->setDate(new \DateTime($last_product->getDate()));
            $cm = new CategoryManager();
            $last_product->setCategory($cm->getCategoryById($last_product->getCategory()));
        }
        return $last_products;
    }

    public function getProductById($id)
    {
        $sql = 'SELECT p.id, p.titre, image, contenu, prix, p.date, p.id_cat category   FROM produit p
            WHERE p.id = ? AND publier = 1';
        $result =  $this->prepare($sql);
        $result->execute([$id]);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Product::class);
        $product = $result->fetch();
        $product->setDate(new \DateTime($product->getDate()));
        $cm = new CategoryManager();
        $product->setCategory($cm->getCategoryById($product->getCategory()));
        return $product;
        
    }
}