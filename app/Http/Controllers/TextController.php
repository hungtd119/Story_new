<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Http\Requests\TextStoreRequest;
use App\Models\Text;
use App\Repositories\Helper\HelperInterface;
use App\Repositories\Text\TextInterface;
use App\Repositories\Text\TextRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TextController extends Controller
{
    protected $textRepository;
    public $textBaseService;
    public $helperRepository;
    public $text;
    public function __construct(TextInterface $textRepository, TextRepository $textBaseService, HelperInterface $helperRepository)
    {
        $this->textRepository = $textRepository;
        $this->textBaseService = $textBaseService;
        $this->helperRepository = $helperRepository;
        $this->text = new Text();
    }

    public function index(Request $request)
    {
        $limit = $request->query("limit") ? $request->query("limit") : 5;
        $page = $request->query("page") ? $request->query("page") : 1;
        $keyword = $request->query("keyword") ? $request->query("keyword") : "";

        $offSet = ($page - 1) * $limit;
        try {
            $texts = $this->textBaseService->getAll($limit, $offSet, $keyword);
            return $this->responseJson("get all texts", $texts);
        } catch (ErrorException $e) {
            Log::error('get all texts failed');
            throw $e;
        }
    }
    public function findById($id)
    {
        // validate
        if (!$id)
            throw ErrorException::notFound("Id text not found.");
        try {
            $text = $this->textBaseService->findById($id);
            return $this->responseJson('get text by id', $text);
        } catch (ErrorException $e) {
            Log::error('Get text by id failed', $id);
            throw $e;
        }
    }
    public function delete($id)
    {
        if (!$id) throw ErrorException::notFound("Id text not found.");
        try {
            $this->textBaseService->delete($id);
            return $this->responseJson("Deleted text with id " . $id, true);
        } catch (ErrorException $e) {
            Log::error("Delete text failed with id " . $id);
            throw $e;
        }
    }
    public function create(Request $request)
    {
        // Validate Input
        $request->validate([
            $this->text->_TEXT => 'required',
        ]);
        try {
            // Get data inputs
            $dataInputs = $this->textBaseService->getDataInput($request);
            // Execute logic
            $text = $this->textBaseService->store($dataInputs);
            return $this->responseJson('store text success', $text);
        } catch (ErrorException $e) {
            Log::error('Text store failed.', [
                'dataInput' => $dataInputs,
            ]);
            throw ErrorException::badRequest($e);
        }
    }
    public function update(TextStoreRequest $request)
    {
        $request->validate([
            $this->text->_TEXT => 'required',
            $this->text->_ICON => 'required',
            $this->text->_WORD_SYNC => 'required',
        ]);
        try {
            $id = $request->query("id");
            $dataInputs = $this->textBaseService->getDataInput($request);
            $text = $this->textBaseService->store($dataInputs, $id);
            return $this->responseJson("Updated text success", $text);
        } catch (ErrorException $e) {
            Log::error("Update text failed id" . $id);
            throw $e;
        }
    }
}
