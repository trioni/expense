<?php namespace Expense;

use Illuminate\Support\Facades\Lang;

class TitleComposer {

    function compose( $view )
    {
        $view->with('titleSlug', $this->getTitleSlugByName( $view->getName() ));
    }

    private function getTitleSlugByName( $name )
    {
        $title = '';
        switch( $name )
        {
            case 'expenses.delete':
                $title = Lang::get('app.pages.delete.title');
                break;
            case 'expenses.edit':
                $title = Lang::get('app.pages.edit.title');
                break;
            case 'expenses.index':
                $title = Lang::get('app.pages.overview.title');
                break;
            case 'expenses.create':
                $title = Lang::get('app.pages.add.title');
                break;
            case 'sessions.create':
                $title = Lang::get('app.pages.login.title');
                break;

        }
        return $title;
    }
}