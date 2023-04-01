<?php

use Illuminate\Database\Seeder;
use App\Fornecedor;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //instanciaondo o objeto método 1
        $fornecedor = new Fornecedor();
        $fornecedor->nome = 'Fornecedor 100';
        $fornecedor->site = 'fornecedor100.com.br';
        $fornecedor->uf = 'CE';
        $fornecedor->email = 'contato@fornecedor100.com.br';
        $fornecedor->save();

        //o método create (atenção para o atributo fillable da classe) método 2
        Fornecedor::created([
            'nome' => 'Fornecedor 200',
            'site' => 'fonecedor200.com.br',
            'uf' => 'RS',
            'email' => 'contato@fornecedor200.com.br'
        ]);

        //insert - método 3
        DB::table('fornecedores')->insert([
            'nome' => 'Fornecedor 300',
            'site' => 'fonecedor300.com.br',
            'uf' => 'MG',
            'email' => 'contato@fornecedor300.com.br'
        ]);
    }
}
