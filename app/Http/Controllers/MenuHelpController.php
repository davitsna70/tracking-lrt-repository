<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;use App\LogActivity;

class MenuHelpController extends Controller
{
    public function howToUse(){
        return view('user/help/how_to_use');
    }

    public function information(){
        return view('user/help/information');
    }

    public function about(){
        return view('user/help/about');
    }

    public function contact(){
//        Excel::create('clients', function($excel) {
//            $excel->sheet('First Sheet', function($sheet) {
//                $sheet->loadView('test');
//                $sheet->getStyle('A1')->applyFromArray(array(
//                    'fill' => array(
//                        'type'  => \PHPExcel_Style_Fill::FILL_SOLID,
//                        'color' => array('rgb' => 'FF0000')
//                    )
//                ));
//            });
//            $excel->sheet('Second Sheet', function($sheet) {
//                $sheet->loadView('test');
//            });
//        })->export('xlsx');
        return view('user/help/contact');
    }
}
