<?php

class AutocompleteController extends BaseController {

    /**
     * Returns a list of distinct titles
     *
     * @return Response
     */
    public function index()
    {
        return Response::json( $this->getTitles() );
    }

    /**
     * Method used by other controllers
     */
    public function getDistinctTitles()
    {
        return $this->getTitles();
    }

    private function getTitles()
    {
        // The $titles are for autocompleting Titles
        $titles = DB::table('expenses')->distinct()->lists('title');
        return $titles;
    }
}