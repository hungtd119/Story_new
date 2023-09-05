<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageStoreRequest;
use App\Http\Resources\DataCollection;
use App\Models\Page;
use App\Repositories\Page\PageInterface;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public $pageRepository;

    public function __construct(PageInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function index()
    {
        $page = $this->pageRepository->getAllPage();
        return response(new DataCollection($page), 200);
    }

    public function findById($id)
    {
        $page = $this->pageRepository->getPageById($id);
        return $this->responseJson( 'find page by id',$page);

    }

    public function findByStory($id){
        $pages = $this->pageRepository->getPageByStory($id);
        return $this->responseJson('find pages by story',$pages);
    }

    public function create(PageStoreRequest $request)
    {
        $createdPage = $this->pageRepository->createPage(
            $request->input('image_id'),
            $request->input('page_number'),
            $request->input('story_id'),
        );
        return $this->responseJson( 'Created a new Page', $createdPage);
    }

    public function delete($id)
    {
        $deletedPage = $this->pageRepository->deletePage($id);
//        return response([
//            'success' => true,
//            'message' => 'deleted page',
//        ]);
        return $this->responseJson('deleted page');

    }

    public function update(PageStoreRequest $request)
    {
        $updatedPage = $this->pageRepository->updatePage(
            $request->query('id'),
            $request->input('image_id'),
            $request->input('page_number'),
            $request->input('story_id'),
        );
        return $this->responseJson( 'updated page', $updatedPage);
    }
}
