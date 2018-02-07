<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 06/02/2018
 * Time: 18:53
 */

namespace Lib;


abstract class EntiteManager
{
    /**
     * @var \PDO
     */
    private $bdd;

    /**
     * ArticleManager constructor.
     */
    public function __construct()
    {
        $this->bdd = PDOFactory::get();

        }


    public function query($query)
    {
        return $this->bdd->query($query);
    }

    public function prepare($prepare)
    {
        return $this->bdd->prepare($prepare);
    }

}