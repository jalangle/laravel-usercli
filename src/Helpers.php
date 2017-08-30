<?php

namespace GHTNS\LaraUserCLI;

use Config;
use Illuminate\Support\ServiceProvider;
use Silber\Bouncer\Database\Role;

class Helpers
{
	public static function isBouncerInstalled()
	{
        $providers = Config::get('app.providers');
       	return collect($providers)->contains('Silber\Bouncer\BouncerServiceProvider');
	}

	public static function enumerateBouncerRoles()
	{
		if(Helpers::isBouncerInstalled())
			return Role::all()->pluck('name');
		return collect([]);
	}
}