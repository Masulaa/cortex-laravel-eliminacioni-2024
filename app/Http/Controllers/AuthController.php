<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Ensure Auth facade is imported

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $request->session()->put('user_id', $user->id);
    
        return redirect('/home');
    }
    
    public function signin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $validated['email'])->first();
    
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return redirect("signin");
        }
    
        $request->session()->put('user_id', $user->id);
    
        return redirect('/home');
    }
    

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        return redirect('/home');
    }

    public function editProfile(Request $request)
    {
        $userId = $request->session()->get('user_id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('signin')->with('error', 'You must be logged in to edit your profile.');
        }

        return view('profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $userId = $request->session()->get('user_id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('signin')->with('error', 'You must be logged in to update your profile.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'about' => 'nullable|string',
            'picture' => 'nullable|image|max:2048',
            'password'=>'nullable|string|max:255'
        ]);

        // Update user data
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->about = $validated['about'];
        if($validated['password']>7){
        $user->password =Hash::make($validated['password']);
}
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('profile-pictures', 'public');
            $user->picture = $picturePath;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }

    public function admin(Request $request)
    {
        $userId = $request->session()->get('user_id');
        $user = User::find($userId);

        if ($user && $user->admin) {
            //return response()->json(['message' => 'User is an admin']);
            return view('admin.admin');
        } else {
            abort(403, 'Unauthorized action. You must be Admin');
        }
    }
}
