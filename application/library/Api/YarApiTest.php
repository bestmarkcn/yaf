<?php
namespace Api;

class YarApiTest
{
    public function api($parameter, $option = "foo") {
        return array(
            'parameter' => $parameter,
            'testCache' => \Yaf\Registry::get('_yac')->get('user_id'),
            'testRedis' => \Yaf\Registry::get('_redis')->get('redis_test')
        );
    }

    protected function client_can_not_see() {
    }
}