<?php

class RpcController extends Yaf\Controller_Abstract
{
    /**
     * rpc服务端 (基于Yar)
     * @return false
     */
    public function serverAction(){
        //yac缓存
        Yaf\Registry::get('_yac')->set('user_id', 666);
        //redis缓存
        Yaf\Registry::get('_redis')->set('redis_test', 888);

        $server = new \Yar_Server(new \Api\YarApiTest());
        $server->handle();
        return false;
    }
}