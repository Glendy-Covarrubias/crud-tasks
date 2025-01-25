<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    /** @use HasFactory<\Database\Factories\TasksFactory> */
    use HasFactory;
    protected $fillable = ["name", "description", "is_completed"];
}
