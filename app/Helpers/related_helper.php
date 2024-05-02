<?php

use App\Models\MunicipioModel;
use App\Models\TipoModel;
use App\Models\FormularioModel;
use App\Models\EntidadModel;

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

/**
 * Get entidad data from id
 */
function get_entidad($id)

{
  $entidadModel = new EntidadModel();
  $entidad = $entidadModel->where('id',$id)->first();
  return $entidad;   
}


/**
 * Get formulario data from id
 */
function get_formulario($id)

{
  $formularioModel = new FormularioModel();
  $formulario = $formularioModel->where('id',$id)->first();
  return $formulario;   
}
