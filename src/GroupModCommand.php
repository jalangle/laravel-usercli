<?php

namespace GHTNS\LaraUserCLI;

use Hash;

class GroupModCommand extends UserBaseCommand
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'group:mod {group}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Modify a group';

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

		$this->warn("Nothing implemented yet for group modification");
	}
}

