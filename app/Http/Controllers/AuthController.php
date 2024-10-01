<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller {
    public function register(){
        return Inertia::render('User/Register');
    }

    public function login(){
        return Inertia::render('User/Login');
    }

    public function profile(){
        return Inertia::render('User/Profile');
    }

    public function emailVerification(){
        return Inertia::render('User/VerificationEmail');
    }

    public function store(Request $request){
        $this->validate($request , [
            'name'=>'required',
            'email'=>'required',
            'password'=>'required|min:6',
        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
        ]);
        auth()->login($user);
        $request->session()->regenerate();
        return redirect()->route('home');
    }

    public function auth(Request $request){
        $this->validate($request , [
            'email'=>'required',
            'password'=>'required|min:6',
        ]);
        if(
        auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ],true)){
            $request->session()->regenerate();
            return redirect()->route('home');
        }else{
            return redirect()->route('login')->with([
                'message' => 'email or password dont match',
                'class' => 'alert alert-danger',
            ]);
        };
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function updateProfileImage(Request $request){
        $this->validate($request , [
            'photo_url' => 'required|mimes:jpg,png,jpeg|max:2000',
        ]);
        if(Storage::disk('public')->exists(auth()->user()->photo_url)){
            Storage::disk('public')->delete(auth()->user()->photo_url);
        }
        $file = $request->file('photo_url');
        $path = $file->store('users' , 'public');
        auth()->user()->update([
            'photo_url' => $path
        ]);

        return redirect()->route('profile')->with([
            'message' => 'photo updated successfully',
            'class' => 'alert alert-success',
        ]);
    }

    public function notifications() {
        return Inertia::render('User/Notifications',[
          'notifications' => auth()->user()->notifications
        ]);
    }

    public function makeNotificationAsRead($id) {
        $notification = auth()->user()->unreadNotifications->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
        }
        return redirect()->route('notification')->with([
            'message' => 'notification mark as Read successfully',
            'class' => 'alert alert-success',
        ]);
    }
    public function deleteNotification($id) {
        $notification = auth()->user()->notifications->where('id', $id)->first();
        if ($notification) {
            $notification->delete();
        }
        return redirect()->route('notification')->with([
            'message' => 'notification deleted successfully',
            'class' => 'alert alert-success',
        ]);
    }
}
