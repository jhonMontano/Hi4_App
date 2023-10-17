<?php

namespace App\Service;

use App\Models\Usuarios;
use App\DataTransferObjects\UserDTO;


class UsuarioService
{
    public function crear(UserDTO $user):void
    {

        $result = Usuarios::where('correo',$user->getEmail())
        ->where('username',$user->getUsername())
        ->get()->all();

        if($result){
        throw new \Exception("El usuario ya existe");
        }else{
            $usuario = new Usuarios;
            $usuario->nombre = $user->getName();
            $usuario->apellido = $user->getLastName();
            $usuario->fechanac = $user->getBornDate();
            $usuario->genero = $user->getGender();
            $usuario->correo = $user->getEmail();
            $usuario->username = $user->getUsername();
            $usuario->password = $user->getPassword();
            $usuario->fecha_registro = $user->getRegisterDate();
    
            $usuario->save();
        }
        

    }

    public function obtenerUsuarioPorId($id)
    {
    
    }

    public function actualizarUsuario($id, array $datos)
    {
    
    }

    public function eliminarUsuario($id)
    {
    
    }
}