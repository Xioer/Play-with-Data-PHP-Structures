<?php

include_once 'MapInfo/BSTMap.php';
class TrieNode{

    public $isWord;
    public $next;

    public function __construct($isWord = false)
    {
        $this->isWord = $isWord;
        $this->next = new BSTMap();
    }
}

class Trie
{
    private $trieRoot;
    private $trieSize;

    public function __construct()
    {
        $this->trieRoot = new TrieNode();
        $this->trieSize = 0;
    }

    public function getSize()
    {
        return $this->trieSize;
    }

    public function add($word)
    {
        $cur = $this->trieRoot;
        for ($i = 0; $i < strlen($word);$i++){
            $c = substr($word,$i,$i+1);
            if ($cur.next().get($c)){
                $cur.next().put($c, new TrieNode());
            }
            $cur = $cur.next().get($c);
        }

        if (!$cur.is_writable()) {
            # code...
        }
    }

}