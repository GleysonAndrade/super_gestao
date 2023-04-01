<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function produtos(){
        //return $this->belongsToMany('App\Produto', 'pedidos_produtos');

        return $this->belongsToMany('App\Item', 'pedido_produtos', 'pedido_id', 'produto_id')->withPivot('id','created_at');
        /**
         * Parametros
         * 1 - Modelo do relacionamento NxN em relação ao modelo que estamos implementando
         * 2 - É a tabela auxiliar que armazena o s registros que armazena os registros de relaicionamento
         * 3 - Representa o nome da FK da tabela mapeada pelo modelo na tabela de relacionamento
         * 4 - Representa o nome da FK da tabela mapeada pelo model ultilizado no relacionamento que estamos implementando
         */
    }
}
