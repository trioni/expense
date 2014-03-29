<?php

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
            'titles'=> json_encode($this->getTitles()),
            'slug'=> Lang::get('app.pages.add.title')
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

    public function filter()
    {
        $query = Expense::orderBy('created_at','desc');

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

        return View::make('expenses.index')->with(array(
            'summary' => new Summary(),
            'filtered' => $result,
            'slug'=>Lang::get('app.pages.overview.title')
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
        return View::make('expenses.edit')->with(array(
            'titles'=> json_encode($this->getTitles()),
            'expense'=> $expense,
            'slug'=>Lang::get('app.pages.edit.title') . ' ' . $expense->title
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
        $expense->fill(Input::all());

        if($expense->validate())
        {
            $expense->save();
            return Redirect::back()->with('flash_message', array(
                'msg'=>Lang::get('app.feedback.update.success'),
                'status'=>'success'
            ));
        }
        else
        {
            return Redirect::back()->with('flash_message', array(
                'msg'=> $expense->errors(),
                'status'=>'danger'
            ));
        }
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
                'msg'=>Lang::get('app.feedback.delete.success',array('title'=>$title)),
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
            'expense'=> $expense,
            'slug'=>Lang::get('app.pages.delete.title') . ' ' . $expense->title
        ));
    }

}
