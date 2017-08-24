<?php

namespace GHTNS\LaraUserCLI;

use Hash;

class UserResetPassswordCommand extends UserBaseCommand
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'user:resetpassword';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Reset a user password';

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
		$email = $this->ask('Enter an email');
		$user = $this->userModel::where("email", $email)->first();
		if (!$user)
		{
			$this->error("No user found with email $email");
			return;
		}

		$pass1 = $this->secret('Enter a password');
		$pass2 = $this->secret('Confirm your password');
		if ($pass1 !== $pass2)
		{
			$this->error("passwords don't match");
			return;
		}

		$user->password = Hash::make($pass1);
		$user->save();

	}
}
