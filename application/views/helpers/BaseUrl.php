<?php
class Application_Views_Helpers_BaseUrl{
    function baseUrl(){
        $fc = Zend_Controller_Front::getInstance();
        return $fc->getBaseUrl();

    }
}

?>