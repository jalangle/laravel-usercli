<?php

namespace GHTNS\LaraUserCLI;

class UserModCommand extends UserBaseCommand
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'user:mod {email} {--name=} {--email=} {--group=}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Modify a user';

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
		$user = $this->userModel::where('email', $this->argument('email'))->first();
		if(!$user)
		{
			$this->error("User " . $this->argument('email') . " not found");
		}

		$email = $this->option('email');
		if($email)
		{
			$user->email = $email;
		}

		$name = $this->option('name');
		if($name)
		{
			$user->name = $name;
		}

		$user->Save();

		$mainGroup = $this->option('group');
		if($mainGroup)
		{
			if(Helpers::enumerateBouncerRoles()->contains($mainGroup))
			{
				$user->retract($user->roles()->get());
				$user->assign($mainGroup);
				$this->line("add " . $user->email . " to " . $mainGroup);
			}
			else
			{
				$this->error("Group " . $mainGroup . " does not exist");
			}
		}



	}
}

