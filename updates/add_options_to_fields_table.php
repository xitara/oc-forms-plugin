<?php namespace Xitara\Forms\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

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
