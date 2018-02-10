<?php
namespace Tools;

Trait Upload_Image
{

    function upload($file, $destination, $maxsize = FALSE, $typesMime = FALSE)
    {

        //Test1: fichier correctement uploadé
        if (($file === '') OR $file['error'] > 0)
            return FALSE;

        //Test2: taille limite
        if ($maxsize !== FALSE AND $file['size'] > $maxsize)
            return FALSE;

        //Test3: extension
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $type = $finfo->file($file['tmp_name']);

        if ($typesMime !== FALSE AND !in_array($type, $typesMime))
            return FALSE;

        //Déplacement
        return move_uploaded_file($file['tmp_name'], $destination);
    }
}