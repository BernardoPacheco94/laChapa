<?php

namespace LaChapa;

class Model {

    private $values = [];

    //método mágico para realizer os getters e setters automaticamente
    public function __call($name, $arguments)
    {   
        $method = substr($name, 0, 3);
        $fieldName = substr($name, 3, strlen($name));

        switch ($method) {
            case "set":
                $this->values[$fieldName] = $arguments[0];
            break;
            
            case "get":
                return (isset($this->values[$fieldName])) ? $this->values[$fieldName] : NULL;
            break;
        }

    }


    //faz os setter dinamicamente de acordo com o retorno do select
    public function setData($data = array())
    {
        foreach ($data as $key => $value) {
            $this->{"set".$key}($value);
        }
        
    }


    //método get dinamico
    public function getData()
    {
        return $this->values;
    }

}

