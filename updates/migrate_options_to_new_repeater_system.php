<?php namespace Xitara\Forms\Updates;

use Winter\Storm\Database\Updates\Migration;
use Xitara\Forms\Models\Form;

class MigrateOptionsToNewRepeaterSystem extends Migration
{
    public function up()
    {
        foreach (Form::all() as $form) {
            foreach ($form->fields as $field) {
                if (is_string($field->options)) {
                    $newOptions = [];
                    foreach (explode(',', $field->options) as $part) {
                        $newOptions[$part] = $part;
                    }
                    $field->options = $newOptions;
                    $field->save();
                }
            }
        }
    }

    public function down()
    {
    }
}
