<?php

namespace App\Service;

use Exception;

use App\Models\followers;
use App\DataTransferObjects\FollowerDTO;

class SeguidorService
{
    public function crearSeguidor(FollowerDTO $followerDTO): void
    {
        $seguidor = new Followers();
        $seguidor->estado = $followerDTO->getStatus();
        $seguidor->idseguidor = $followerDTO->getIdFollower();
        $seguidor->idusuario_seguido = $followerDTO->getIdFollowedUser();

        $seguidor->save();
    }

    public function editarSeguidor(FollowerDTO $followerDTO): void
    {
        $seguidor = Followers::find($followerDTO->getId());
        if (!$seguidor) {
            throw new \Exception("Seguidor no encontrado");
        }
        $seguidor->estado = $followerDTO->getStatus();
        $seguidor->idseguidor = $followerDTO->getIdFollower();
        $seguidor->idusuario_seguido = $followerDTO->getIdFollowedUser();

        $seguidor->save();
    }

    public function eliminarSeguidor(int $Id)
    {
        $seguidor = Followers::find($Id);
        if (!$seguidor) {
            throw new Exception("No se encontro el seguidor a eliminar");
        }
        $seguidor->delete();
    }
}
