<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings;
use DB;

class SettingControlle extends Controller
{
    //
    public function update_theme($value) {

        if($value==2 || $value ==1) {
            $data = DB::table('settings')
                    ->where('id', 1)
                    ->update(['theme_style' => $value]);
            return $value;
        } else {
            return redirect()->back();
        }
    }
}
