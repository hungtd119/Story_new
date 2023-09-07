<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Http\Requests\AudioStoreRequest;
use App\Models\Audio;
use App\Repositories\Audio\AudioInterface;
use App\Repositories\Audio\AudioRepository;
use App\Repositories\Helper\HelperInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AudioController extends Controller
{
    protected $audioRepository;
    public $audioBaseService;
    public $helperRepository;
    public $audio;

    public function __construct(AudioInterface $audioRepository, AudioRepository $audioBaseService, HelperInterface $helperRepository)
    {
        $this->audioRepository = $audioRepository;
        $this->audioBaseService = $audioBaseService;
        $this->helperRepository = $helperRepository;
        $this->audio = new Audio();
    }

    public function index(Request $request)
    {
        $limit = $request->query("limit") ? $request->query("limit") : 5;
        $page = $request->query("page") ? $request->query("page") : 1;

        $offSet = ($page - 1) * $limit;
        try {
            $audios = $this->audioBaseService->getAll($limit, $offSet);
            return $this->responseJson("get all audios", $audios);
        } catch (ErrorException $e) {
            Log::error('get all audios failed');
            throw $e;
        }
    }

    public function findById($id)
    {
        // validate
        if (!$id)
            throw ErrorException::notFound("Id audio not found.");
        try {
            $audio = $this->audioBaseService->findById($id);
            return $this->responseJson('get audio by id', $audio);
        } catch (ErrorException $e) {
            Log::error('Get audio by id failed', $id);
            throw $e;
        }
    }

    public function delete($id)
    {
        if (!$id) throw ErrorException::notFound("Id audio not found.");
        try {
            $this->audioBaseService->delete($id);
            return $this->responseJson("Deleted audio with id " . $id, true);
        } catch (ErrorException $e) {
            Log::error("Delete audio failed with id " . $id);
            throw $e;
        }
    }

    public function create(AudioStoreRequest $request)
    {
        // Validate Input
        $request->validate([
            $this->audio->_FILENAME => 'required',
            $this->audio->_PATH => 'required',
            $this->audio->_TIME => 'required',
            $this->audio->_TEXT_ID => 'required',
        ]);
        try {
            // Get data inputs
            $dataInputs = $this->audioBaseService->getDataInput($request);
            // Execute logic
            $audio = $this->audioBaseService->store($dataInputs);
            return $this->responseJson('store audio success', $audio);
        } catch (ErrorException $e) {
            Log::error('audio store failed.', [
                'dataInput' => $dataInputs,
            ]);
            throw ErrorException::badRequest($e);
        }
    }

    public function update(AudioStoreRequest $request)
    {
        $request->validate([
            $this->audio->_FILENAME => 'required',
            $this->audio->_PATH => 'required',
            $this->audio->_TIME => 'required',
            $this->audio->_TEXT_ID => 'required',
        ]);
        try {
            $id = $request->query("id");
            $dataInputs = $this->audioBaseService->getDataInput($request);
            $audio = $this->audioBaseService->store($dataInputs, $id);
            return $this->responseJson("Updated audio success", $audio);
        } catch (ErrorException $e) {
            Log::error("Update audio failed id" . $id);
            throw $e;
        }
    }
}
