<?php

class ChartData {

    private function getTypeTotal( $type )
    {
        $query = DB::table('expenses')->whereNull('deleted_at')->where('type',$type);
        $result = $query->remember(720)->sum('expense');
        return $result;
    }

    public function get()
    {
        $typesTotal = array();

        foreach(Config::get('types') as $type ) {
            array_push($typesTotal, array(
                'label' => $type['label'],
                'value' => $type['value'],
                'total' => intval($this->getTypeTotal($type['value'])),
            ));
        }

//        usort($typesTotal, function($a, $b) {
//            return $a['total'] - $b['total'];
//        });

        // Reverse the array for correct output when looping
//        $typesTotal = array_reverse($typesTotal);

        return $typesTotal;
    }
}
