<?php
/**
 * @name Bootstrap
 * @author pc-48\administrator
 * @desc 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */

use \Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Events\Dispatcher;
use \Illuminate\Container\Container;
use \Medoo\Medoo;

class Bootstrap extends Yaf\Bootstrap_Abstract {

    public function _initConfig() {
		//把配置保存起来
		$arrConfig = Yaf\Application::app()->getConfig();
		Yaf\Registry::set('config', $arrConfig);
	}

	public function _initPlugin(Yaf\Dispatcher $dispatcher) {
		//注册一个插件
		$objSamplePlugin = new SamplePlugin();
		$dispatcher->registerPlugin($objSamplePlugin);
	}

	public function _initRoute(Yaf\Dispatcher $dispatcher) {
		//在这里注册自己的路由协议,默认使用简单路由
        $routes = Yaf\Dispatcher::getInstance()->getRouter();
        //var_dump($routes);
        $simpleRoute = new Yaf\Route\Simple('m','c','a');
        $routes->addRoute('simple_route', $simpleRoute);
        $router = new Yaf\Route\Rewrite(
            'user/:id',
            array(
                'module' => 'user',
                'controller' => 'user',
                'action' => 'index'
            )
        );
        $routes->addRoute('user',$router);
        //var_dump($routes);
        //$routes->addConfig(Yaf\Registry::get("config")->routes);
        //var_dump(Yaf\Registry::get("config")->routes);
        //var_dump($routes);
	}
	
	public function _initView(Yaf\Dispatcher $dispatcher) {
		//在这里注册自己的view控制器，例如smarty,firekylin
	}

    public function _initDb(Yaf\Dispatcher $dispatcher){
        /*$capsule = new Capsule();
        $capsule->addConnection(Yaf\Registry::get("config")->database->toArray());
        $capsule->setAsGlobal();
        $capsule->bootEloquent();*/

        $config = Yaf\Registry::get("config")->database->toArray();
        $this->_db = new Medoo([
            'database_type' => 'mysql',
	        'database_name' => $config['database'],
            'server' => '127.0.0.1',
            'username' => $config['username'],
            'password' => $config['password'],
        ]);
        Yaf\Registry::set('_db', $this->_db);
    }

    public function _initAutoload()
    {
        // 注册 Composer
        Yaf\Loader::import(APPLICATION_PATH . "/vendor/autoload.php");

        // 注册数据库
        Yaf\Loader::import(APPLICATION_PATH . "/application/library/Database.php");
    }

    public function _initSmarty(Yaf\Dispatcher $dispatcher){
        $smarty = new Smarty_Adapter(null , Yaf\Application::app()->getConfig()->smarty);
        Yaf\Dispatcher::getInstance()->setView($smarty);
    }


}
