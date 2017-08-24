<?php

namespace GHTNS\LaraUserCLI;

use Config;
use Illuminate\Console\Command;
use Hash;

class UserBaseCommand extends Command
{
	protected $userModel;

	public function __construct()
	{
		parent::__construct();
		
		$this->userModel = Config::get('auth.providers.users.model', \App\User::class);
	}
}