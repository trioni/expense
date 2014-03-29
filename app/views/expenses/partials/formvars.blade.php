<?php
$currentDate = new DateTime('NOW');
?>

@section('headscripts')
<script>
    var app = app || {};
    app.autocomplete = {
        titles: {{ $titles }}
    };
</script>
@stop
