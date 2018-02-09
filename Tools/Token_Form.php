<?php
namespace Tools;

Trait Token_Form
{
    public function token_form()
    {
        $token = sha1(uniqid(rand(), TRUE));
        $_SESSION['token'] = $token;
        $_SESSION['token_time'] = time();
        return $token;
    }

}