<?php

namespace App\Service;

use App\Models\Publicacion;
use App\DataTransferObjects\PublicationDTO;

class PublicacionService
{
    public function crearPublicacion(PublicationDTO $publicationDTO):void
    {
        $publicacion = new Publicacion();
        $publicacion->contenido = $publicationDTO->getContent();
        $publicacion->fecha_publicacion = $publicationDTO->getDateContent();
        $publicacion->megustacontador = $publicationDTO->getLikeCounter();
        $publicacion->idusuario = $publicationDTO->getIdUsuario();

        $publicacion->save();
    }

    public function editarPublicacion(PublicationDTO $publicationDTO): void
    {
        $publicacion = Publicacion::find($publicationDTO->getId());

        if (!$publicacion) {
            throw new \Exception("Publicación no encontrada");
        }
        $publicacion->contenido = $publicationDTO->getContent();
        $publicacion->fecha_publicacion = $publicationDTO->getDateContent();      
        $publicacion->megustacontador = $publicationDTO->getLikeCounter();
        $publicacion->idusuario = $publicationDTO->getIdUsuario(); 

        $publicacion->save();
    }
    public function eliminar(int $idPublicacion)
    {
        $publicacion = Publicacion::find($idPublicacion);
    
        if (!$publicacion) {
            throw new \Exception("id no encontrado");
        }
    
        $publicacion->delete();
    }
}