<?php

namespace App;

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreAssociateRequest;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function associatedTo()
    {
        $users = Auth::user()->associatedWith()->paginate(40);
        $bool = true;
        return view('users.associates', compact('users', 'bool'));
    }

    public function myAssociates()
    {
        $users = Auth::user()->associates()->paginate(40);
        $bool = false;
        return view('users.associates', compact('users', 'bool'));
    }

    public function profiles(Request $request)
    {
        $users = User::with(['associates', 'associatedWith']);

        if ($request->filled('name')) {
            $users = $users->findUsersByName($request->name);
        }
        $users = $users->paginate(40);
        //    dd($users);
        return view('users.profiles', compact('users'));
    }

    public function edit()
    {
        $user = Auth::user();
        $this->authorize('editUser', $user);
        // dd($user);
        return view('users.user_edit', compact('user'));
    }

    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();
        $this->authorize('editUser', $user);
        $data = $request->validated();

        $photo = null;
        if (isset($data['profile_photo'])) {
            $path = $data['profile_photo']->store('profiles', 'public');
            $photo = basename($path);
        }

        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'profile_photo' => $photo = $photo ?? $user['profile_photo'],
        ]);

        $user->save();

        return redirect()->route('home')->with('status', 'User updated succesfuly.');
    }

    public function editPassword()
    {
        $this->authorize('editUser', Auth::user());
        return view('users.password_edit');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();
        $this->authorize('editUser', $user);
        $data = $request->validated();

        $pw = Hash::make($data['password']);
        $user->password = $pw;
        $user->save();

        return redirect()->route('home')->with('status', 'Password has been changed.');
    }

    public function createAssociate(User $user){        
        return view('users.add_associate', compact('user'));
    }

    public function storeAssociate(StoreAssociateRequest $request){
        $user = Auth::user();
        $data = $request->validated();        
        $associate = User::find($data['associated_user']);
        //dd($user->id);
        $user->associates()->attach($associate, ['created_at' => Carbon::now()]);
        //$user->save();

        return redirect()->route('user.associates')->with('status', 'User associated successfully.');
    }

    public function deleteAssociate(User $user){
        $main_user = Auth::user();
        $this->authorize('deleteAssociate', $main_user);        
        //$associate = $main_user->associates()->where('id', $user->id)->first();
        //dd($associate);
        if(!$main_user->isAssociate($user->id)){
            //dd($main_user->isAssociate($user->id));
            //return redirect()->route('user.associates')->with('errors', 'User is not associated.');
            abort(404);
        }   
        
        $main_user->associates()->detach($user);

        return redirect()->route('user.associates')->with('status', 'User dissociated successfully.');
    }
}
