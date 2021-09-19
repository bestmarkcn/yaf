<?php
namespace Api;

class YarApiTest
{
    public function api($parameter, $option = "foo") {
        return $parameter;
    }

    protected function client_can_not_see() {
    }
}