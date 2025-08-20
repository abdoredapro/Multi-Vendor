<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\ImportProducts;
use Illuminate\Http\Request;

class ImportProductController extends Controller
{
    public function create() {
        return view('dashboard.Products.import');
    }
    public function store(Request $request) {
        $job = new ImportProducts($request->post('count'));
        $job->onQueue('import')->delay(now()->addSeconds(3));
    }
}
