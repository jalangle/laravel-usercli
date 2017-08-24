<?php

namespace GHTNS\LaraUserCLI;

use Hash;

class UserDeleteCommand extends UserBaseCommand
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'user:delete';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Remove a user';

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
		$email = $this->ask('What user email would you like to remove?');

		$result = $this->userModel::where("email", $email)->delete();
		if ($result == 0)
		{
			$this->error("No user found using $email");
		}
	}
}
