<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'test_location',
        'test_date',
        'grade',
        'manager_id',
        'criterion'
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
