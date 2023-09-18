<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Models\Interaction;
use App\Repositories\Interaction\InteractionInterface;
use App\Repositories\Interaction\InteractionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InteractionController extends Controller
{
    public $interactionBaseService;
    public $interactionRepository;
    public $interaction;
    public function __construct(InteractionRepository $interactionBaseService, InteractionInterface $interactionRepository)
    {
        $this->interactionBaseService = $interactionBaseService;
        $this->interactionRepository = $interactionRepository;
        $this->interaction = new Interaction();
    }
    public function create(Request $request)
    {
        $request->validate([
            $this->interaction->_BG => 'required',
            $this->interaction->_PAGE_ID => 'required',
            $this->interaction->_TEXT_ID => 'required'
        ]);
        try {
            $dataInputs = $this->interactionBaseService->getDataInput($request);
            $interaction = $this->interactionBaseService->store($dataInputs);
            return $this->responseJson("Create interaction done", $interaction);
        } catch (ErrorException $e) {
            Log::error('interaction store failed.', [
                'dataInput' => $dataInputs,
            ]);
            throw ErrorException::badRequest($e);
        }
    }
    public function getAllByPageId($id)
    {
        if (!$id) throw ErrorException::notFound("Id page not found");
        $interactions = $this->interactionRepository->getInteractionsByPageId($id);
        return $this->responseJson('find interactions by page id', $interactions);
    }
    public function getInteractionFull($id)
    {
        if (!$id) throw ErrorException::notFound("Id not found");
        $interaction = $this->interactionRepository->getInteractionFull($id);
        return $this->responseJson('find interactions by id', $interaction);
    }
}
