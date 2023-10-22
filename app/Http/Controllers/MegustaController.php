<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\MeGusta;
use App\Service\MeGustaService;
use App\DataTransferObjects\LikeDTO;
use Illuminate\Validation\ValidationException;
use App\Traits\ResponseStructureTrait;
use App\Messages\Messages;
use App\DataTransferObjects\Response as ResponseDTO;
use Illuminate\Http\JsonResponse;
use App\Models\Usuarios;
use App\Models\Publicacion;

class MegustaController extends Controller
{
    use ResponseStructureTrait;

    private MeGustaService $meGustaService;

    public function __construct(MeGustaService $meGustaService)
    {
        $this->meGustaService = $meGustaService;
    }

    public function listarMeGusta()
    {
        $meGusta = MeGusta::all();
        return response()->json($meGusta);
    }

    public function crearMeGusta(Request $request)
    {
        try {
            $request->validate([
                'idusuario' => 'required|integer',
                'idpublicacion' => 'required|integer',
            ]);

            $userId = $request->input('idusuario');
            $publicationId = $request->input('idpublicacion');

            $usuarioExistente = Usuarios::find($userId);
            $publicacionExistente = Publicacion::find($publicationId);

            if (!$usuarioExistente) {
                return $this->errorResponse('El usuario no existe', JsonResponse::HTTP_NOT_FOUND);
            }

            if (!$publicacionExistente) {
                return $this->errorResponse('La publicación no existe', JsonResponse::HTTP_NOT_FOUND);
            }

            $likeDTO = new LikeDTO;
            $likeDTO->setUserId($userId);
            $likeDTO->setPublicationId($publicationId);

            $this->meGustaService->crearMeGusta($likeDTO);

            $response = new ResponseDTO();
            $response->message = Messages::LIKE_CREATED;
            $response->body = [];
            return $this->successResponse($response, JsonResponse::HTTP_OK);
        } catch (ValidationException $ve) {
            return $this->errorResponse($ve->errors(), JsonResponse::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function eliminarMeGusta($id)
    {
        try {
            $id = intval($id);

            $this->meGustaService->eliminarMeGusta($id);

            $response = new ResponseDTO();
            $response->message = Messages::LIKE_DELETE;
            return $this->successResponse($response, JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
