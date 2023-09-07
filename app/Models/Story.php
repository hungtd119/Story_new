<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Story extends Model
{
    public $_NAME = 'Story';
    public $_ID = 'id';
    public $_TITLE = 'title';
    public $_IMAGE_ID = 'image_id';
    public $_AUTHOR = 'author';
    public $_ILLUSTRATOR = 'illustrator';
    public $_LEVEL = 'level';
    public $_COIN = 'coin';

    use HasFactory;
    public $table = 'stories';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id', 'title', 'image_id', 'author', 'illustrator', 'level', 'coin'];
    protected $hidden = ['image_id'];
    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_id');
    }
}
