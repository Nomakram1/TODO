<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskSchedule extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'recurrence_pattern', 'start_date', 'end_date', 'iterations', 'schedule_type'];

    public function task()
    {
        return $this->hasMany(Task::class);
    }
}
