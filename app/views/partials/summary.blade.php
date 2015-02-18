<div class="summary clearfix">
    <h3 class="summary__title">{{ Lang::get('app.summary.title') }}</h3>
    <div class="col-xs-12">
        <div class="summary__mean">
            <span class="summary__name">{{ Lang::get('app.summary.mean') }}</span>
            <span class="summary__amount">{{ $summary->meanSpending }}</span>
        </div>
    </div>
    <div class="row">
        <?php $numUsers = count( $summary->spenders ); ?>
        @foreach($summary->spenders as $spender)
        <div class="col-xs-{{ HTML::summary_col_size( $numUsers ) }}">
            <div class="summary__stat{{ ($spender->deviation > 0) ? ' -positive' : ' -negative'}}">
                <span class="summary__deviation">{{ $spender->deviation }}</span>
                <div class="summary__user">
                    <span class="summary__amount">{{ $spender->total }}</span>
                    <span class="summary__name">{{ $spender->name }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{--<div class="row">--}}
        {{--<ol class="top-types">--}}
        {{--@foreach($chartData as $type)--}}
            {{--<li class="label {{ HTML::color_by_option($type['value']) }}">{{$type['label']}} <span class="sum">{{$type['total']}}</span></li>--}}
        {{--@endforeach--}}
        {{--</ol>--}}
    {{--</div>--}}
</div>