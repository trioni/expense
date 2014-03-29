@foreach( Config::get('users') as $user )
    @if( isset($expense) )
    <label class="btn btn-default{{ ($expense->owner == $user['value']) ? ' active':'' }}">
        <input type="radio" name="owner" id="{{ $user['value'] }}" value="{{ $user['value'] }}" required{{ ($expense->owner == $user['value']) ? ' checked="checked"':'' }}>
        {{ $user['display'] }}
    </label>
    @else
    <label class="btn btn-default">
        <input type="radio" name="owner" id="{{ $user['value'] }}" value="{{ $user['value'] }}" required>
        {{ $user['display'] }}
    </label>
    @endif
@endforeach