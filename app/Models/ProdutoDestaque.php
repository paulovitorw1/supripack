<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoDestaque extends Model
{
    //
    protected $table = 'e_produto_destaque';
    protected $primaryKey = 'id_e_produtoDest';

    const CREATED_AT = 'data_de_criacao';
    const UPDATED_AT = 'data_atualizacao';

    protected $guarded = [];
}
