<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Creo la colonna che voglio aggiungere è dichiaro che non è necessario inserirla.
            $table->unsignedBigInteger('category_id')->nullable()->after('slug');

            // Ora dichiariamo dove la foreign key punta (su quale tabella, su quale riga)
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                // Dobbiamo gestire il caso nel quale venisse eliminata una categoria.
                // ->onDelete() -> in questo modo ci verrebbe impedito di eliminarla.
                // ->onDelete('cascade'); -> questo eliminerebbe la categoria e tutti i post correlati.
                ->onDelete('set null'); // -> in questo modo avremo semplicemente un null sulla categoria.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Per eventualmente cancellare la colonna contenente la foreign key, è necessario eliminare anche il collegamento.
            $table->dropForeign('posts_category_id_foreign');
            $table->dropColumn('category_id');
        });
    }
}
