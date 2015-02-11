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
    public $typesTotal = array();

    function __construct()
    {
        $this->meanSpending = $this->getMeanSpending();
        $this->createSpenders();

        $leader = $this->getLeader();
        $this->leader = $leader->name;

        $this->diff = $this->getPositiveDiff($leader->total, $this->getMeanSpending());
        $this->split = $this->diff / count( $this->spenders );
        $this->typesTotal = $this->getTypesTotal();
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

    //--- Get the total for each type ---//
    private function getTypeTotal( $type )
    {
        $query = DB::table('expenses')->whereNull('deleted_at')->where('type',$type);
        $result = $query->remember(5)->sum('expense');
        return $result;
    }

    private function getTypesTotal()
    {
        $typesTotal = array();

        foreach(Config::get('types') as $type ) {
            array_push($typesTotal, array(
                'label' => $type['label'],
                'value' => $type['value'],
                'total' => intval($this->getTypeTotal($type['value'])),
            ));
        }

        usort($typesTotal, function($a, $b) {
            return $a['total'] - $b['total'];
        });

        // Reverse the array for correct output when looping
        $typesTotal = array_reverse($typesTotal);

        return $typesTotal;
    }
}