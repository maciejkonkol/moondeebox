<?php

class Entity_Bootstrap extends Zend_Application_Module_Bootstrap
{
    protected function _initAutoload() {
        
		
	}
	
	protected function _initRouter() {
		
		$front = Zend_Controller_Action::getFrontController();
		$router = $front->getRouter();
		
		$router->addRoute( 'addmark', new Zend_Controller_Router_Route("/add-mark/:object/:mark", array( "module" => 'entity', "controller" => 'mark', "action" => 'addmark' ) ) );
		$router->addRoute( 'mark-description', new Zend_Controller_Router_Route("/mark-description/:object/:mark", array( "module" => 'entity', "controller" => 'description', "action" => 'mark-description' ) ) );
		$router->addRoute( 'add-description', new Zend_Controller_Router_Route("/add-description/:entity", array( "module" => 'entity', "controller" => 'description', "action" => 'add-description' ) ) );
		$router->addRoute( 'descriptions', new Zend_Controller_Router_Route("/descriptions/:entity", array( "module" => 'entity', "controller" => 'description', "action" => 'descriptions' ) ) );
		$router->addRoute( 'description', new Zend_Controller_Router_Route("/description/:description", array( "module" => 'entity', "controller" => 'description', "action" => 'description' ) ) );
	
		$router->addRoute( 'object-menu-getAlbums', new Zend_Controller_Router_Route("/:entity/object-menu-getAlbums/", array( "module" => "image", "controller" => "image", "action" => "albums"  ) ) );
		$router->addRoute( 'object-menu-getEvents', new Zend_Controller_Router_Route("object-menu-getEvents/:entity", array( "controller" => "index", "action" => "panoramio"  ) ) );
		$router->addRoute( 'object-menu-getPlaces', new Zend_Controller_Router_Route("object-menu-getPlaces/:entity", array( "controller" => "index", "action" => "panoramio"  ) ) );
		$router->addRoute( 'object-menu-getAbout', new Zend_Controller_Router_Route("object-menu-getAbout/:entity", array( "module" => "entity", "controller" => "information", "action" => "all-information"  ) ) );
		$router->addRoute( 'object-menu-getAbouts', new Zend_Controller_Router_Route("object-menu-getAbouts/:entity", array( "module" => "entity", "controller" => "description", "action" => "descriptions"  ) ) );
		$router->addRoute( 'user-group', new Zend_Controller_Router_Route("/:entity/group/:group", array( "module" => "entity", "controller" => "user", "action" => "group"  ) ) );
		$router->addRoute( 'user-addgroup', new Zend_Controller_Router_Route("/addgroup", array( "module" => "entity", "controller" => "user", "action" => "addgroup"  ) ) );
		$router->addRoute( 'user-groups', new Zend_Controller_Router_Route("/groups", array( "module" => "entity", "controller" => "user", "action" => "groups"  ) ) );
		$router->addRoute( 'object-taskmenu-like', new Zend_Controller_Router_Route("object-taskmenu-like/:entity", array( "module" => "entity", "controller" => "user", "action" => "like"  ) ) );
		$router->addRoute( 'object-taskmenu-addToGroup', new Zend_Controller_Router_Route("object-taskmenu-addtogroup/:entity/:group", array( "module" => "entity", "controller" => "user", "action" => "addtogroup"  ) ) );
		$router->addRoute( 'object-menu-getDesktop', new Zend_Controller_Router_Route("object-menu-getdesktop/:entity", array( "module" => "entity", "controller" => "desktop", "action" => "index"  ) ) );
 
		$router->addRoute( 'place', new Zend_Controller_Router_Route("place/:entity", array( "module" => "entity", "controller" => "place", "action" => "place"  ) ) );
		
	}
}

