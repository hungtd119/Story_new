<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Image extends Model
{

    public $_NAME = 'Image';
    public $_ID = 'id';
    public $_PATH = 'path';
    public $_FILENAME = 'filename';

    use HasFactory;
    public $table = 'images';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id', 'path', 'filename'];
    public function page(): HasOne
    {
        return $this->hasOne(Page::class);
    }
    public function interaction(): HasOne
    {
        return $this->hasOne(Interaction::class);
    }
    public function stories(): HasOne
    {
        return $this->hasOne(Story::class);
    }
}
