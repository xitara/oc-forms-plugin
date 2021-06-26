<?php namespace Xitara\Forms\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class AddOptionsToFieldsTable extends Migration
{
    public function up()
    {
        Schema::table('xitara_forms_fields', function ($table) {
            $table->text('options')->nullable()->default(null);
        });
    }

    public function down()
    {
        Schema::table('xitara_forms_fields', function ($table) {
            $table->dropColumn('options');
        });
    }
}
