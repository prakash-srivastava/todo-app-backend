<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'due_date', 'status', 'created_by'];

    public function createdByData()
    {
        return $this->belongsTo(User::class, 'created_by')->select('id', 'name', 'email');
    }
}
