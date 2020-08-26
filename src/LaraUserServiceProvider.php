<?php

namespace GHTNS\LaraUserCLI;
use Illuminate\Support\ServiceProvider;

class LaraUserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    	$this->registerCommands();
    }

    /**
     * Register artisan console commands
     * 
     * @return void
     */
    private function registerCommands()
    {
        $this->commands(UserAddCommand::class);
        $this->commands(UserDeleteCommand::class);
        $this->commands(UserListCommand::class);
        $this->commands(UserModCommand::class);
        $this->commands(UserResetPassswordCommand::class);

        if(Helpers::isBouncerInstalled())
        {
            $this->commands(GroupAddCommand::class);
            $this->commands(GroupDeleteCommand::class);
            $this->commands(GroupListCommand::class);
            $this->commands(GroupModCommand::class);

        }
    }
}