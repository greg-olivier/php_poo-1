<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 10/02/2018
 * Time: 13:44
 */

namespace Modele;


class Thumbnail extends Image
{
    const THUMB = '../Web/images/thumbnails';
    function thumbnail($source, $width = 240, $height = 180)
    {

        $ext = strtolower(pathinfo($source, PATHINFO_EXTENSION));
        $file = pathinfo($source, PATHINFO_FILENAME);
        switch ($ext) {
            case 'jpg':
            case 'jpeg' :
                $src_image = imagecreatefromjpeg($source);
                break;
            case 'png' :
                $src_image = imagecreatefrompng($source);
                break;
            case 'gif' :
                $src_image = imagecreatefromgif($source);
                break;
        }
        $dst_image = imagecreatetruecolor($width, $height);
        $r = 255;
        $v = 0;
        $b = 0;
        $couleur_fond = imagecolorallocate($dst_image, $b, $v, $r);
        imagecolortransparent($dst_image, $couleur_fond);
        imagefill($dst_image, 0, 0, $couleur_fond);


        list ($src_w, $src_h) = getimagesize($source);

        $ratio_orig = $src_w / $src_h;
        $dst_w = $width;
        $dst_h = $height;
        if ($dst_w / $dst_h > $ratio_orig) {

            $dst_w = $dst_h * $ratio_orig;
        } else {

            $dst_h = $dst_w / $ratio_orig;
        }
        $dst_x = ($width - $dst_w) / 2;
        $dst_y = ($height - $dst_h) / 2;

        imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        if (imagepng($dst_image, self::THUMB . '/' . $file . '_' . $width . 'x' . $height . '.png')) {
            imagedestroy($dst_image);
            imagedestroy($src_image);
            return $file . '_'.$width.'x'.$height.'.png';
        } else {
            $this->erreur[] = "La création de thumbnail a échoué";
        }
    }

    public function deleteThumbnail(){
        unlink(Image::IMAGES.'thumbnails/'.$this->getNom());
    }
}