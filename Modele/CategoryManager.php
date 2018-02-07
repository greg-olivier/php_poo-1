<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 07/02/2018
 * Time: 09:37
 */

namespace Modele;


use Lib\EntiteManager;
use \PDO;

class CategoryManager extends EntiteManager
{


    public function getAllCategories()
{
    $sql = 'SELECT cat.id_cat id, cat.titre, COUNT(id) nb FROM categorie cat JOIN produit p ON cat.id_cat = p.id_cat GROUP BY cat.id_cat ORDER BY p.date DESC';

    $result = $this->query($sql);
    $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Category::class);
    return $result->fetchAll();

}

    public function getCategoryById($id)
    {
        $sql = 'SELECT cat.id_cat id, cat.titre, COUNT(id) nb FROM categorie cat JOIN produit p ON cat.id_cat = p.id_cat Where cat.id_cat=?';

        $result = $this->prepare($sql);
        $result->execute([$id]);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Category::class);
        return $result->fetch();

    }
}