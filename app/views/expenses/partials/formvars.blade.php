<?php
$currentDate = new DateTime('NOW');
?>

@section('headscripts')
app.autocomplete = {
    titles: {{ $titles }}
};
@stop
