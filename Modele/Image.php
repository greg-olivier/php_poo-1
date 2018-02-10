<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 10/02/2018
 * Time: 13:44
 */

namespace Modele;


use Lib\Application;
use Lib\Entite;
use Tools\Upload_Image;

class Image extends Entite
{

    use Upload_Image;
    
    protected $file=[];
    protected $nom, $mime, $ext, $filename;

    const IMAGES = '../Web/images/';


    /**
     * @return array
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param array $id
     * @return Image
     */
    public function setFile(Array $file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     * @return Image
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * @param mixed $mime
     * @return Image
     */
    public function setMime($mime)
    {
        $this->mime = $mime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * @param mixed $ext
     * @return Image
     */
    public function setExt($filename)
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION );
        $this->ext = $ext;
        return $this;
    }

    /**
     * @param string $filename
     * @return Image
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
        return $this;
    }
    
    public function encodeFilename(){
       return sha1(uniqid(rand(), true)) . '.' . $this->getExt();
    }



    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }


    public function uploadImage()
    {

        if (Image::directoryScan() === False OR Image::imageExist($this)=== False) {
            $upload = $this->upload($this->getFile(), Image::IMAGES . $this->getFilename(), 1000000, array('image/png', 'image/jpg', 'image/jpeg'));

            if ($upload === FALSE)
                $this->erreur[] = 'Problème lors du téléchargement du fichier. Merci de recommencer';
            else
                return true;
        }
    }


    static private function directoryScan()
    {
        return scandir(Image::IMAGES);
    }

    static private function imageExist(Image $image)
    {
        return array_search($image->getFileName(), $image->directoryScan());
    }

    public function deleteImage(){
        unlink(Image::IMAGES.$this->getNom());
    }

}