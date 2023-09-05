<?php

namespace App\Repositories\Page;

use App\Exceptions\ErrorException;
use App\Http\Requests\PageStoreRequest;
use App\Models\Page;
use App\Repositories\Helper\HelperInterface;
use Faker\Core\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class PageRepository implements PageInterface
{
    protected $helperRepository;

    public function __construct(HelperInterface $helperRepository)
    {
        $this->helperRepository = $helperRepository;
    }

    public function getAllPage()
    {
        // TODO: Implement getAllPage() method.
        try {
            $pages = Page::with('image', 'texts.audio', 'texts.position', 'texts.position', 'interactions.positions', 'interactions.image', 'interactions.text.audio')->get();
            Log::info('Get all page');
            return $pages;
        } catch (QueryException $exception) {
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }
    public function getPageByStory($storyId){
        try {
            $pages = Page::with('image', 'texts.audio', 'texts.position', 'texts.position', 'interactions.positions', 'interactions.image', 'interactions.text.audio')->where('story_id', $storyId)->get();
            Log::info('Get all page by story_id');
            return $pages;
        } catch (QueryException $exception) {
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }

    public function deletePage($id)
    {
        // TODO: Implement deletePage() method.
        try {
            $page = Page::find($id);
            if (!$page)
                throw ErrorException::notFound('Page not found with id ' . $id);
            $page->delete();
            Log::info('Deleted a page with id: ' . $id);
            return true;
        } catch (QueryException $exception) {
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }

    public function createPage($imageId, $pageNumber, $storyId)
    {
        // TODO: Implement createPage() method.
        try {
            $page = new Page();
            $page->id = $this->helperRepository->generateUniqueCode('Page');
            $page->image_id = $imageId;
            $page->page_number = $pageNumber;
            $page->story_id = $storyId;
            $page->save();
            Log::info('Created a page', [
                "page" => $page
            ]);
            return $page;

        } catch (QueryException $exception) {
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }

    public function updatePage($id, $imageId, $pageNumber, $storyId)
    {
        // TODO: Implement updatePage() method.
        try {
            $page = Page::find($id);
            if (!$page)
                throw ErrorException::notFound('Page not found with id ' . $id);
            $page->image_id = $imageId;
            $page->page_number = $pageNumber;
            $page->story_id = $storyId;
            $page->save();
            Log::info('Updated page with id: ' . $id);
            return $page;
        } catch (QueryException $exception) {
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }

    public function getPageById($id)
    {
        // TODO: Implement getPageById() method.
        try {
            $story = Page::with('image', 'texts.audio', 'texts.position', 'texts.position', 'interactions.positions', 'interactions.image', 'interactions.text.audio')->find($id);
            if (!$story)
                throw ErrorException::notFound('Page not found with id ' . $id);
            Log::info('Get page by id: ' . $id);
            return $story;
        } catch (QueryException $exception) {
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }
}
