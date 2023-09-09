<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Http\Requests\PageStoreRequest;
use App\Http\Resources\DataCollection;
use App\Models\Page;
use App\Repositories\Helper\HelperInterface;
use App\Repositories\Page\PageInterface;
use App\Repositories\Page\PageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public $pageRepository;
    public $pageBaseService;
    public $helperRepository;
    public $page;

    public function __construct(PageInterface $pageRepository, PageRepository $pageBaseService, HelperInterface $helperRepository)
    {
        $this->pageRepository = $pageRepository;
        $this->pageBaseService = $pageBaseService;
        $this->helperRepository = $helperRepository;
        $this->page = new Page();
    }

    public function index(Request $request)
    {
        $limit = $request->query("limit") ? $request->query("limit") : 5;
        $page = $request->query("page") ? $request->query("page") : 1;
        $keyword = $request->query("keyword") ? $request->query("keyword") : "";
        $offSet = ($page - 1) * $limit;
        try {
            $pages = $this->pageBaseService->getAll($limit, $offSet, $keyword);
            return $this->responseJson("get all pages", $pages);
        } catch (ErrorException $e) {
            Log::error('get all page failed');
            throw $e;
        }
    }

    public function findById($id)
    {
        // validate
        if (!$id)
            throw ErrorException::notFound("Id page not found.");
        try {
            $page = $this->pageBaseService->findById($id);
            return $this->responseJson('get page by id', $page);
        } catch (ErrorException $e) {
            Log::error('Get page by id failed', $id);
            throw $e;
        }
    }

    public function delete($id)
    {
        if (!$id) throw ErrorException::notFound("Id page not found.");
        try {
            $this->pageBaseService->delete($id);
            return $this->responseJson("Deleted page with id " . $id, true);
        } catch (ErrorException $e) {
            Log::error("Delete page failed with id " . $id);
            throw $e;
        }
    }

    public function create(Request $request)
    {
        // Validate Input
        $request->validate([
            $this->page->_IMAGE_ID => 'required',
            $this->page->_PAGE_NUMBER => 'required',
            $this->page->_STORY_ID => 'required',
        ]);
        try {
            // Get data inputs
            $dataInputs = $this->pageBaseService->getDataInput($request);
            // Execute logic
            $page = $this->pageBaseService->store($dataInputs);
            return $this->responseJson('store page success', $page);
        } catch (ErrorException $e) {
            Log::error('Page store failed.', [
                'dataInput' => $dataInputs,
            ]);
            throw ErrorException::badRequest($e);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            $this->page->_IMAGE_ID => 'required',
            $this->page->_PAGE_NUMBER => 'required',
            $this->page->_STORY_ID => 'required',
        ]);
        try {
            $id = $request->query("id");
            $dataInputs = $this->pageBaseService->getDataInput($request);
            $page = $this->pageBaseService->store($dataInputs, $id);
            return $this->responseJson("Updated page success", $page);
        } catch (ErrorException $e) {
            Log::error("Update Page failed id" . $id);
            throw $e;
        }
    }
    public function findByStory($id, Request $request)
    {
        $limit = $request->query("limit") ? $request->query("limit") : 5;
        $page = $request->query("page") ? $request->query("page") : 1;
        $keyword = $request->query("keyword") ? $request->query("keyword") : "";

        $offSet = ($page - 1) * $limit;
        if (!$id) throw ErrorException::notFound("Id story not found");
        $pages = $this->pageRepository->getPageByStory($id, $limit, $offSet, $keyword);
        return $this->responseJson('find pages by story', $pages);
    }
    public function getByStoryId(Request $request)
    {
        $storyId = $request->query("storyId");
        $pageId = $request->query("pageId");

        if (!$storyId || !$pageId) {
            throw ErrorException::notFound("Not found story id or page id");
        }
        $page = $this->pageRepository->getPageByStoryId($storyId, $pageId);
        return $this->responseJson("get page by page id and story id", $page);
    }
}
