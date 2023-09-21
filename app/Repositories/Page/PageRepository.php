<?php

namespace App\Repositories\Page;

use App\Exceptions\ErrorException;
use App\Models\Page;
use App\Repositories\BaseService;
use App\Repositories\Helper\HelperInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PageRepository extends BaseService implements PageInterface
{
    protected $helperRepository;

    public function __construct(Page $page, HelperInterface $helperRepository)
    {
        parent::__construct($page, $helperRepository);
        $this->helperRepository = $helperRepository;
    }
    public function getPageByStory($storyId, $limit, $offSet, $keyword)
    {
        try {
            $pages = Page::with('image', 'texts.audio', 'interactions.positions', 'interactions.image', 'interactions.text.audio')
                ->limit($limit)
                ->offSet($offSet)
                ->where('story_id', $storyId)
                ->get();
            $count = Page::where('story_id', $storyId)->count();
            Log::info('Get all page by story_id');
            return [
                'pages' => $pages,
                'count' => $count
            ];
        } catch (QueryException $exception) {
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }

    public function getPageByStoryId($storyId, $pageId)
    {
        try {
            $page = Page::query()->with("interactions.positions.text", "image", "texts")->where([
                ['story_id', "=", $storyId]
            ])->find($pageId);
            dd($page);
            $countPage = Page::query()->where("story_id", $storyId)->count();
            return ['page' => $page, "count" => $countPage];
        } catch (QueryException $exception) {
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }
    public function getPagesIdByStoryId($storyId)
    {
        try {
            $pagesId = Page::query()->where("story_id", "=", $storyId)->select("id", 'page_number')->orderBy('page_number', 'asc')->get();
            return $pagesId;
        } catch (QueryException $exception) {
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }
    public function getPageToConfig($id)
    {
        try {
            $page = Page::query()->with("interactions.positions", "image", "interactions.text.audio", 'texts.audio')->find($id);
            return $page;
        } catch (QueryException $exception) {
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }
    public function getPageToPlay($id)
    {
        try {
            $page = Page::query()->with("texts.audio", "interactions.positions", "image", "interactions.text.audio")->find($id);
            return $page;
        } catch (QueryException $exception) {
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }
}
