<?php

namespace Tools;

Trait Extrait
{
    public function extr($str, $max = 150, $add = '[...]')
    {
        $text = strip_tags($str);
        //var_dump($text);
        if (strlen($text) > $max) {
            $text = substr($text, 0, $max);
                $text = substr($text,0,strrpos($text,' ')). $add;
        }
        return $text;
    }
    


}