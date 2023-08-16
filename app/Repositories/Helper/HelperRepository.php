<?php

namespace App\Repositories\Helper;

class HelperRepository implements HelperInterface
{

    public function generateUniqueCode($model)
    {
        $model = app("App\\Models\\$model");
        // TODO: Implement generateUniqueCode() method.
        do {
            $code = random_int(100000, 999999);
        } while ($model::where("id", "=", $code)->first());

        return $code;
    }
}
