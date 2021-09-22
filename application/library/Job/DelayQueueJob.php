<?php
namespace Job;

class DelayQueueJob
{
    protected $payload;

    public function perform(){
        if(empty($this->payload['name']) || empty($this->payload['password'])){
            echo 'params error';
            return false;
        }
        \Yaf\Registry::get('_db')->update('users',
        ['password' => $this->payload['password']],
        ['name[=]' => $this->payload['name']]);
        echo 'DelayQueueJob success';
        return true;
    }

    public function setPayload($args = null){
        $this->payload = $args;
    }
}