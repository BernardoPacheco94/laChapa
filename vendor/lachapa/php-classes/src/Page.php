<?php

namespace LaChapa;

use Rain\Tpl;

class Page
{
    private $tpl;
    private $options = [];
    private $defaults = [
        "header"=> true,
        "footer"=> true,
        "data" => []
    ];

    

    public function __construct($opts = array(), $tpl_dir = "/views/")
    {
        $this->options = array_merge($this->defaults, $opts);//o merge 'monta' os arrays em um só, porém o array que vale é o segundo do paramentro em caso de conflito  

        $config = array(
            "tpl_dir"       => $_SERVER['DOCUMENT_ROOT'].$tpl_dir,//o $_server['document_root] serve para que seja apontado através do root do servidor
            "cache_dir"     =>$_SERVER['DOCUMENT_ROOT']."/views-cache/",
            "debug"         => true
        );

        Tpl::configure($config);


        $this->tpl = new Tpl;

        $this->setData($this->options["data"]);

        if($this->options["header"]) $this->tpl->draw("header");
    }

    public function setTpl ($name, $data = array(), $returHTML = false)
    {
        $this->setData($data);

        return $this->tpl->draw($name, $returHTML);
    }

    public function __destruct()
    {
        if($this->options["footer"]) $this->tpl->draw("footer");
    }

    private function setData($data = array()) 
    {
        foreach ($data as $key => $value) {
            $this->tpl->assign($key, $value);
        }
    }
}
