<?php /** @noinspection PhpUndefinedMethodInspection */

//use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up():void
    {
        Schema::create('file_uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('video_name')->unique();

            $table->unsignedInteger('bitrate')->default(0)->nullable(false);
            $table->time('duration')->default(0)->nullable(false);
            $table->unsignedDecimal('file_size')->default(0)->nullable(false);   // megabytes
            $table->string('video_format')->default('mp4')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down():void
    {
        Schema::dropIfExists('file_uploads');
    }
}
