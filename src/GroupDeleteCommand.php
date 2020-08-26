<?php

namespace GHTNS\LaraUserCLI;

use Bouncer;

class GroupDeleteCommand extends UserBaseCommand
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'group:del {group}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Remove a group';

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
	public function handle()
	{
		if(!Helpers::isBouncerInstalled())
		{
			$this->error("Bouncer is an upstream dependency required for group management");
		}

		$group = strtolower($this->argument('group'));
		$model = Bouncer::role()->where('name', $group)->first();

		if(!$model)
		{
			$this->warn("The group $group does not exist");
			return;
		}

		if($model->users()->count())
		{
			if(!$this->confirm("The group $group has users.  Are you sure you want to remove it?"))
			{
				$this->line("abort");
				return;
			}
		}

		$this->info("Deleting $group");
		$model->delete();
	}
}

