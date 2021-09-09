{!! '<' !!}?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create{{ $model['PLURAL_STUDLY'] }}Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('{{ $model['PLURAL_SNAKE'] }}', function (Blueprint $table) {
            $table->id();
@foreach($fields as $field => $item)
            $table->{{ $item['type'] }}('{{ $field }}');
@endforeach
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('{{ $model['PLURAL_SNAKE'] }}');
    }
}