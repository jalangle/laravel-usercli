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
		$headers = ['id', 'name', 'email', 'has_password'];
		if(Helpers::isBouncerInstalled())
		{
			array_push($headers, 'roles');
		}

		$users = $this->userModel::all();
		$tabledata = $users->map(function ($item, $key) {
			$data = [$item->id, $item->name, $item->email, ($item->password != null) ? 'YES' : 'NO'];
			if(Helpers::isBouncerInstalled())
			{
				array_push($data, $item->roles->implode('name', ','));
			}
			return $data;
		});

		$this->table($headers, $tabledata);
	}
}
