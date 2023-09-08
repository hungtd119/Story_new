<?php

namespace App\Repositories\Story;

use App\Http\Requests\StoreStoryRequest;

interface StoryInterface
{
    public function getStoriesCard($limit, $offSet, $keyword);
}
