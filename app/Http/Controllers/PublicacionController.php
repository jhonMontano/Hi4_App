<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\service\PublicacionService;
use App\DataTransferObjects\PublicationDTO;
use Illuminate\Validation\ValidationException;
use App\Traits\ResponseStructureTrait;
use App\Messages\Messages;
use App\DataTransferObjects\Response  as ResponseDTO;
use Illuminate\Http\JsonResponse;

class PublicacionController extends Controller
{
    use ResponseStructureTrait;
    private PublicacionService $publicationService;

    public function __construct(PublicacionService $publicationService)
    {
        $this->publicationService = $publicationService;
    }

    public function listarPublicaciones()
    {
        $Publicacion = publicacion::all();
        return $Publicacion;
    }

    public function crearPublicacion(Request $request)
    {
        try {
            $request->validate([
                'contenido' => 'required|string|max:255',
                'fecha_publicacion' => 'required|date',
                'megustacontador' => 'required|integer',
                'idusuario' => 'required|integer',
            ]);

            $publicacion = new PublicationDTO;
            $publicacion->setContent($request->input('contenido'));
            $publicacion->setDateContent(now());;
            $publicacion->setLikeCounter($request->input('megustacontador'));
            $publicacion->setIdUsuario($request->input('idusuario'));

            $this->publicationService->crearPublicacion($publicacion);

            $response = new ResponseDTO();
            $response->message = Messages::PUBLICATION_CREATED;
            $response->body = [];
            return $this->successResponse($response, JsonResponse::HTTP_OK);
        } catch (ValidationException $ve) {
            return $this->errorResponse($ve->errors(), JsonResponse::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function editarPublicacion(Request $request, $id)
    {
        try {
            $request->validate([
                'contenido' => 'required|string|max:255',
                'fecha_publicacion' => 'required|date',
                'megustacontador' => 'required|integer',
                'idusuario' => 'required|integer',
            ]);

            $publicacionDTO = new PublicationDTO();
            $publicacionDTO->setId($id);
            $publicacionDTO->setContent($request->input('contenido'));
            $publicacionDTO->setDateContent($request->input('fecha_publicacion'));
            $publicacionDTO->setLikeCounter($request->input('megustacontador'));
            $publicacionDTO->setIdUsuario($request->input('idusuario'));

            $this->publicationService->editarPublicacion($publicacionDTO);

            $response = new ResponseDTO();
            $response->message = Messages::PUBLICATION_EDITED;
            $response->body = [];
            return $this->successResponse($response, JsonResponse::HTTP_OK);
        } catch (ValidationException $ve) {
            return $this->errorResponse($ve->errors(), JsonResponse::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function eliminarPublicacion($id)
    {
        try {
            $id = intval($id);

            $this->publicationService->eliminar($id);

            $response = new ResponseDTO();
            $response->message = Messages::PUBLICATION_DELETE;
            return $this->successResponse($response, JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
