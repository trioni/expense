@if(Session::get('flash_message'))
<?php $msg = Session::get('flash_message')['msg']; ?>
@if(is_object($msg))
@foreach($msg->all() as $message)
<p class="alert alert-{{ Session::get('flash_message')['status'] }}">{{ $message }}</p>
@endforeach
@else
<div class="row">
    <div class="col-md-12">
        <p class="alert alert-{{ Session::get('flash_message')['status'] }}">{{ Session::get('flash_message')['msg'] }}</p>
    </div>
</div>
@endif
@endif
