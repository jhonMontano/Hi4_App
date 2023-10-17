<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuarios;
use App\service\UsuarioService;
use App\DataTransferObjects\UserDTO;
use Illuminate\Validation\ValidationException;

class UsuariosController extends Controller
{

    private UsuarioService $usuarioService;


    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function listar()
    {
        $Usuarios = usuarios::all();
        return $Usuarios;
    }


    public function crear(Request $request)
    {

        try {
            $request->validate([
                'nombre' => 'required|string|max:50',
                'apellido' => 'required|string|max:50',
                'fechanac' => 'required|date',
                'genero' => 'required|string|max:10',
                'correo' => 'required|email|unique:usuarios,correo',
                'username' => 'required|string|max:25|unique:usuarios,username',
                'password' => 'required|string|max:20',
            ]);

            $usuario = new UserDTO();
            $usuario->setName($request->input('nombre'));
            $usuario->setLastName($request->input('apellido'));
            $usuario->setBornDate($request->input('fechanac'));
            $usuario->setGender($request->input('genero'));
            $usuario->setEmail($request->input('correo'));
            $usuario->setUsername($request->input('username'));
            $usuario->setPassword(bcrypt($request->input('password')));
            $usuario->SetRegisterDate(now());

            $this->usuarioService->crear($usuario);

            return response()->json(['message' => 'Usuario creado con éxito'], 201);
        } catch (ValidationException $th) {
            return response()->json(['erros' => $th->errors()], 500);
        }
    }
}
