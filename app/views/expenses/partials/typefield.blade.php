@foreach(Config::get('types') as $option)
    @if( isset($expense) )
    <label class="btn btn-default{{ ($expense->type == $option['value']) ? ' active':''}}">
        <input type="radio" name="type" value="{{ $option['value'] }}" required{{ ($expense->type == $option['value']) ? ' checked="checked"':'' }}> {{ $option['label'] }}
    </label>
    @else
    <label class="btn btn-default">
        <input type="radio" name="type" value="{{ $option['value'] }}" required> {{ $option['label'] }}
    </label>
    @endif
@endforeach
