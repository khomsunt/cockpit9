<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeBooks;//นำเอาโมเดล TypeBooks เข้ามาใช้งาน

class TypeBooksController extends Controller
{
    public function index() {
        $typebooks = TypeBooks::all(); //แสดงข้อมูลทัง􀀪 หมด
        //$typebooks = TypeBooks::orderBy('id','desc')->get(); //แสดงข้อมูลทัง􀀪 หมดเรียงจากมากไปน้อยโดยใช้ id
$count = TypeBooks::count(); //นับจำนวนแถวทัง􀀪 หมด
return view('typebooks.index', [
'typebooks' => $typebooks,
'count' => $count
]); // ส่งไปที􀀮 views โฟลเดอร์ typebooks ไฟล์ index.blade.php
}
public function destroy($id) {
//TypeBooks::find($id)->delete();
TypeBooks::destroy($id);
return back();
}
}
