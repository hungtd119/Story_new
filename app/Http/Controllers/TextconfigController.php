<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Models\Textconfig;
use App\Repositories\Textconfig\TextconfigInterface;
use App\Repositories\Textconfig\TextconfigRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TextconfigController extends Controller
{
    public $textconfigBaseService;
    public $textconfigRepository;
    public $textconfig;
    public function __construct(TextconfigRepository $textconfigBaseService, TextconfigInterface $textconfigRepository)
    {
        $this->textconfigBaseService = $textconfigBaseService;
        $this->textconfigRepository = $textconfigRepository;
        $this->textconfig = new Textconfig();
    }
    public function create(Request $request)
    { // Validate Input
        $request->validate([
            $this->textconfig->_PAGE_ID => 'required',
            $this->textconfig->_TEXT_ID => 'required',
        ]);
        try {
            // Get data inputs
            $dataInputs = $this->textconfigBaseService->getDataInput($request);
            // Execute logic
            $textconfig = $this->textconfigBaseService->store($dataInputs);
            return $this->responseJson('store textconfig success', $textconfig);
        } catch (ErrorException $e) {
            Log::error('Textconfig store failed.', [
                'dataInput' => $dataInputs,
            ]);
            throw ErrorException::badRequest($e);
        }
    }
}
