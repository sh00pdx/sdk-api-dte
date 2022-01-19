<?php

namespace ToDoSoft;

class Url {

    private $URLS;

    
    public function __construct()
    {
        $this->URLS = [
            'BASE_URL' => $_ENV['URL_BASE'] ?? 'ec2-54-172-105-92.compute-1.amazonaws.com/api/'
        ];
    }

    public function get($url){
        return $this->URLS[$url];
    }
    
}
