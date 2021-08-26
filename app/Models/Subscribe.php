<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use HasFactory;
    protected $fillable = ['serviceId', 'userId', 'isOk'];

    public function user(){
        return $this->belongsTo(User::class, 'userId');
    }

    public function service(){
        return $this->belongsTo(Service::class, 'serviceId');
    }
}
