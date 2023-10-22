<?php

namespace App\Service;

use App\Models\MeGusta;
use App\DataTransferObjects\LikeDTO;
use Exception;

class MeGustaService
{
    public function crearMeGusta(LikeDTO $likeDTO):void
    {
        $meGusta = new MeGusta();
        $meGusta->idusuario = $likeDTO->getUserId();
        $meGusta->idpublicacion = $likeDTO->getPublicationId();

        $meGusta->save();
    }

    public function eliminarMeGusta(int $Id)
    {
        $meGusta = MeGusta::find($Id);
        if (!$meGusta) {
            throw new Exception("No se encontro el me gusta a eliminar");
        }
        $meGusta->delete();
    }
}