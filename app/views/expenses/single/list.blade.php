<div class="expense__frame{{ ($expense->include == 0) ? ' -excluded':'' }}">
    <div class="expense__container">
        <div class="expense__body">
            <p class="expense__owner">{{ $expense->owner }}
                <span class="label{{ HTML::color_by_option($expense->type) }} type">{{ link_to('expenses/filter?type='.$expense->type, $expense->type) }}</span>
                <span class="timestamp">{{ $expense->date }}</span>
                @if( $expense->include == 0 )
                {{ link_to('expenses/filter?excluded=1', Lang::get('app.query.excluded'), array('class'=>'expense--excluded')) }}
                @endif
            </p>
            {{ link_to('expenses/filter?title='.$expense->title, $expense->title,array('class'=>'expense__title')) }}
            <span class="amount">{{ $expense->expense }} hkd</span>
        </div>
        <div class="actions">
            <button class="actions__toggle"><span></span></button>
            <a href="{{ action('ExpenseController@edit', $expense->id)  }}" class="btn btn-default">{{ Lang::get('app.actions.edit') }}</a>

            {{ Form::open(array('method'=>'DELETE','route'=>array('expenses.destroy',$expense->id),'class'=>'delete-form')) }}
            {{ Form::submit(Lang::get('app.actions.delete') ,array('class'=>'btn btn-warning')) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
