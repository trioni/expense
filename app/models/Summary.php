<?php

class Spender {
    public $name;
    public $total;
    public $deviation;

    function __construct($userConfig, $mean)
    {
        $this->name = $userConfig['display'];
        $this->total = $this->getTotal();
        $this->deviation = $this->total - $mean;
    }

    private function getTotal()
    {
        $total = DB::table('expenses')->whereRaw('owner = ? AND include = true', array($this->name))->sum('expense');
        return intval($total);
    }
}
class Summary {
    private $meanSpending = 0;
    private $spenders = array();

    function __construct()
    {
        $this->meanSpending = $this->getMeanSpending();
        $this->createSpenders();

        $leader = $this->getLeader();
        $this->leader = $leader->name;

        $this->diff = $this->getPositiveDiff($leader->total, $this->getMeanSpending());
        $this->split = $this->diff / count( $this->spenders );
    }

    public function __get($property)
    {
        if (property_exists($this, $property))
        {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property))
        {
            $this->$property = $value;
        }
        return $this;
    }

    private function createSpenders()
    {
        $users = Config::get('users');
        foreach( $users as $user )
        {
            array_push($this->spenders, new Spender( $user, $this->meanSpending ));
        }
    }

    private function getPositiveDiff($leading, $mean)
    {
        $diff = $leading - $mean;
        return ($diff < 0) ? $diff*-1 : $diff;
    }

    private function getMeanSpending()
    {
        $totalSpending = DB::table('expenses')->where('include',true)->sum('expense');
        return intval($totalSpending / count( Config::get('users') ));
    }

    private function getLeader()
    {
        $sorted = array_values(array_sort($this->spenders, function($spender)
        {
            return -$spender->total;
        }));
        return $sorted[0];
    }
}