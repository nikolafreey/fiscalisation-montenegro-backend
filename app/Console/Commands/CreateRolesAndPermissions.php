<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRolesAndPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:sync';

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
     * @return int
     */
    public function handle()
    {
        $this->info('Starting to sync roles');

        Role::firstOrCreate(['name' => 'superadmin']);
        Role::firstOrCreate(['name' => 'default']);

        Permission::firstOrCreate(['name' => 'edit preduzeca']);
        Permission::firstOrCreate(['name' => 'edit users']);

        foreach (User::all() as $user) {
            $user->assignRole('default');
        }

        User::where('ime', 'Super Admin')->firstOrFail()->syncRoles(['superadmin']);

        $this->info('Done');

        return 0;
    }
}
