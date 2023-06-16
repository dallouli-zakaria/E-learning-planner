<?php

namespace App\Http\Controllers;

use App\Models\Matier;
use App\Models\Niveau;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\isNan;

class UserController extends Controller
{

    //show users page
    public function index(){

        $data = User::with("niveau")->get();
        return view('users.index',['users'=>$data]);
    }

    // Show Register/Create Form
    public function create() {
        if(isset(auth()->user()->role) && auth()->user()->role=="Admin"){
            $data = Niveau::all();
            return view('users.register',[
                'niveaux' => $data
            ]);
        }
        return redirect("/");
    }

    // Create New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'niveau_id' => ['required'],
            'role' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // store the avatar image if it exists
        if($request->hasFile('logo')) {
            $formFields['avatar'] = $request->file('logo')->store('avatars', 'public');
        }

        // Create User
        $user = User::create($formFields);

        // Login
        //auth()->login($user);

        // rredirect to home page with message 'User created and logged in'
        return redirect('/users')->with('message', 'User created and logged in');
    }

    // Logout User
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');

    }

    // Show Login Form
    public function login() {
        return view('users.login');
    }

    // Authenticate User
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    // Show Edit Form for user
    public function edit(Request $request) {
        $session = User::with('niveau')->find($request->id);
        $niveaux = Niveau::all();
        return view('users.update', ['user' => $session,'niveaux'=>$niveaux]);
    }

    // Update user Data
    public function update(Request $request) {
        $user = User::find($request->id);
        if("Admin" != auth()->user()->role && auth()->user()->id != $user->id) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'niveau_id' => ['required'],
            'role' => ['required'],
            'email' => ['required', 'email']
        ]);

        if($request->hasFile('logo')) {
            $formFields['avatar'] = $request->file('logo')->store('avatars', 'public');
        }

        $user->update($formFields);

        return back()->with('message', 'User updated successfully!');
    }

    // Update user Data
    public function updateRole(Request $request) {
        $user = User::find(auth()->user()->id);
        $formFields = $request->validate([
            'role' => ['required'],
        ]);

        $user->update($formFields);
        auth()->login($user);
        return back()->with('message', 'Welcome '.$user->role);
    }

    // Delete Session
    public function destroy(Request $request) {
        $user = User::find($request->id);
        // Make sure the user is admin before deleting a user
        if("Admin" != auth()->user()->role) {
            abort(403, 'Unauthorized Action');
        }

        if(isset($user->avatar) && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }
        $user->delete();
        return UserController::index();
        //return redirect('/')->with('message', 'user deleted successfully');
    }
}
