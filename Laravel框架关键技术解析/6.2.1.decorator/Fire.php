<?php

class Fire extends Finery
{
    public function display()
    {
        echo "Fire: \n";
        echo "出门前先整理头发 \n";
        parent::display();
        echo "出门后先再整理一下头发 \n";
    }
}
