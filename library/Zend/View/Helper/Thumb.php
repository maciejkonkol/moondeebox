<?php

/**
 * @category   Zend
 * @package    Zend_View
 * @subpackage Helper
 */
class Zend_View_Helper_Thumb extends Zend_View_Helper_Abstract
{
    /**
     * BaseUrl
     *
     * @var string
     */
    protected $_baseUrl;
    

    /**
     * Set BaseUrl
     *
     * @param  string $base
     * @return Zend_View_Helper_BaseUrl
     */
    public function setBaseUrl($base)
    {
        $this->_baseUrl = rtrim($base, '/\\');
        return $this;
    }

    /**
     * Get BaseUrl
     *
     * @return string
     */
    public function getBaseUrl()
    {
        if ($this->_baseUrl === null) {
            /** @see Zend_Controller_Front */
            require_once 'Zend/Controller/Front.php';
            $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();

            // Remove scriptname, eg. index.php from baseUrl
            $baseUrl = $this->_removeScriptName($baseUrl);

            $this->setBaseUrl($baseUrl);
        }

        return $this->_baseUrl;
    }

    /**
     * Generuje url TinThumb
     *
     * @param string $src Adres obrazka
     * @param integer $width Szerokosc miniaturki
     * @param integer $height wysokosc miniaturki
     * @return string
     */
    public function thumb( $src, $width = null, $height = null ){
        
        $src = $this->getBaseUrl().'/library/TimThumb?src='.$src;
        
        if( $width ){
			$src .= '&w='.$width;
		}
        
        if( $height ){
			$src .= '&h='.$height;
		}
        
        return $src;
    }

    /**
     * Remove Script filename from baseurl
     *
     * @param  string $url
     * @return string
     */
    protected function _removeScriptName($url)
    {
        if (!isset($_SERVER['SCRIPT_NAME'])) {
            // We can't do much now can we? (Well, we could parse out by ".")
            return $url;
        }

        if (($pos = strripos($url, basename($_SERVER['SCRIPT_NAME']))) !== false) {
            $url = substr($url, 0, $pos);
        }

        return $url;
    }
}
