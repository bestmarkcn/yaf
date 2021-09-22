<?php

class DelayQueueController extends Yaf\Controller_Abstract
{
    public function inAction(){
        $name = $this->getRequest()->getParam('name');
        $password = $this->getRequest()->getParam('password');

        if(empty($name) || empty($password)){
            die('empty params');
        }

        DelayQueue::getInstance('editPassword')->addTask('\Job\DelayQueueJob',
            strtotime('2021-09-22 15:08:00'),
            ['name' => $name, 'password' => $password]);
        return false;
    }

    public function outAction(){
        while (true){
            DelayQueue::getInstance('editPassword')->perform();
            sleep(1);
        }
        return false;
    }

    public function showAction(){
        var_dump(DelayQueue::getInstance('editPassword')->show());
        return false;
    }
}