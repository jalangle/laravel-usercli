<?php

namespace GHTNS\LaraUserCLI;

use Bouncer;

class GroupListCommand extends UserBaseCommand
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'group:list';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'List available groups';

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

		$headers = ['id', 'group', 'title'];

		$tabledata = Bouncer::role()->all()->map(function($item, $key) {
			$data = [$item->id, $item->name, $item->title];
			return $data;
		});

		$this->table($headers, $tabledata);
	}
}

