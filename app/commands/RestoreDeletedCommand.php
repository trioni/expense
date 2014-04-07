<?php

use Illuminate\Console\Command;

class RestoreDeletedCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'expense:restore';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Restore deleted expenses. Just a helper to minimize manual work.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->info('Restoring soft deleted expenses');
        Expense::onlyTrashed()->restore();
        $this->info('Done!');
	}

}
