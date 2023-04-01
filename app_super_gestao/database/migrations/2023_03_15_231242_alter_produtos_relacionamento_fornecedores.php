<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterProdutosRelacionamentoFornecedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Criando a coluna em produtos que vai receber a fk de fornecedores
        Schema::table('produto', function(Blueprint $table) {

            //A instrução seguinte vale apenas para tabelas que já estejam com registros se as tabelas estiverem vazias não e necessário
            //Insere um registro de fornecedor para estabelecer o relacionamento
            $fornecedor_id = DB::table('fornecedores')->insertGetId([
                'nome' => 'Fornecedor Padrão SG',
                'site' => 'fornecedorpadraosg.com.br',
                'uf' => 'MG',
                'email' => 'contato@fornecedorpadraosg.com.br'
            ]);

            $table->unsignedBigInteger('fornecedor_id')->default($fornecedor_id)->after('id');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('produto', function(Blueprint $table){
            $table->dropForeign('produtos_fornecedor_id_foreing');
            $table->dropColumn('fornecedor_id');
        });
        
    }
}
