<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    //Não deleta o arquivo do banco, adiciona uma data e o registro não fica mais visivel
    use SoftDeletes;
    
    protected $table = 'fornecedores';
    protected $fillable = ['nome','site','uf','email'];

    //Relacionamento hasMany('tem muitos')
    public function produtos() {
        return $this->hasMany('App\Item', 'fornecedor_id', 'id');
        //ou caso os nomes sejam padrão pelo laravel
        //return $this->hasMany('App\Item');

    }
}
