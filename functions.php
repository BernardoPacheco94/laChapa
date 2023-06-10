<?php

function formatPrice($price)
{
    return number_format($price,2,',','.');
}

function verificaArray(Array $array)
{
    if(isset($array)){
        return true;
    } else{
        return false;
    }
}

function formatDate($date)
{
    return date('d/m/y H:i', strtotime($date));
}
