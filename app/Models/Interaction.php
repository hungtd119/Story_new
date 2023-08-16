<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Interaction extends Model
{
    use HasFactory;
    protected $table = 'interactions';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id','bg','blink','page_id','image_id','text_id'];
    protected $hidden = ['page_id','image_id','text_id'];
    public function pages ():BelongsTo{
        return $this->belongsTo(Page::class,'page_id');
    }
    public function positions ():HasMany{
        return $this -> hasMany(Position::class);
    }
    public function text ():BelongsTo{
        return $this->belongsTo(Text::class,'text_id');
    }
    public function image ():BelongsTo{
        return $this->belongsTo(Image::class,'image_id');
    }
}
