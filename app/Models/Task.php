<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'task_group_id', 'task_schedule_id','title', 'description', 'due_date', 'completed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function taskGroup()
    {
        return $this->belongsTo(TaskGroup::class,);
    }

    public function taskSchedule()
    {
        return $this->belongsTo(TaskSchedule::class);
    }
}
