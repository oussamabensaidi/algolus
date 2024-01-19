<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'telephone'=> ['required', 'string','max:10','min:10' ],
            'type'=> ['required'],
            'service_id'=> ['required'],
            'specialiter_id'=> ['required'],
            'role_id'=> ['required'],
        ]);

        $imageOriginalName = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public', $imageOriginalName);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telephone'=>$request['telephone'],
            'type'=>$request['type'],
            'image' => $imageOriginalName,
            'service_id'=>$request['service_id'],
            'specialiter_id'=>$request['specialiter_id'],
            'role_id'=>$request['role_id'],
        ]);
        $originalFilePath = 'storage/app/path/to/your/image.jpg';
        $newFilePath = 'public/images/image.jpg';
        Storage::move($originalFilePath, $newFilePath);
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
