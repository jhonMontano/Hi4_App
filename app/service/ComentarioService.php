<?php

namespace App\Service;

use Exception;

use App\Models\Comentario;
use App\DataTransferObjects\ComentarioDTO;
use GuzzleHttp\Psr7\Request;

class ComentarioService
{
    public function crearComentario(ComentarioDTO $comentarioDTO):void
    {
        $comentario = new Comentario();
        $comentario->contenido_comentario = $comentarioDTO->getContent();
        $comentario->fecha_comentario = $comentarioDTO->getCreationDate();
        $comentario->id_comentario_respuesta = $comentarioDTO->getIdCommentReply();
        $comentario->idusuario = $comentarioDTO->getIdUser();
        $comentario->idpublicacion = $comentarioDTO->getIdPost();

        $comentario->save();
    }

    public function editarComentario(ComentarioDTO $comentarioDTO): void
    {
        $comentario = Comentario::find($comentarioDTO->getId());
        if (!$comentario) {
            throw new \Exception("Comentario no encontrado");
        }
        $comentario->contenido_comentario = $comentarioDTO->getContent();
        $comentario->fecha_comentario = $comentarioDTO->getCreationDate();
        $comentario->id_comentario_respuesta = $comentarioDTO->getIdCommentReply();
        $comentario->idusuario = $comentarioDTO->getIdUser();
        $comentario->idpublicacion = $comentarioDTO->getIdPost();

        $comentario->save();
    }

    public function eliminarComentario(int $Id)
    {
        $comentario = Comentario::find($Id);
        if (!$comentario) {
            throw new Exception("No se encontro el comentario a eliminar");
        }
        $comentario->delete();
    }
}