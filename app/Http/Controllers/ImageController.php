<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Models\Image;
use App\Repositories\Image\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    public $imageBaseService;
    public $image;
    public function __construct(ImageRepository $imageBaseService)
    {
        $this->imageBaseService = $imageBaseService;
        $this->image = new Image();
    }
    public function index(Request $request)
    {
        $limit = $request->query("limit") ? $request->query("limit") : 5;
        $page = $request->query("page") ? $request->query("page") : 1;
        $keyword = $request->query("keyword") ? $request->query("keyword") : "";

        $offSet = ($page - 1) * $limit;
        try {
            $images = $this->imageBaseService->getAll($limit, $offSet, $keyword);
            return $this->responseJson("get all images", $images);
        } catch (ErrorException $e) {
            Log::error('get all images failed');
            throw $e;
        }
    }
    public function create(Request $request)
    {
        $request->validate([
            $this->image->_PATH => 'required',
            $this->image->_FILENAME => 'required',
        ]);
        try {
            $dataInputs = $this->imageBaseService->getDataInput($request);
            $image = $this->imageBaseService->store($dataInputs);
            return $this->responseJson("Create image done", $image);
        } catch (ErrorException $e) {
            Log::error('Image store failed.', [
                'dataInput' => $dataInputs,
            ]);
            throw ErrorException::badRequest($e);
        }
    }
}
