<?php
/**
 * Created by PhpStorm.
 * User: zen
 * Date: 2/28/2015
 * Time: 10:57 AM
 */
class Bootstrap{
    private $_di = null;
    private $_config = null;

    public function Bootstrap($config)
    {
        $this->_di = new \Phalcon\DI\FactoryDefault();
        $this->_config = $config;
    }

    public function run()
    {
        $this->_initAutoloader();
        $this->_initViewComponent();
        $this->_setupBaseURI();
        $this->_setupRouter();

        return $this->_di;
    }

    private function _initAutoloader()
    {
        $loader = new \Phalcon\Loader();
        $loader->registerDirs(
            array(
                $this->_config->application->controllersDir,
                $this->_config->application->pluginsDir,
                $this->_config->application->libraryDir,
                $this->_config->application->modelsDir
            )
        )->register();
    }

    private function _initViewComponent()
    {
        $self = $this;
        $this->_di->set('view', function() use ($self){
            $view = new \Phalcon\Mvc\View();
            $view->setViewsDir($self->_config->application->viewsDir);
            //Disable several levels
            $view->disableLevel(array(
                \Phalcon\Mvc\View::LEVEL_LAYOUT => true
            ));
            return $view;
        });
    }

    private function _setupBaseURI()
    {
        $this->_di->set('url', function(){
            $url = new \Phalcon\Mvc\Url();
            $url->setBaseUri($this->_config->application->baseUri);
            return $url;
        });
    }

    private function _setupRouter()
    {
        $this->_di->set('router', function(){
            require __DIR__.'/config/routes.php';
            return $router;
        });
    }
}