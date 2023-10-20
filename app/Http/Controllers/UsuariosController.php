<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\usuarios;
use App\service\UsuarioService;
use App\DataTransferObjects\UserDTO;
use Illuminate\Validation\ValidationException;
use App\Traits\ResponseStructureTrait;
use App\Messages\Messages;
use App\DataTransferObjects\Response  as ResponseDTO;
use Illuminate\Http\JsonResponse;



class UsuariosController extends Controller
{
    private $userService;

    use ResponseStructureTrait;
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

            $response = new ResponseDTO();
            $response->message = Messages::USER_CREATED;
            $response->body = [];
            return $this->successResponse($response, JsonResponse::HTTP_OK);
        } catch (ValidationException $ve) {
            return $this->errorResponse($ve->errors(), JsonResponse::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function editar(Request $request, $id)
{
    try {
        $request->validate([
            'id_usuarios' => 'required|string|max:256',
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'fechanac' => 'required|date',
            'genero' => 'required|string|max:10',
            'correo' => 'required|email|unique:usuarios,correo,' . $id . ',id_usuarios',
            'username' => 'required|string|max:25|unique:usuarios,username,' . $id . ',id_usuarios',
            'password' => 'required|string|max:20',
        ]);

        $usuario = new UserDTO();
        $usuario->setId($request->input('id_usuarios'));
        $usuario->setName($request->input('nombre'));
        $usuario->setLastName($request->input('apellido'));
        $usuario->setBornDate($request->input('fechanac'));
        $usuario->setGender($request->input('genero'));
        $usuario->setEmail($request->input('correo'));
        $usuario->setUsername($request->input('username'));
        $usuario->setPassword(bcrypt($request->input('password')));
        $usuario->setRegisterDate(now());

        $this->usuarioService->editar($usuario);

        $response = new ResponseDTO();
        $response->message = Messages::USER_UPDATE;
        $response->body = [];
        return $this->successResponse($response, JsonResponse::HTTP_OK);
    } catch (ValidationException $ve) {
        return $this->errorResponse($ve->errors(), JsonResponse::HTTP_BAD_REQUEST);
    } catch (Exception $e) {
        return $this->errorResponse($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }
}

public function eliminar($id)
{
    try {
        $id = intval($id);

        $this->usuarioService->eliminar($id);

        $response = new ResponseDTO();
        $response->message = Messages::USER_DELETE;
        return $this->successResponse($response, JsonResponse::HTTP_OK);
    } catch (Exception $e) {
        return $this->errorResponse($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }
}

}
