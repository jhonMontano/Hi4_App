<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Service\ComentarioService;
use App\DataTransferObjects\ComentarioDTO;
use Illuminate\Validation\ValidationException;
use App\Traits\ResponseStructureTrait;
use App\Messages\Messages;
use App\DataTransferObjects\Response as ResponseDTO;
use Illuminate\Http\JsonResponse;
use App\Models\Usuarios;
use App\Models\Publicacion;

class ComentarioController extends Controller
{
    use ResponseStructureTrait;

    private ComentarioService $comentarioService;

    public function __construct(ComentarioService $comentarioService)
    {
        $this->comentarioService = $comentarioService;
    }

    public function listarComentario()
    {
        $comentario = Comentario::all();
        return response()->json($comentario);
    }

    public function crearComentario(Request $request)
    {
        try {
            $request->validate([
                'contenido_comentario' => 'required|string',
                'fecha_comentario' => 'required|date',
                'id_comentario_respuesta' => 'required|int',
                'idusuario' => 'required|int',
                'idpublicacion' => 'required|int',
            ]);

            $idCommentReply = $request->input('id_comentario_respuesta');
            $userId = $request->input('idusuario');
            $publicationId = $request->input('idpublicacion');

            $comentarioExistente = Comentario::find($idCommentReply);
            $usuarioExistente = Usuarios::find($userId);
            $publicacionExistente = Publicacion::find($publicationId);

            if (!$comentarioExistente) {
                return $this->errorResponse('El comentario no existe', JsonResponse::HTTP_NOT_FOUND);
            }

            if (!$usuarioExistente) {
                return $this->errorResponse('El usuario no existe', JsonResponse::HTTP_NOT_FOUND);
            }

            if (!$publicacionExistente) {
                return $this->errorResponse('La publicación no existe', JsonResponse::HTTP_NOT_FOUND);
            }

            $comentario = new ComentarioDTO;
            $comentario->setContent($request->input('contenido_comentario'));
            $comentario->setCreationDate(now());
            $comentario->setIdCommentReply($request->input('id_comentario_respuesta'));
            $comentario->setIdUser($request->input('idusuario'));
            $comentario->setIdPost($request->input('idpublicacion'));

            $this->comentarioService->crearComentario($comentario);

            $response = new ResponseDTO();
            $response->message = Messages::COMMENT_CREATED;
            $response->body = [];
            return $this->successResponse($response, JsonResponse::HTTP_OK);
        } catch (ValidationException $ve) {
            return $this->errorResponse($ve->errors(), JsonResponse::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function editarComentario(Request $request, $id)
    {
        try {
            $request->validate([
                'contenido_comentario' => 'required|string',
                'fecha_comentario' => 'required|date',
                'id_comentario_respuesta' => 'required|int',
                'idusuario' => 'required|int',
                'idpublicacion' => 'required|int',
            ]);

            $idCommentReply = $request->input('id_comentario_respuesta');
            $userId = $request->input('idusuario');
            $publicationId = $request->input('idpublicacion');

            $comentarioExistente = Comentario::find($idCommentReply);
            $usuarioExistente = Usuarios::find($userId);
            $publicacionExistente = Publicacion::find($publicationId);

            if (!$comentarioExistente) {
                return $this->errorResponse('El comentario no existe', JsonResponse::HTTP_NOT_FOUND);
            }

            if (!$usuarioExistente) {
                return $this->errorResponse('El usuario no existe', JsonResponse::HTTP_NOT_FOUND);
            }

            if (!$publicacionExistente) {
                return $this->errorResponse('La publicación no existe', JsonResponse::HTTP_NOT_FOUND);
            }

            $comentarioExistente = Comentario::find($id);
            if (!$comentarioExistente) {
                throw new Exception("El comentario no existe");
            }
            $comentario = new ComentarioDTO;
            $comentario->setId($id);
            $comentario->setContent($request->input('contenido_comentario'));
            $comentario->setCreationDate(now());
            $comentario->setIdCommentReply($request->input('id_comentario_respuesta'));
            $comentario->setIdUser($request->input('idusuario'));
            $comentario->setIdPost($request->input('idpublicacion'));

            $this->comentarioService->editarComentario($comentario, $id);

            $response = new ResponseDTO();
            $response->message = Messages::COMMENT_UPDATE;
            $response->body = [];
            return $this->successResponse($response, JsonResponse::HTTP_OK);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse("Comentario no encontrado", JsonResponse::HTTP_NOT_FOUND);
        } catch (ValidationException $ve) {
            return $this->errorResponse($ve->errors(), JsonResponse::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function eliminarComentario($id)
    {
        try {
            $id = intval($id);

            $this->comentarioService->eliminarComentario($id);

            $response = new ResponseDTO();
            $response->message = Messages::COMMENT_DELETE;
            return $this->successResponse($response, JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}