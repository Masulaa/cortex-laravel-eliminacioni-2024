<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CreateCustomUser extends Command
{
    protected $signature = 'custom:user';

    protected $description = 'Create a custom user';

    public function handle()
    {
        $name = $this->ask('Enter user name:');
        $email = $this->ask('Enter user email:');
        $password = $this->secret('Enter user password:');
        $picture = $this->ask('Enter picture URL (optional):');
        $about = $this->ask('Enter user about (optional):');
        $admin = $this->confirm('Is this user an admin?');

        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->picture = $picture;
        $user->about = $about;
        $user->admin = $admin;
        $user->save();

        $this->info('Custom user created successfully.');
    }
}
