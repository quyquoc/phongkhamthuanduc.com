<?php
namespace Modules\Library\Oh;

class CkfinderLib
{

    public static function init()
    {
        $_SESSION['CKFINDER'] = array(
                'baseUrl'               => '/uploads/',
                'baseDir'               => realpath(__DIR__.'/../../../public/uploads/'),
                'IsAuthorized'          => true,
                'DefaultResourceTypes'  => '',
        ); 
        $_SESSION['CKFINDER']['Thumbnails'] = Array(
                'url'           => $_SESSION['CKFINDER']['baseUrl'] . '.thumbs',
                'directory'     => $_SESSION['CKFINDER']['baseDir'] . '.thumbs',
                'enabled'       => true,
                'directAccess'  => false,
                'maxWidth'      => 100,
                'maxHeight'     => 100,
                'bmpSupported'  => false,
                'quality'       => 80
        );

        $_SESSION['CKFINDER']['Images'] = Array(
            'maxWidth'  => 0,
            'maxHeight' => 0,
            'quality'   => 100
        );
        $_SESSION['CKFINDER']['AccessControl'][] = Array(
                'role' => '*',
                'resourceType' => '*',
                'folder' => '/',

                'folderView' => true,
                'folderCreate' => true,
                'folderRename' => true,
                'folderDelete' => true,

                'fileView' => true,
                'fileUpload' => true,
                'fileRename' => true,
                'fileDelete' => true
        ); 
        $_SESSION['CKFINDER']['DefaultResourceTypes'] = '';

        $_SESSION['CKFINDER']['ResourceType'][] = Array(
                'name'              => 'Uploads',
                'url'               => $_SESSION['CKFINDER']['baseUrl'],
                'directory'         => $_SESSION['CKFINDER']['baseDir'],
                'maxSize'           => '50M',
                'allowedExtensions' => 'jpeg,jpg,mov,mp3,mp4,pdf,png,zip,doc,docx,xls,xlsx',
                'deniedExtensions'  => ''
        );

        $_SESSION['CKFINDER']['plugin_imageresize'] = array(
                'smallThumb'    => '90x90',
                'mediumThumb'   => '120x120',
                'largeThumb'    => '180x180',
        );        
    }
}
