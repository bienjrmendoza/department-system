<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'department_id',
        'name', 
        'email',
        'phone',
        'address',
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
