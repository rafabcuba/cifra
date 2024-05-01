<?php

use App\Models\MunicipioModel;
use App\Models\TipoModel;

/**
 * Get municipio data from id
 */
function get_municipio($id)

{
  $municipioModel = new municipioModel();
  $municipio = $municipioModel->where('id',$id)->first();
  return $municipio;   
}

/**
 * Get tipo data from id
 */
function get_tipo($id)

{
  $tipoModel = new TipoModel();
  $tipo = $tipoModel->where('id',$id)->first();
  return $tipo;   
}
