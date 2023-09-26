<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Icon extends Model
{
    public $_NAME = 'Icon';
    public $_ID = 'id';
    public $_PATH = 'path';
    public $_TITLE = 'title';
    public $_TEXT_ID = 'text_id';

    use HasFactory;
    public $table = "icons";
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id', 'path', 'title', 'text_id'];
    public function text(): BelongsTo
    {
        return $this->belongsTo(Text::class, 'text_id');
    }
}
