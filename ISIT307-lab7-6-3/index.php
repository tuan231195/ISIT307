<?php

class Tree
{
    private $root;
    public function __construct(){
        $this->root = NULL;
    }

    public function add($value)
    {
        $this->addNode($this->root, $value);
    }

    private function addNode(&$node, $value)
    {
        if($node == null){
            $node = new Node($value);
        }
        else
        {
            if ($node ->value < $value)
            {
                $this->addNode($node ->right, $value);
            }
            else if ($node -> value > $value){
                $this->addNode($node ->left, $value);
            }
        }
    }

    public function output()
    {
        $this->inorder($this->root);
        echo "<br/>";
    }

    private function inorder($node)
    {
        if ($node != null)
        {
            $this->inorder($node->left);
            echo "$node   ";
            $this->inorder($node->right);
        }
    }



}


class Node
{
    public $left;
    public $right;
    public $value;
    public function __construct($value)
    {
        $this->value = $value;
        $this->left = NULL;
        $this->right = NULL;
    }

    public function __toString() {
        return "$this->value";
    }
}


$b1 = new Tree();
$b1->add("Hi");
$b1->add("See you");
$b1->add("Bye");
$b1->add("Hello");
$b1->output();


$b1 = new Tree();
$b1->add(1);
$b1->add(2);
$b1->add(3);
$b1->add(4);
$b1->output();


$b1 = new Tree();
$b1->add(4);
$b1->add(3);
$b1->add(2);
$b1->add(1);
$b1->output();
