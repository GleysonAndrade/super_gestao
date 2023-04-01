<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AjusteProdutosFiliais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //criando tabela filiais - relacionamento de muitos para muitos
        Schema::create('filiais', function (Blueprint $table){
            $table->id();
            $table->string('filial', 30);
            $table->timestamps();
        });

        //criando tabela produto_filiais - relacionamento de muitos para muitos
        Schema::create('produto_filiais', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('filial_id');
            $table->unsignedBigInteger('produto_id');
            $table->decimal('preco_venda', 8, 2);
            $table->integer('estoque_minimo');
            $table->integer('estoque_maximo');
            $table->timestamps();

            //foreign key (constraints)
            $table->foreign('filial_id')->references('id')->on('filiais');
            $table->foreign('produto_id')->references('id')->on('produto');
        });

        //removendo colunas da tabela produtos
        Schema::table('produto', function (Blueprint $table){
            $table->dropColumn(['preco_venda', 'estoque_minimo', 'estoque_maximo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //adicionar colunas da tabela produtos
        Schema::table('produto', function (Blueprint $table){
            $table->decimal('preco_venda', 8, 2);
            $table->integer('estoque_minimo');
            $table->integer('estoque_maximo');
        });

        //removendo a tabela produto_filiais
        Schema::dropIfExists('produto_filiais');

        //removendo a tabela filiais
        Schema::dropIfExists('filiais');
    }
}
