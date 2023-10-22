<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\SesionesUsuario;
use App\Service\SesionesUsuarioService;
use App\DataTransferObjects\SesionesUsuarioDTO;
use Illuminate\Validation\ValidationException;
use App\Traits\ResponseStructureTrait;
use App\Messages\Messages;
use App\DataTransferObjects\Response as ResponseDTO;
use Illuminate\Http\JsonResponse;

class SesionesUsuarioController extends Controller
{
    use ResponseStructureTrait;

    private SesionesUsuarioService $sesionesUsuarioService;

    public function __construct(SesionesUsuarioService $sesionesUsuarioService)
    {
        $this->sesionesUsuarioService = $sesionesUsuarioService;
    }

    public function listarSesionesUsuario()
    {
        $sesionesUsuarios = SesionesUsuario::all();
        return response()->json($sesionesUsuarios);
    }

    public function crearSesionUsuario(Request $request)
    {
        try {
            $request->validate([
                'fecha_hora_sesion' => 'required|date',
                'ultimo_ingreso' => 'required|date',
                'idusuario' => 'required|integer',
            ]);

            $sesionesUsuarioDTO = new SesionesUsuarioDTO;
            $sesionesUsuarioDTO->setDateTimeSession(now());
            $sesionesUsuarioDTO->setLastEntry(now());
            $sesionesUsuarioDTO->setIdusuario($request->input('idusuario'));

            $this->sesionesUsuarioService->crearSesionUsuario($sesionesUsuarioDTO);

            $response = new ResponseDTO();
            $response->message = Messages::SESION_CREATED;
            $response->body = [];
            return $this->successResponse($response, JsonResponse::HTTP_OK);
        } catch (ValidationException $ve) {
            return $this->errorResponse($ve->errors(), JsonResponse::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
    
            return $this->errorResponse($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function editarSesionUsuario(Request $request, $id)
    {
        try {
            $request->validate([
                'fecha_hora_sesion' => 'required|date',
                'ultimo_ingreso' => 'required|date',
                'idusuario' => 'required|int',
            ]);
    
            $sesionExistente = SesionesUsuario::find($id);
            if (!$sesionExistente) {
                throw new \Exception("Sesión no encontrada");
            }
    
            $sesionesUsuario = new SesionesUsuarioDTO();
            $sesionesUsuario->setId($id);
            $sesionesUsuario->setDateTimeSession(now());
            $sesionesUsuario->setLastEntry(now());
            $sesionesUsuario->setIdusuario($request->input('idusuario'));
    
            $this->sesionesUsuarioService->editarSesionUsuario($sesionesUsuario);
    
            $response = new ResponseDTO();
            $response->message = Messages::SESION_UPDATE;
            $response->body = [];
            return $this->successResponse($response, JsonResponse::HTTP_OK);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse("Sesión no encontrada", JsonResponse::HTTP_NOT_FOUND);
        } catch (ValidationException $ve) {
            return $this->errorResponse($ve->errors(), JsonResponse::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function eliminarSesionUsuario($id)
{
    try {
        $id = intval($id);

        $this->sesionesUsuarioService->eliminarSesionUsuario($id);

        $response = new ResponseDTO();
        $response->message = Messages::SESION_DELETE;
        return $this->successResponse($response, JsonResponse::HTTP_OK);
    } catch (Exception $e) {
        return $this->errorResponse($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }
}
}
