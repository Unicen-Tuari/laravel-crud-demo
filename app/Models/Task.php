<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'done',
        'category_id',
        'assigned_to',
        'created_by',
        'file_path',
    ];

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

    public function getPublicFilePathAttribute()
    {
        return $this->file_path ? Storage::url($this->file_path) : '';
    }

    public function getFileIsImageAttribute()
    {
        if(!$this->file_path) return '';
        $mimeType = Storage::disk('public')->mimeType($this->file_path);
        return str_contains($mimeType, 'image/');
    }
}
