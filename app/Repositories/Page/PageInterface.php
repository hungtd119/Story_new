<?php

namespace App\Repositories\Page;

use App\Http\Requests\PageStoreRequest;

interface PageInterface
{
    public function getPageByStory($storyId);
}
