<?php namespace Xitara\Forms\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class AddShowInEmailFieldsToFieldsTable extends Migration
{
    public function up()
    {
        Schema::table('xitara_forms_fields', function ($table) {
            $table->boolean('show_in_email_autoreply')->default(true);
            $table->boolean('show_in_email_notification')->default(true);
        });
    }

    public function down()
    {
        Schema::table('xitara_forms_fields', function ($table) {
            $table->dropColumn(['show_in_email_autoreply', 'show_in_email_notification']);
        });
    }
}
