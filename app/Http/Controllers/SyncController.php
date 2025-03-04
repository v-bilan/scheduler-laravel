<?php

namespace App\Http\Controllers;

use App\Services\SyncManager;


class SyncController extends Controller
{

    public function __invoke(SyncManager $syncManager)
    {
        $syncManager->tasks();
        return redirect()->route('home')->with('success', __('Data synchronized successfully.'));
    }

}
