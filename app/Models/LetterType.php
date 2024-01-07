<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Letter;
use App\Models\User;
use App\Models\Result;

class Lettertype extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_code',
        'name_type',
    ];

    public function letter() {
        return $this->hasMany(Letter::class);
    }
}