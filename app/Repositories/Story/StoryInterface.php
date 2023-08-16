<?php

namespace App\Repositories\Story;

use App\Http\Requests\StoreStoryRequest;

interface StoryInterface
{
    public function getAllStories();
    public function getStoryById($id);
    public function deleteStory($id);

    public function createStory($title,$imageId,$author,$illustrator,$level,$coin);
    public function updateStory($id,$title,$imageId,$author,$illustrator,$level,$coin);
}
