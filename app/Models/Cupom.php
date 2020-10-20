<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    //
    protected $table = 'e_cupom';
    protected $primaryKey = 'e_id_cupom';

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_atualizacao';

    protected $guarded = [];
}
