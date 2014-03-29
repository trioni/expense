<?php

class Expense extends Elegant {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'expenses';

    protected $guarded = array('id','created_at');

	protected $rules = array(
        'title'=> 'required',
        'date' => 'required|date'
    );

    protected $messages = array(
        'required' => 'Fältet :attribute är obligatoriskt',
        'title.required'=> 'Titel behövs för att vi ska kunna använda utgiften',
        'date'=> 'Datum måste anges'
    );
}
