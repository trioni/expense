<?php namespace Expense;

use Summary;
use ChartData;

class SummaryComposer {
    function compose( $view )
    {
        $chart = new ChartData();
        $chartData = $chart->get();

        $be = array(
            'chart'=> $chartData
        );

        $view->with(array(
            'summary'=> new Summary(),
            'chartData'=> $chartData,
            'be'=> json_encode($be),
        ));
    }
}