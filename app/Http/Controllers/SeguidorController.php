<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Followers;
use App\Service\SeguidorService;
use App\DataTransferObjects\FollowerDTO;
use Illuminate\Validation\ValidationException;
use App\Traits\ResponseStructureTrait;
use App\Messages\Messages;
use App\DataTransferObjects\Response as ResponseDTO;
use Illuminate\Http\JsonResponse;

class SeguidorController extends Controller
{
    use ResponseStructureTrait;

    private SeguidorService $seguidorService;

    public function __construct(SeguidorService $seguidorService)
    {
        $this->seguidorService = $seguidorService;
    }

    public function listarSeguidor()
    {
        $seguidor = Followers::all();
        return response()->json($seguidor);
    }

    public function crearSeguidor(Request $request)
    {
        try {
            $request->validate([
                'estado' => 'required|string|max:255',
                'idseguidor' => 'required|int',
                'idusuario_seguido' => 'required|int',
            ]);

            $followerDTO = new FollowerDTO;
            $followerDTO->setStatus($request->input('estado'));
            $followerDTO->setIdFollower($request->input('idseguidor'));
            $followerDTO->setIdFollowedUser($request->input('idusuario_seguido'));

            $this->seguidorService->crearSeguidor($followerDTO);

            $response = new ResponseDTO();
            $response->message = Messages::FOLLOWER_CREATED;
            $response->body = [];
            return $this->successResponse($response, JsonResponse::HTTP_OK);
        } catch (ValidationException $ve) {
            return $this->errorResponse($ve->errors(), JsonResponse::HTTP_BAD_REQUEST);
        } catch (Exception $e) {

            return $this->errorResponse($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function editarSeguidor(Request $request, $id)
    {
        try {
            $request->validate([
                'estado' => 'required|string|max:255',
                'idseguidor' => 'required|int',
                'idusuario_seguido' => 'required|int',
            ]);

            $seguidorExistente = Followers::find($id);
            if (!$seguidorExistente) {
                throw new Exception("El seguidor no existe");
            }
            $seguidor = new FollowerDTO;
            $seguidor->setId($id);
            $seguidor->setStatus($request->input('estado'));
            $seguidor->setIdFollower($request->input('idseguidor'));
            $seguidor->setIdFollowedUser($request->input('idusuario_seguido'));

            $this->seguidorService->editarSeguidor($seguidor, $id);

            $response = new ResponseDTO();
            $response->message = Messages::SESION_UPDATE;
            $response->body = [];
            return $this->successResponse($response, JsonResponse::HTTP_OK);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse("Seguidor no encontrado", JsonResponse::HTTP_NOT_FOUND);
        } catch (ValidationException $ve) {
            return $this->errorResponse($ve->errors(), JsonResponse::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function eliminarSeguidor($id)
    {
        try {
            $id = intval($id);

            $this->seguidorService->eliminarSeguidor($id);

            $response = new ResponseDTO();
            $response->message = Messages::SESION_DELETE;
            return $this->successResponse($response, JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
