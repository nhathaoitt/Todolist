<?php

namespace App\Models;

use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
        'user_id'
    ];
    const NOT_STARTED = 0;
    const IN_PROGRESS = 1;
    const COMPLETED = 2;
    
    public static function newFactory()
    {
        return TaskFactory::new();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
