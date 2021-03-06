<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');
            $table->string('title');
            $table->text('description');
			$table->string('term');
            $table->string('hours');
			$table->integer('salary');
			$table->string('rate');
            $table->string('startdate');
            $table->string('state');
            $table->string('city');

            /* Skills */
            $table->boolean('java');
            $table->boolean('python');
            $table->boolean('c');
            $table->boolean('csharp');
            $table->boolean('cplus');
            $table->boolean('php');
            $table->boolean('html');
            $table->boolean('css');
            $table->boolean('javascript');
            $table->boolean('sql');
            $table->boolean('unix');
            $table->boolean('winserver');
            $table->boolean('windesktop');
            $table->boolean('linuxdesktop');
            $table->boolean('macosdesktop');
            $table->boolean('perl');
            $table->boolean('bash');
            $table->boolean('batch');
            $table->boolean('cisco');
            $table->boolean('office');
            $table->boolean('r');
            $table->boolean('go');
            $table->boolean('ruby');
            $table->boolean('asp');
            $table->boolean('scala');
            $table->boolean('cow');
            $table->boolean('actionscript');
            $table->boolean('assembly');
            $table->boolean('autohotkey');
            $table->boolean('coffeescript');
            $table->boolean('d');
            $table->boolean('fsharp');
            $table->boolean('haskell');
            $table->boolean('matlab');
            $table->boolean('objectivec');
            $table->boolean('objectivecplus');
            $table->boolean('pascal');
            $table->boolean('powershell');
            $table->boolean('rust');
            $table->boolean('swift');
            $table->boolean('typescript');
            $table->boolean('vue');
            $table->boolean('webassembly');
            $table->boolean('apache');
            $table->boolean('aws');
            $table->boolean('docker');
            $table->boolean('nginx');
            $table->boolean('saas');
            $table->boolean('ipv4');
            $table->boolean('ipv6');
            $table->boolean('dns');

            $table->integer('mineducation');
            $table->integer('minexperience');

            $table->string('rankone');
            $table->string('ranktwo');
            $table->string('rankthree');

            $table->uuid('employerid');
            $table->foreign('employerid')->references('id')->on('employers')->onDelete('cascade');

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
        Schema::dropIfExists('jobs');
    }
}
