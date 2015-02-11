<?php

class AppBootController extends BaseController {

    /**
     * Returns global values for the app
     */
    public function index()
    {
        $data = array(
            'titles' => App::make('AutocompleteController')->getDistinctTitles(),
            'users' => Config::get('users'),
            'types' => Config::get('types'),
        );
        return Response::json($data);
    }
}