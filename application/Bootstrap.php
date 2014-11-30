<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initViewHelpers(){
        $this->bootstrap('view');
		$view = $this->getResource('view');
		$view->doctype('XHTML1_STRICT');
		
		$view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
		$view->jQuery()->setVersion('1.8.2')
						->setUiVersion('1.9.0')
						->addStylesheet('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/smoothness/jquery-ui.css')
						->uiEnable()
						->enable();
    }
	
	public function _initDbNames() {
		try {
			if ($this->hasPluginResource('db')){
				$db = $this->getPluginResource('db');
				$db->getDbAdapter()->query('SET NAMES UTF8');
				
				Zend_Registry::set( 'db_adapter', $db->getDbAdapter() );
			}
		}catch (Exception $e) {
    		echo "Blad polaczenia z baza danych: ".$e->getMessage() . PHP_EOL;
    		exit(0);
		}
	}
	
    protected function _initDoctype() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');
		
    }
	
	
	/**
     * Metoda dodaje rutery menu glownego
     *
     * @return void
	 * @access public
     */    
	protected function _initMenuRouter() {
		
		$front = Zend_Controller_Action::getFrontController();
		$router = $front->getRouter();
		
		$menu = Moondee_Application_Menu::getInstance();
		
		$router->addRoute( 'object', new Zend_Controller_Router_Route("/:entity", array( "module" => "entity", "controller" => "desktop", "action" => "index"  ) ) );
		
		$router->addRoute( 'image-image-albums', new Zend_Controller_Router_Route("/:entity/albums", array( "module" => "image", "controller" => "image", "action" => "albums"  ) ) );
		
		foreach( $menu->getPositions() as $position ){
			$router->addRoute( 
					$position->getRout(), 
					new Zend_Controller_Router_Route( 
						'/'.$position->getRout(), 
						array( 
							"module" => $position->getModule(), 
							"controller" => $position->getController(), 
							"action" => $position->getAction() 
						)
					)
			);
		}
	}
    

	protected function _initAutoload() {
		$autoloader = new Zend_Application_Module_Autoloader( array(
			'namespace' => '',
			'basePath'  => dirname(__FILE__),
		));
		
		//$autoloader->addResourceType( 'modules', 'modules', 'Module_' );
		$autoloader->addResourceType( 'forms', 'forms', 'Form_' );
		
		
		return $autoloader;
	}
}

