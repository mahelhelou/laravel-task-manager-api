<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'priority'];
    protected $hidden   = ['created_at', 'updated_at'];
}
