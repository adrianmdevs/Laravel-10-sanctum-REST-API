<?php

namespace App\Providers;

//use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //Define roles
        Role::create(['name'=>'superAdmin']);
        Role::create(['name'=>'pupil']);
        Role::create(['name'=>'teacher']);
        Role::create(['name'=>'guardian']);
        Role::create(['name'=>'staff']);
        //Define permissions
        Permission::create(['name' => 'view-teacher-profile']);
        Permission::create(['name' => 'edit-teacher-profile']);
        Permission::create(['name' => 'view-pupil-profile']);
        Permission::create(['name' => 'edit-pupil-profile']);
        Permission::create(['name' => 'view-guardian-profile']);
        Permission::create(['name' => 'edit-guardian-profile']);
        //Assigning permissions to roles
        $superAdmin=Role::findByName('superAdmin');
        $superAdmin->givePermissionTo(Permission::all());

        $teacher = Role::findByName('teacher');
        $teacher->givePermissionTo(['view-teacher-profile', 'edit-teacher-profile']);

        $pupil = Role::findByName('pupil');
        $pupil->givePermissionTo(['view-pupil-profile', 'edit-pupil-profile']);

        $guardian = Role::findByName('guardian');
        $guardian->givePermissionTo(['view-guardian-profile', 'edit-guardian-profile']);
    }
}
