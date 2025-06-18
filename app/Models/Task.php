<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // protected $fillable = ['title', 'description', 'priority'];
    protected $guarded = ['id'];
    protected $hidden  = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_task');
    }
}
