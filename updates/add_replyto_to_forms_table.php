<?php namespace Xitara\Forms\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class AddReplytoToFormsTable extends Migration
{
    public function up()
    {
        Schema::table('xitara_forms_forms', function ($table) {
            $table->boolean('notif_replyto')->nullable()->default(null);
            $table->integer('notif_replyto_name_field_id')->unsigned()->nullable()->default(null);
            $table->integer('notif_replyto_email_field_id')->unsigned()->nullable()->default(null);
        });
    }

    public function down()
    {
        Schema::table('xitara_forms_forms', function ($table) {
            $table->dropColumn([
                'notif_replyto',
                'notif_replyto_name_field_id',
                'notif_replyto_email_field_id',
            ]);
        });
    }
}
