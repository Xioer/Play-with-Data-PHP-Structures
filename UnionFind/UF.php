<?php

//并查集
interface UF{
    public function isConnected($p,$q);
    public function unionElements($p,$q);
    public function getSize();
}