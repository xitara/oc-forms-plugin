<?php namespace Xitara\Forms\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Xitara\Forms\Models\Submission as Sub;

class Submission extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
    ];

    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Xitara.Forms', 'bradie-forms', 'bradie-forms-submissions');
    }

    public function details($id)
    {
        $sub = Sub::with(['form'])->findOrFail($id);

        return $this->makePartial('details', [
            'submission' => $sub,
        ]);
    }
}
