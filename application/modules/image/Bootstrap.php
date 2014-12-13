<?php

class Image_Bootstrap extends Zend_Application_Module_Bootstrap
{
    protected function _initAutoload() {
        
		
    }

    protected function _initRouter() {

        $front = Zend_Controller_Action::getFrontController();
        $router = $front->getRouter();

        $router->addRoute( 'album', new Zend_Controller_Router_Route("/album/:album", array( "module" => "image", "controller" => "image", "action" => "album"  ) ) );
        $router->addRoute( 'addimage', new Zend_Controller_Router_Route("/addimage/:album", array( "module" => "image", "controller" => "image", "action" => "addimage"  ) ) );

        $router->addRoute( 'deletealbum', new Zend_Controller_Router_Route("/deletealbum/:album", array( "module" => "image", "controller" => "image", "action" => "deletealbum"  ) ) );

        $router->addRoute( 'image-image-albums', new Zend_Controller_Router_Route("/:entity/albums", array( "module" => "image", "controller" => "image", "action" => "albums"  ) ) );

        $router->addRoute( 'image-image-all-images', new Zend_Controller_Router_Route("/:entity/all-images", array( "module" => "image", "controller" => "image", "action" => "all-images"  ) ) );


    }
}

