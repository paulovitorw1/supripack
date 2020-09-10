<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    //tabela
    protected $table = 'e_carousel';
    //chave primaria
    protected $primaryKey = 'id_e_carousel';

    const CREATED_AT = 'data_de_criacao';
    const UPDATED_AT = 'data_atualizacao';
    
    protected $guarded = [];
}
