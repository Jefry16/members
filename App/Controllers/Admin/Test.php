<?php

namespace App\Controllers\Admin;

use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Test extends \Core\Controller
{
    

    public function indexAction()
    {
        $fileName = $_FILES['file']['name'];
        $fileType = $_POST['filetype'];
        if ($fileType == 'image') {
            $validExtension = ['png', 'jpeg', 'jpg'];
        }

        $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/img'.'/'.$fileName;
        $fileExtension = pathinfo($uploadDir, PATHINFO_EXTENSION);
        $fileExtension = strtolower($fileExtension);
        if(in_array($fileExtension, $validExtension)){
           if(move_uploaded_file($_FILES['file']['tmp_name'],$uploadDir)){ 
            echo $fileName;
          }
        }
    }
        
        
}
