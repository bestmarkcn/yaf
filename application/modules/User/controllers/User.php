<?php
use Tools\Http;

class UserController extends Yaf\Controller_Abstract
{
    public function indexAction(){
        //echo phpinfo();
        echo 11;
        $rows = Database::getInstance()->query('SELECT `id`,`password` FROM users ORDER BY `id` DESC ;');
        echo 22;
        var_dump($rows->fetchAll(PDO::FETCH_ASSOC));
    }
}