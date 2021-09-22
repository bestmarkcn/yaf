<?php

class QueueController extends Yaf\Controller_Abstract
{
    public function inAction(){
        $name = $this->getRequest()->getParam('name');
        $email = $this->getRequest()->getParam('email');
        $password = $this->getRequest()->getParam('password');

        if(empty($name) || empty($email) || empty($password)){
            die('empty params');
        }

        redisQueue::inQueue('users', array(
            'name' => $name,
            'email' => $email,
            'password' => $password
        ));

        echo 'in_success';
        return false;
    }

    public function outAction(){
        redisQueue::outQueue('users');
        return false;
    }

    public function showAction(){
        redisQueue::showQueue('users');
        return false;
    }
}