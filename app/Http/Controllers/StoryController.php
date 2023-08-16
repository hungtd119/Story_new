<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoryRequest;
use App\Http\Resources\DataCollection;
use App\Repositories\Story\StoryInterface;

class StoryController extends Controller
{
    public $storyRepository;

    public function __construct(StoryInterface $storyRepository)
    {
        $this->storyRepository = $storyRepository;
    }

    public function index()
    {
        $stories = $this->storyRepository->getAllStories();
        return \response(new DataCollection($stories), 200);
    }

    public function findById($id)
    {
        $story = $this->storyRepository->getStoryById($id);
        return $this->responseJson('find story by id', $story);
    }

    public function delete($id)
    {

        $deletedStory = $this->storyRepository->deleteStory($id);
        return $this->responseJson('deleted story');

    }

    public function create(StoreStoryRequest $request)
    {
        $createdStory = $this->storyRepository->createStory(
            $request->input('title'),
            $request->input('image_id'),
            $request->input('author'),
            $request->input('illustrator'),
            $request->input('level'),
            $request->input('coin')
        );
        return $this->responseJson('Created a new Story',$createdStory);
    }

    public function update(StoreStoryRequest $request)
    {
        $updatedStory = $this->storyRepository->updateStory(
            $request->query('id'),
            $request->input('title'),
            $request->input('image_id'),
            $request->input('author'),
            $request->input('illustrator'),
            $request->input('level'),
            $request->input('coin')
        );
        return $this->responseJson('updated story',$updatedStory);
    }
}
