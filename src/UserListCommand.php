<?php

namespace GHTNS\LaraUserCLI;

use Illuminate\Console\Command;
use App\User;
use Hash;

class UserListCommand extends Command
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
		$this->line("ID\tNAME\tEMAIL");
		foreach(User::all() as $user)
		{
			$this->line("$user->id\t$user->name\t$user->email");
		}
	}
}
