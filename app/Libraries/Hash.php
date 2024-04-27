<?php

namespace App\Libraries;

class Hash
{
    //Encripta la contraseña
    public static function encrypt($password)
    {
      return password_hash($password, PASSWORD_BCRYPT);
    }

    // chequea contraseña
    public static function check($userPassword, $dbUserPassword)
    {
      return password_verify($userPassword, $dbUserPassword);
    }
}
