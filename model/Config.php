<?php 

namespace Simon\RideFrance\Model;

class Config 
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=rideFrance;charset=utf8', 'root', 'root');
        return $db;
    }
}