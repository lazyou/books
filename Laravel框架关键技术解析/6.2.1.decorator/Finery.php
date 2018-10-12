<?php

class Finery implements Decorator
{
    private $component;

    public function __construct(Decorator $component)
    {
        echo "Finery: \n";
        $this->component = $component;
    }

    public function display()
    {
        $this->component->display();
    }
}
