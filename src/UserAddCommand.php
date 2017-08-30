<?php

namespace GHTNS\LaraUserCLI;

use Hash;

class UserAddCommand extends UserBaseCommand
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'user:add';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Add a user';

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
		$name = $this->ask('What is your name');
		$email = $this->ask('What is your email');

		$pass1 = $this->secret('Enter a password');
		$pass2 = $this->secret('Confirm your password');
		if ($pass1 !== $pass2)
		{
			$this->error("passwords don't match");
			return;
		}

		$user = new $this->userModel();
		$user->name = $name;
		$user->password = Hash::make($pass1);
		$user->email = $email;
		$user->save();

		$roles = Helpers::enumerateBouncerRoles();
		if($roles->count() > 0)
		{
			$role = $this->choice('What role does this user have?', $roles->toArray());
			if($role)
			{
				$user->assign($role);
			}
		}
	}
}

