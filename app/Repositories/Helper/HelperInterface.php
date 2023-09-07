<?php

namespace App\Repositories\Helper;

use Illuminate\Http\Request;

interface HelperInterface
{
    public function generateUniqueCode($model);
}
