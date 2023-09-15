<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Models\Position;
use App\Repositories\Position\PositionInterface;
use App\Repositories\Position\PositionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PositionController extends Controller
{
    public $positionBaseService;
    public $positionRepository;
    public $position;
    public function __construct(PositionRepository $positionBaseService, PositionInterface $positionRepository)
    {
        $this->positionBaseService = $positionBaseService;
        $this->positionRepository = $positionRepository;
        $this->position = new Position();
    }
    public function create(Request $request)
    {
        $request->validate([
            $this->position->_POSITION_X => 'required',
            $this->position->_POSITION_Y => 'required',
            $this->position->_WIDTH => 'required',
            $this->position->_HEIGHT => 'required',
            $this->position->_IS_DRAGGING => 'required',
            $this->position->_IS_RESIZING => 'required',
            $this->position->_RESIZE_DIRECT => 'required',
            $this->position->_DRAG_START_X => 'required',
            $this->position->_DRAG_START_Y => 'required',
            $this->position->_INTERACTION_ID => 'required',
            $this->position->_TEXT_ID => 'required',
        ]);
        try {
            $dataInputs = $this->positionBaseService->getDataInput($request);
            $position = $this->positionBaseService->store($dataInputs);
            return $this->responseJson('Create position done', $position);
        } catch (ErrorException $e) {
            Log::error('position store failed.', [
                'dataInput' => $dataInputs,
            ]);
            throw ErrorException::badRequest($e);
        }
    }
    public function createPositionsByInteraction(Request $request)
    {
        $inputData = $request->all();
        $result = $this->positionRepository->createPositionsByInteraction($inputData);
        return $this->responseJson($result);
    }
}
