<?php
namespace Api;

class YarApiTest
{
    public function api($parameter, $option = "foo") {
        return array(
            'parameter' => $parameter,
            'testCache' => \Yaf\Registry::get('_yac')->get('user_id')
        );
    }

    protected function client_can_not_see() {
    }
}