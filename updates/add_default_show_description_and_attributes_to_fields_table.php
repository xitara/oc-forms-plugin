<?php namespace Xitara\Forms\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class AddDefaultShowDescriptionAndAttributesToFieldsTable extends Migration
{
    public function up()
    {
        Schema::table('xitara_forms_fields', function ($table) {
            $table->boolean('show_description')->default(false);
            $table->text('default')->nullable()->default(null);
            $table->text('html_attributes')->nullable()->default(null);
        });
    }

    public function down()
    {
        Schema::table('xitara_forms_fields', function ($table) {
            $table->dropColumn(['show_description', 'default', 'html_attributes']);
        });
    }
}
