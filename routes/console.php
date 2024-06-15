<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Artisan::command('create {type?} {name?} {email?} {password?} {password_confirmation?} {picture?} {about?}', function ($type = null, $name = null, $email = null, $password = null, $password_confirmation = null, $picture = null, $about = null) {
    if (!$type || !$name || !$email || !$password || !$password_confirmation) {
        $type = $type ?: $this->ask('Enter user type (user/admin):');
        $name = $name ?: $this->ask('Enter user name:');
        $email = $email ?: $this->ask('Enter user email:');
        $password = $password ?: $this->secret('Enter user password:');
        $password_confirmation = $password_confirmation ?: $this->secret('Confirm user password:');
        $picture = $picture ?: $this->ask('Enter picture URL (optional):');
        $about = $about ?: $this->ask('Enter user about (optional):');
    }

    $validator = Validator::make([
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'password_confirmation' => $password_confirmation
    ], [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
        'password_confirmation' => 'required|min:8'
    ]);

    if ($validator->fails()) {
        $this->error('Validation failed. Please check your input.');
        foreach ($validator->errors()->all() as $error) {
            $this->error($error);
        }
        return;
    }

    if (!in_array($type, ['user', 'admin'])) {
        $this->error('Invalid type argument. Use "user" or "admin".');
        return;
    }

    if ($picture && !filter_var($picture, FILTER_VALIDATE_URL)) {
        $this->error('Invalid picture URL.');
        return;
    }

    $user = new User;
    $user->name = $name;
    $user->email = $email;
    $user->password = bcrypt($password);
    $user->picture = $picture;
    $user->about = $about;
    $user->admin = $type === 'admin' ? 1 : 0;
    $user->save();

    $this->info(ucfirst($type) . ' created successfully.');
});
