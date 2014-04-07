<?php namespace Expense;

use Summary;

class SummaryComposer {
    function compose( $view )
    {
        $view->with(array(
            'summary'=> new Summary(),
            ''=>'Megalomani'
        ));
    }
}