<?php

use Illuminate\Support\MessageBag;

class ExpenseController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return $this->filter();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('expenses.create')->with(array(
            'titles'=> json_encode($this->getTitles())
        ));
	}

    private function getTitles()
    {
        // The $titles are for autocompleting Titles
        $titles = DB::table('expenses')->distinct()->lists('title');
        return $titles;
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $expense = new Expense(Input::all());
        $expense->save();
        return Redirect::back()->with('flash_message',array(
            'msg'=> Lang::get('app.feedback.save.success'),
            'status'=>'success'
        ));
	}

    private function getFilteredExpenses()
    {
        $query = Expense::orderBy('created_at','desc')->whereNull('deleted_at');

        $owner = Request::query('owner');
        $type = Request::query('type');
        $title = Request::query('title');
        $excluded = Request::query('excluded');

        if($owner)
        {
            $query->where('owner', $owner);
        }

        if($type)
        {
            $query->where('type', $type);
        }

        if($title)
        {
            $query->where('title','LIKE', '%'.$title.'%');
        }

        if($excluded)
        {
            $query->where('include', false);
        }

        if(!$owner && !$type && !$title)
        {
            $query->take( Config::get('app.pagesize') );
        }
        $result = $query->paginate( Config::get('app.pagesize') );
        return $result;

    }

    public function filter()
    {
        if( Input::has('json-response') )
        {
            return Response::json($this->getFilteredExpenses());
        }
        return View::make('expenses.index')->with(array(
            'filtered' => $this->getFilteredExpenses()
        ));
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('expenses.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $expense = Expense::find($id);

        if(Input::has('json-response'))
        {
            return Response::json($expense);
        }
        return View::make('expenses.edit')->with(array(
            'titles'=> json_encode($this->getTitles()),
            'expense'=> $expense
        ));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$expense = Expense::findOrFail($id);
        $ip = Input::except('displayDate','json-response');
        $expense->fill( $ip );

        if($expense->validate())
        {
            $expense->save();

            $response_data = array(
                'msg'=> Lang::get('app.feedback.update.success'),
                'status'=>'success',
            );

            if( Input::has('json-response') )
            {
                $response_data['item'] = json_decode($expense);
                return Response::json($response_data);
            }
            return Redirect::back()->with('flash_message', $response_data);
        }
        else
        {
            $response_data = array(
                'msg' => $expense->errors(),
                'status' => 'danger',
            );

            if( Input::has('json-response') )
            {
                return Response::json($response_data);
            }

            return Redirect::back()->with('flash_message', $response_data);
        }
	}

    private function getRestoreMessage( $id, $title )
    {
        $msg = Lang::get('app.feedback.delete.success', array('title'=>$title));
        $msg .= ' <a href="'. action('ExpenseController@restore', $id) .'">'. Lang::get('app.feedback.delete.restore') .'</a>';
        $messagebag = new MessageBag();
        $messagebag->add('deleted', $msg);
        return $messagebag;
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		try
        {
            $expense = Expense::findOrFail($id);
            $title = $expense->title;
            $expense->delete();
            return Redirect::to('/')->with('flash_message', array(
                'msg'=> $this->getRestoreMessage($id, $title),
                'status'=>'success'
            ));
        }
        catch (Exception $e)
        {
            return Redirect::to('/')->with('flash_message', array(
                'msg'=>Lang::get('app.feedback.delete.nonexisting'),
                'status'=>'danger'
            ));
        }
	}

    public function delete($id)
    {
        $expense = Expense::findOrFail($id);
        return View::make('expenses.delete')->with(array(
            'expense'=> $expense
        ));
    }

    public function restore($id)
    {
        Expense::onlyTrashed()->where('id', $id)->restore();
        $expense = Expense::withTrashed()->where('id', $id)->first();
        return Redirect::to('/')->with('flash_message', array(
            'msg'=> Lang::get('app.feedback.restore.restored', array('title'=>$expense->title)),
            'status'=>'success'
        ));
    }

}
