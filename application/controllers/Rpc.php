<?php

class RpcController extends Yaf\Controller_Abstract
{
    /**
     * rpc服务端 (基于Yar)
     * @return false
     */
    public function serverAction(){
        $server = new \Yar_Server(new \Api\YarApiTest());
        $server->handle();
        return false;
    }
}