<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $table = 'books'; //กำหนดชื่อตารางในฐานข้อมูล
protected $fillable = ['title','price','typebooks_id'];//กำหนดให้สามารถเพ􀀮ิมข้อมูลได้ในคำสั่งเดียว Mass Assignment
}
