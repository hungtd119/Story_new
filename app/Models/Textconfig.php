<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Textconfig extends Model
{
    use HasFactory;
    protected $table = 'text_config';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id','page_id','text_id'];
}
