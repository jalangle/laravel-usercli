<?php

namespace GHTNS\LaraUserCLI;

use Bouncer;

class GroupAddCommand extends UserBaseCommand
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'group:add {group}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Add a group';

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
		if(Bouncer::role()->all()->contains($group))
		{
			$this->error("Group $group already exists");
		}

		Bouncer::role()->create(["name" => $group, "title" => ucfirst($group)]);
	}
}

