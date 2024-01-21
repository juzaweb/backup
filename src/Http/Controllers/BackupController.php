<?php

namespace Juzaweb\Backup\Http\Controllers;

use Juzaweb\CMS\Http\Controllers\BackendController;

class BackupController extends BackendController
{
    public function index()
    {
        //

        return view(
            'backup::index',
            [
                'title' => 'Title Page',
            ]
        );
    }
}
