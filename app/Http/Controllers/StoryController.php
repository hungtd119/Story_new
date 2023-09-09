<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoryRequest;
use App\Http\Resources\DataCollection;
use App\Models\Story;
use App\Repositories\Helper\HelperInterface;
use App\Repositories\Story\StoryInterface;
use App\Repositories\Story\StoryRepository;
use App\Exceptions\ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StoryController extends Controller
{
    public $storyRepository;
    public $storyBaseService;
    public $helperRepository;
    public $story;

    public function __construct(StoryInterface $storyRepository, StoryRepository $storyBaseService, HelperInterface $helperRepository)
    {
        $this->storyRepository = $storyRepository;
        $this->storyBaseService = $storyBaseService;
        $this->helperRepository = $helperRepository;
        $this->story = new Story();
    }

    public function index(Request $request)
    {
        $limit = $request->query("limit") ? $request->query("limit") : 5;
        $page = $request->query("page") ? $request->query("page") : 1;
        $keyword = $request->query("keyword") ? $request->query("keyword") : "";

        $offSet = ($page - 1) * $limit;
        try {
            $stories = $this->storyBaseService->getAll($limit, $offSet, $keyword);
            return $this->responseJson("get all stories", $stories);
        } catch (ErrorException $e) {
            Log::error('get all stories failed');
            throw $e;
        }
    }

    public function findById($id)
    {
        // validate
        if (!$id)
            throw ErrorException::notFound("Id story not found.");
        try {
            $story = $this->storyBaseService->findById($id);
            return $this->responseJson('get story by id', $story);
        } catch (ErrorException $e) {
            Log::error('Get story by id failed', $id);
            throw $e;
        }
    }

    public function delete($id)
    {
        if (!$id) throw ErrorException::notFound("Id story not found.");
        try {
            $this->storyBaseService->delete($id);
            return $this->responseJson("Deleted story with id " . $id, true);
        } catch (ErrorException $e) {
            Log::error("Delete story failed with id " . $id);
            throw $e;
        }
    }

    public function create(Request $request)
    {
        // Validate Input
        $request->validate([
            $this->story->_TITLE => 'required|string',
            $this->story->_AUTHOR => 'required|string',
            $this->story->_ILLUSTRATOR => 'required|string',
            $this->story->_LEVEL => 'required',
            $this->story->_COIN => 'required',
        ]);
        try {
            // Get data inputs
            $dataInputs = $this->storyBaseService->getDataInput($request);
            // Execute logic
            $story = $this->storyBaseService->store($dataInputs);
            return $this->responseJson('store story success', $story);
        } catch (ErrorException $e) {
            Log::error('Story store failed.', [
                'dataInput' => $dataInputs,
            ]);
            throw ErrorException::badRequest($e);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            $this->story->_TITLE => 'required|string',
            $this->story->_AUTHOR => 'required|string',
            $this->story->_ILLUSTRATOR => 'required|string',
            $this->story->_LEVEL => 'required',
            $this->story->_COIN => 'required',
        ]);
        try {
            // get data inputs
            $id = $request->query("id");
            $dataInputs = $this->storyBaseService->getDataInput($request);
            $story = $this->storyBaseService->store($dataInputs, $id);
            return $this->responseJson("Updated story success", $story);
        } catch (ErrorException $e) {
            Log::error("Update Story failed id" . $id);
            throw $e;
        }
    }

    public function getStoriesCard(Request $request)
    {
        $limit = $request->query("limit") ? $request->query("limit") : 5;
        $page = $request->query("page") ? $request->query("page") : 1;
        $keyword = $request->query("keyword") ? $request->query("keyword") : "";

        $offSet = ($page - 1) * $limit;

        try {
            $stories = $this->storyRepository->getStoriesCard($limit, $offSet, $keyword);
            return $this->responseJson("get all stories card", $stories);
        } catch (ErrorException $e) {
            Log::error('get all stories card failed');
            throw $e;
        }
    }
    public function getStoryDetailById($id)
    {
        if (!$id) {
            throw ErrorException::notFound("id story not found.");
        }
        try {
            $story = $this->storyRepository->getStoryDetailById($id);
            return $this->responseJson("Get story detail by id", $story);
        } catch (ErrorException $e) {
            Log::error('get detail stories failed');
            throw $e;
        }
    }
}
