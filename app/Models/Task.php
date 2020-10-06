<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'done', 'category_id', 'assigned_to', 'created_by'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function assignee()
    {
        return $this->belongsTo('App\Models\User', 'assigned_to');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }
}
