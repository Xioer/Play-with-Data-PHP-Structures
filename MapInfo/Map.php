<?php


interface Map
{
    public function add($k,$v);

    public function remove($k);

    public function contains($k);

    public function get($k);

    public function set($k,$v);

    public function getSize();

    public function isEmpty();

}