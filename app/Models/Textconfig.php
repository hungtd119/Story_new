<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Textconfig extends Model
{
    public $_NAME = 'Textconfig';
    public $_ID = 'id';
    public $_PAGE_ID = 'page_id';
    public $_TEXT_ID = 'text_id';
    use HasFactory;
    public $table = 'text_config';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id', 'page_id', 'text_id'];
}
