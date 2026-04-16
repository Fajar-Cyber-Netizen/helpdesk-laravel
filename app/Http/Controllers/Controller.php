<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
}

return redirect('/tickets')->with('success', 'Ticket berhasil dibuat!');