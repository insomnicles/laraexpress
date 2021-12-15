<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->morphs('reactable');             // 1: reactable_type: App\Models\Image (nullable); 2: reactable_id: 2(nullable)
            $table->float('reaction');                      // reactions are either integers (discrete types) or floats (non-discrete types)
            $table->ipAddress('created_from');
            $table->ipAddress('updated_from')->nullable();
            $table->ipAddress('deleted_from')->nullable();
            $table->softDeletes();
            $table->timestamps();
           // $table->unique([ 'user_id', 'reactable', 'reactable_id' ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reactions');
    }
}
