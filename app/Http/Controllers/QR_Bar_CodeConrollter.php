<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QR_Bar_CodeConrollter extends Controller
{
    public function barIndex(){
        return view('admin.barcode.index');
    }
    public function qrIndex(){
        return view('admin.qrcode.index');
    }
}
