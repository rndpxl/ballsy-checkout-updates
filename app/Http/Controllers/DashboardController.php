<?php

namespace App\Http\Controllers;

use App\DirectScale;
use App\Jobs\UpdateProductInventory;
use App\Models\Customer;
use Illuminate\Http\Request;
use Artisan;


class DashboardController extends Controller
{
    public function grid()
	{
		return view('grid');
	}

}
