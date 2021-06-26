<?php namespace Xitara\Forms\Models;

use Backend;
use Model;
use Request;
use Xitara\Forms\Models\Form;

class Submission extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'xitara_forms_submissions';

    /**
     * @var array JSONable fields
     */
    public $jsonable = [
        'data',
    ];

    /**
     * @var array Whitelist of fields allowing mass assignment
     */
    public $fillable = [
        'url',
        'data',
        'ip',
        'form_id',
    ];

    /**
     * @var array Belongs to relations
     */
    public $belongsTo = [
        'form' => Form::class,
    ];

    public $attachMany = [
        'uploaded_files' => [
            'System\Models\File',
            'delete' => true,
        ],
    ];

    /**
     * Generate the backend URL link for viewing this submission
     */
    public function viewLink()
    {
        return Backend::url('xitara/forms/submission', $this->id);
    }

    /**
     * Return the submissions from this IP in the last 24h for this form
     */
    public function scopeThrottleCheck($query, $formId)
    {
        return $query->where('form_id', $formId) // where form matches
            ->where('ip', Request::ip()) // where IP matches
            ->where('created_at', '>=', \Carbon\Carbon::now()->subDay()); // last 24h
    }

    /**
     * Render any given value of the submission
     *
     * @param string|array $value
     * @return string
     */
    public function renderValue($value): string
    {
        if (is_array($value)) {
            $value = implode("\n", $value);
        }

        return htmlspecialchars($value);
    }

    /**
     * gwt list with attachments
     *
     * @autor   mburghammer
     * @date    2021-04-19T14:32:58+02:00
     * @param   \System\Models\File      $files
     * @return  array
     */
    public function getAttachmentList($files)
    {
        $list = [];
        foreach ($files as $file) {
            $list[$file->title][] = [
                'name' => $file->getLocalPath(),
                'uri' => $file->getPath(),
                'content_type' => $file->content_type,
            ];
        }

        return $list;
    }

    public function getProtectedFile($file)
    {
        header('Content-Type:' . $file['content_type']);
        header('Content-Length: ' . filesize($file['name']));
        readfile($file['name']);
    }
}
