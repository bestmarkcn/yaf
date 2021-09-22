<?php

class redisQueue
{
    public static function inQueue($queueName, $data){
        Yaf\Registry::get('_redis')->rpush($queueName, json_encode($data));
    }

    public static function outQueue($queueName){
        $value = Yaf\Registry::get('_redis')->lpop($queueName);
        if(!empty($value)){
            $result = Yaf\Registry::get('_db')->insert('users', json_decode($value, true));
            echo 'success';
        }else{
            echo 'nothing';
        }
    }

    public static function showQueue($queueName){
        var_dump(Yaf\Registry::get('_redis')->lrange($queueName,0,-1));
    }


}