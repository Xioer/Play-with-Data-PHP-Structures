<?php
interface SetInfo
{
    public function add($e);

    public function remove($e);

    public function contains($e);

    public function getSize();

    public function isEmpty();
}