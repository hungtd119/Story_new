<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id','path','filename','wordSync'];
    public function page () :HasOne{
        return $this->hasOne(Page::class);
    }
    public function interaction () :HasOne{
        return $this->hasOne(Interaction::class);
    }
    public function stories () :HasOne{
        return $this->hasOne(Story::class);
    }

}
