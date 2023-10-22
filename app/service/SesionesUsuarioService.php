<?php

namespace App\Service;

use Exception;

use App\Models\SesionesUsuario;
use App\DataTransferObjects\SesionesUsuarioDTO;

class SesionesUsuarioService
{
    public function crearSesionUsuario(SesionesUsuarioDTO $sesionesUsuarioDTO):void
    {
        $sesionesUsuario = new SesionesUsuario();
        $sesionesUsuario->fecha_hora_sesion = $sesionesUsuarioDTO->getDateTimeSession();
        $sesionesUsuario->ultimo_ingreso = $sesionesUsuarioDTO->getLastEntry();
        $sesionesUsuario->idusuario = $sesionesUsuarioDTO->getIdusuario();

        // Opción 1: Si tienes la relación definida en el modelo SesionesUsuario
        //$sesionesUsuario->usuario()->associate($sesionesUsuarioDTO->getIdUsuario());

        $sesionesUsuario->save();
    }

    public function editarSesionUsuario(SesionesUsuarioDTO $sesionesUsuarioDTO): void
    {
        $sesionesUsuario = SesionesUsuario::find($sesionesUsuarioDTO->getId());

        if (!$sesionesUsuario){
            throw new \Exception("Sesión no encontrada");
        }
        $sesionesUsuario->fecha_hora_sesion = $sesionesUsuarioDTO->getDateTimeSession();
        $sesionesUsuario->ultimo_ingreso = $sesionesUsuarioDTO->getLastEntry();
        $sesionesUsuario->idusuario = $sesionesUsuarioDTO->getIdusuario();

        $sesionesUsuario->save();
    }

    public function eliminarSesionUsuario(int $Id)
    {
        $sesionesUsuario = SesionesUsuario::find($Id);

        if(!$sesionesUsuario){
            throw new Exception("Sesion no encontrada");
        }
        $sesionesUsuario->delete();
    }

}