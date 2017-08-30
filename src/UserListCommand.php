<?php

namespace GHTNS\LaraUserCLI;

use Hash;

class UserListCommand extends UserBaseCommand
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'user:list';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'list all users';

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
		$header = "ID\tNAME\tEMAIL";
		if(Helpers::isBouncerInstalled())
		{
			$header .= "\tROLES";
		}
		$this->line($header);

		foreach($this->userModel::all() as $user)
		{
			$line = "$user->id\t$user->name\t$user->email";
			if (Helpers::isBouncerInstalled())
			{
				$roles = $user->roles->implode('name', ',');
				$line .= "\t$roles";
			}

			$this->line($line);
		}
	}
}
