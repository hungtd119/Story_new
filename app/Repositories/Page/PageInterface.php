<?php

namespace App\Repositories\Page;

use App\Http\Requests\PageStoreRequest;

interface PageInterface
{
    public function getAllPage ();
    public function getPageById($id);
    public function deletePage ($id);
    public function createPage($imageId,$pageNumber,$storyId);
    public function updatePage($id,$imageId,$pageNumber,$storyId);
}
