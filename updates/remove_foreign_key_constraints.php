<?php

namespace Xitara\Forms\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class RemoveForeignKeyConstraints extends Migration
{
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('xitara_forms_forms', function ($table) {
            // Add foreign keys
            $table->dropForeign(['auto_reply_name_field_id']);
            $table->dropForeign(['auto_reply_email_field_id']);
        });

        Schema::table('xitara_forms_fields', function ($table) {
            // Add foreign keys
            $table->dropForeign(['form_id']);
        });

        Schema::table('xitara_forms_submissions', function ($table) {
            // Add foreign keys
            $table->dropForeign(['form_id']);
        });
    }

    public function down()
    {
        Schema::table('xitara_forms_forms', function ($table) {
            // Add foreign keys
            $table->foreign('auto_reply_name_field_id')->references('id')->on('xitara_forms_fields')->onDelete('cascade');
            $table->foreign('auto_reply_email_field_id')->references('id')->on('xitara_forms_fields')->onDelete('cascade');
        });

        Schema::table('xitara_forms_fields', function ($table) {
            // Add foreign keys
            $table->foreign('form_id')->references('id')->on('xitara_forms_forms')->onDelete('cascade');
        });

        Schema::table('xitara_forms_submissions', function ($table) {
            // Add foreign keys
            $table->foreign('form_id')->references('id')->on('xitara_forms_forms')->onDelete('cascade');
        });
    }
}
