<?php

namespace App\Controllers\Admin;

/**
 * Ajax controller
 *
 * PHP version 7.0
 */
class Ajax extends \Core\Controller
{
    public function showImagesAction()
    {
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/img';
        $images = [];
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file == '.' || $file == '..') {
                        continue;
                    }
                    $images[] = $file;
                }
                closedir($dh);
            }
        }
        echo json_encode($images);
    }
}
