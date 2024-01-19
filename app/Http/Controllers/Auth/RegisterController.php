<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'telephone'=> ['required', 'string','max:10','min:10' ],
            'type'=> ['required'],
            'service_id'=> ['required'],
            'specialiter_id'=> ['required'],
            'role_id'=> ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $request = request();
        $imageOriginalName = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public', $imageOriginalName);



        $createbox = $request->input('createbox', false);
        $storedValue = $createbox ? 1 : 0;


        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'telephone'=>$data['telephone'],
            'type'=>$data['type'],
            'image' => $imageOriginalName,
            'service_id'=>$data['service_id'],
            'specialiter_id'=>$data['specialiter_id'],
            'role_id'=>$data['role_id'],
            'create' => $storedValue,
        ]);
        $originalFilePath = 'storage/app/path/to/your/image.jpg';
        $newFilePath = 'public/images/image.jpg';
Storage::move($originalFilePath, $newFilePath);
    }
}
