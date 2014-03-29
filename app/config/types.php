<?php

$types = array(
    array('value'=>'mat','label'=>'Mat'),
    array('value'=>'restaurang','label'=>'Restaurang'),
    array('value'=>'bar','label'=>'Bar'),
    array('value'=>'hem','label'=>'Hem'),
    array('value'=>'resa','label'=>'Resa'),
    array('value'=>'övrigt','label'=>'Övrigt'),
);

// return the types ordered by label
return array_values(array_sort($types, function($value)
{
    return $value['label'];
}));