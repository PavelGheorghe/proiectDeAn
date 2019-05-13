<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class CommandsController extends Controller
{
    public function get_index()
    {
        return view('cmd.index');
    }

    public function get_artisan($command, $params = '')
    {
        switch ($command) {
            case 'config:cache':
                Artisan::call('config:cache');
                break;
            case 'db:seed':
                Artisan::call('db:seed', [
                    '--class' => $params,
                ]);
                break;
            default:
                Artisan::call($command);
        }

        return redirect()->back()->with('output', Artisan::output(''));
    }
}
