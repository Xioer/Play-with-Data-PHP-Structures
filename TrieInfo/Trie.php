<?php

// include_once 'MapInfo/BSTMap.php';
class TrieNode{

    public $isWord;
    public $next;

    public function __construct($isWord = false)
    {
        $this->isWord = $isWord;
        // $this->next = new BSTMap();
        //这里直接用数据来代替 - java里面是用Map,php的数组就支持key=>value这样的结构
        $this->next = [];
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

    //添加
    public function add($word)
    {
        $cur = $this->trieRoot;
        $len = strlen($word);
        for ($i = 0; $i < $len;$i++){
            $c = substr($word,$i,1);
            if (!$cur->next[$c]){
                $cur->next[$c] = new TrieNode();
            }
            $cur = $cur->next[$c];
        }

        if (!$cur->isWord) {
            $cur->isWord = true;
            $this->trieSize++;
        }
    }

    //查询单词是否存在
    public function contains($word)
    {
        $cur = $this->trieRoot;
        for ($i=0; $i < strlen($word); $i++) { 
            $c = substr($word,$i,1);
            if (!$cur->next[$c]) {
                return false;
            }
            $cur = $cur->next[$c];
        }
        return $cur->isWord;
    }

    //查询是否在Trie中有单词以prefix为前缀
    public function isPrefix($prefix)
    {
        $cur = $this->trieRoot;
        for ($i=0; $i < strlen($prefix); $i++) { 
            $c = substr($prefix,$i,1);
            if (!$cur->next[$c]) {
                return false;
            }
            $cur = $cur->next[$c];
        }
        return true;
    }

}