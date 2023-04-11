<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            # Create a Primary, Auto-Incrementing column named `id`
            $table->id();

            # This generates two columns: `created_at` and `updated_at`
            # Laravel will manage these columns automatically
            $table->timestamps();

            $table->string('slug');
            $table->string('title');
            $table->string('author');
            $table->smallInteger('published_year');
            $table->string('cover_url')->nullable(); # Example of a column modifier to specify this field can be left empty (null)
            $table->string('info_url');
            $table->string('purchase_url');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
