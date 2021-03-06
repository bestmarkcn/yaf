<?php
/**
 * @name IndexController
 * @author pc-48\administrator
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class IndexController extends Yaf\Controller_Abstract {
    /**
     * 默认初始化方法，如果不需要，可以删除掉这个方法
     * 如果这个方法被定义，那么在Controller被构造以后，Yaf会调用这个方法
     */
    public function init() {
		$this->getView()->assign("header", "Yaf Example");
	}

	/** 
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/yaf_skeleton/index/index/index/name/pc-48\administrator 的时候, 你就会发现不同
     */
	public function indexAction($name = "Stranger") {
        echo phpinfo();exit;

		//1. fetch query
		$get = $this->getRequest()->getQuery("get", "default value");


		//2. fetch model
		$model = new SampleModel();

		//3. assign
		$this->getView()->assign("content", $model->selectSample());
		$this->getView()->assign("name", $name);

		//4. render by Yaf, 如果这里返回FALSE, Yaf将不会调用自动视图引擎Render模板
        //return TRUE;
	}

    /**
     * medoo + smarty
     */
    public function medooTestAction(){
        $this->_db = Yaf\Registry::get('_db');
        $users = $this->_db->select("users", [
            "[><]articles" => ["id" => "user_id"]
        ], [
            "users.id",
            "password",
            "title"
        ],[
            //"id[>]" => 0
        ]);
        $this->getView()->assign("users", $users);
    }

    /**
     * rpc客户端 (基于Yar)
     * @return false
     */
    public function rpcClientAction(){
        $client = new Yar_Client("http://yaf.test/index/Rpc/Server");
        $result = $client->api("parameter");
        var_dump($result);
        return false;
    }

    public function rpcClientLoopAction(){
        $url = 'http://yaf.test/index/Rpc/Server';
        Yar_Concurrent_Client::call($url, "api", array("parameters"), null);
        Yar_Concurrent_Client::call($url, "api", array("parameters"), null);
        Yar_Concurrent_Client::call($url, "api", array("parameters"), null);
        Yar_Concurrent_Client::call($url, "api", array("parameters"), null);
        Yar_Concurrent_Client::loop(); //send
        return false;
    }

    public function callBack($retval, $callinfo) {
         var_dump($retval);
    }

}
