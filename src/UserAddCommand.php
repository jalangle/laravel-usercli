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
	protected $signature = 'user:add {email} {--name=} {--email=} {--group=} {--password=}';

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
		$email =  $this->argument('email');
		$user = $this->userModel::where('email', $this->argument('email'))->first();
		if($user)
		{
			$this->error("User $email already exists");
			return;
		}

		$name = $this->option('name') ?? "Anonymous User";
		$group = $this->option('group') ?? "guest";
		$pass1 = $this->option('password') ?? null;

		$user = new $this->userModel();
		$user->email = $email;
		$user->name = $name;
		if($pass1)
		{
			$user->password = Hash::make($pass1);
		}
		$user->save();

		if(Helpers::enumerateBouncerRoles()->contains($group))
		{
			$user->assign($group);
		}
	}
}

