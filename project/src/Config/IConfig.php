<?php


namespace App\Config;


interface IConfig
{
    /**
     * Получение элемента из конфига
     */
    public function get(string $var);

}