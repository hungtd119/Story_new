<?php

namespace App\Repositories\Story;

use App\Exceptions\ErrorException;
use App\Exceptions\StoryNotFoundException;
use App\Http\Requests\StoreStoryRequest;
use App\Http\Resources\DataCollection;
use App\Models\Page;
use App\Models\Story;
use App\Repositories\BaseService;
use App\Repositories\Helper\HelperInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class StoryRepository extends BaseService implements StoryInterface
{
    protected $helperRepository;
    public function __construct(Story $story, HelperInterface $helperRepository)
    {
        parent::__construct($story, $helperRepository);
        $this->helperRepository = $helperRepository;
    }
    public function getStoriesCard($limit, $offSet, $keyword)
    {
        $stories = Story::with('image', 'pages.texts')->where('title', 'like', '%' . $keyword . '%')->limit($limit)->offSet($offSet)->orderBy("created_at", "desc")->get();
        $count = Story::count();
        return ['stories' => $stories, "count" => $count];
    }
    public function getStoryDetailById($id)
    {
        $story = DB::table('stories')->select()->find($id);
        return ['story' => $story];
    }
    public function getStoryTypeByPageId($id)
    {
        $storyType = Story::query()->where('id', '=', $id)->first('type');
        return $storyType;
    }
}
