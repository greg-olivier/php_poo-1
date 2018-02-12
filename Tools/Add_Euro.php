<?php
namespace Tools;

Trait Add_Euro
{
    public function add_euro($price)
    {
        $str_euro = $price .= '€';
        return $str_euro;
    }

}