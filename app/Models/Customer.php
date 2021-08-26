<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['dob', 'gender', 'height', 'programeId', 'userId'];

    public function user(){
        return $this->belongsTo(User::class, 'userId');
    }

    public function programe(){
        return $this->belongsTo(Programe::class, 'programeId');
    }
}