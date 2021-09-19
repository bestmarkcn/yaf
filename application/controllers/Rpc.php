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

        $server = new \Yar_Server(new \Api\YarApiTest());
        $server->handle();
        return false;
    }
}