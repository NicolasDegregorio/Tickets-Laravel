<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\User;


class UserController extends Controller
{
    public function login()
    {
        if (!auth()->check()) {
            return view('frontend.login');
        }else{
            return redirect('/dashboard');
        }  
    }

    public function logout()
    {
        Auth::logout();
        
        return redirect('/');
    }

    public function show($id){
        $user = User::findOrFail($id);
        $userJson = 
            ['id'    => $user->id,
            'name'   => $user->name,
            'email'  => $user->email, 
            'rol'    => $user->role->name,
            ];
        return response()->json([
            'user' => $userJson
        ]);
    }

    public function update(Request $request){
        $data = request()->validate([
            'name'      => ['required', 'string', 'max:255'],
            'password'  => ['required', 'string', 'min:6'],
            'role'      => 'required|integer',
            
            
        ], [
            'name.required'      => 'El campo nombre es obligatorio',
            'name.string'        => 'El campo nombre solo acepta cadena de textos',
            'name.max'           => 'El campo nombre tiene que tener una longitud maxima de 255 caracteres',
            'password.required'  => 'El campo contraseña es obligatorio',
            'password.string'    => 'El campo contraseña solo acepta cadena de textos',
            'password.min'       => 'La contraseña debe contener 6 caracteres como minimo',
            'role.required'      => 'El Campo Rol Es Obligatorio',
            'role.integer'       => 'role_id Debe Ser un Numero',
            
            
        ]);
        $user = Auth::user();
        $user->name     = $request->name;
        //$user->email    = $request->email; 
        if (!$request->password == '') {
            $user->password = bcrypt($request->password);
        }
        $user->role_id  = $request->role;
        $user->save();
        
        notify()->success('User Editado Correctamente');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        notify()->error('Usuario Eliminado Correctamente');
        return redirect()->back();
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboard');
        }
        else {
            return redirect('/')
                ->with('errors','El Usuario o la Contraseña son Incorrectos.');
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'name.required'      => 'El campo nombre es obligatorio',
            'name.string'        => 'El campo nombre solo acepta cadena de textos',
            'name.max'           => 'El campo nombre tiene que tener una longitud maxima de 255 caracteres',
            'email.required'     => 'El campo email es obligatorio',
            'email.string'       => 'El campo email solo acepta cadena de textos',
            'email.max'          => 'El campo email tiene que tener una longitud maxima de 255 caracteres',
            'email.unique'       => 'El email ya se encuentra registrado',
            'password.required'  => 'El campo contraseña es obligatorio',
            'password.string'    => 'El campo contraseña solo acepta cadena de textos',
            'password.min'       => 'La contraseña debe contener 6 caracteres como minimo',
            'password.confirmed' => 'La contraseñas no coinciden',

            
        ]);
    }


    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role'],
        ]);
    }



    public function register(Request $request)
    {

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));


        notify()->success('Usuario Creado Correctamente');
        return redirect()->back();
    }

    
    protected function guard()
    {
        return Auth::guard();
    }

    public function getUsers(){
        $users = User::all();
        return $this->usertJson($users);
    }
    public function usertJson($users){
        $arrayUsers = array();

        foreach ($users as $user) {
            $userJson = 
            [
                'DT_RowId' => $user->id,
                'id' => $user->id,
                'name' => $user->name,
                'email'  => $user->email, 
                'rol'  => $user->role->name,            
            ];
            array_push($arrayUsers, $userJson);
        }
        
        
        return datatables($arrayUsers)->toJson();
    }
}
