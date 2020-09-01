<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CadastroUser extends Model
{
    //
    protected $table = 'e_usuario';
    protected $primarykey = 'id_e_usuario';

    const CREATED_AT = 'data_de_criacao';
    const UPDATED_AT = 'data_atualizacao';

    protected $guarded = [];
}
