<?php

namespace App\Repositories\Page;

use App\Exceptions\ErrorException;
use App\Models\Page;
use App\Repositories\BaseService;
use App\Repositories\Helper\HelperInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class PageRepository extends BaseService implements PageInterface
{
    protected $helperRepository;

    public function __construct(Page $page, HelperInterface $helperRepository)
    {
        parent::__construct($page, $helperRepository);
        $this->helperRepository = $helperRepository;
    }
    public function getPageByStory($storyId)
    {
        try {
            $pages = Page::with('image', 'texts.audio', 'texts.position', 'texts.position', 'interactions.positions', 'interactions.image', 'interactions.text.audio')->where('story_id', $storyId)->get();
            Log::info('Get all page by story_id');
            return $pages;
        } catch (QueryException $exception) {
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }
}
