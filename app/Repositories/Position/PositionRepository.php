<?php

namespace App\Repositories\Position;

use App\Exceptions\ErrorException;
use App\Models\Interaction;
use App\Models\Position;
use App\Repositories\BaseService;
use App\Repositories\Helper\HelperInterface;
use Illuminate\Database\QueryException;

class PositionRepository extends BaseService implements PositionInterface
{
    protected $helperRepository;
    public function __construct(Position $position, HelperInterface $helperRepository)
    {
        parent::__construct($position, $helperRepository);
        $this->helperRepository = $helperRepository;
    }
    public function createPositionsByInteraction($interactions)
    {
        foreach ($interactions as $interaction) {
            foreach ($interaction['positions'] as $position) {
                if (!isset($position['id'])) {
                    $this->createPosition($interaction['id'], $interaction['text_id'], $position);
                } else {
                    $this->updatePosition($position);
                }
            }
        }
        return 'Created or Updated positions';
    }
    public function createPosition($interactionId, $textId, $positionData)
    {
        try {
            $position = new Position();
            $positionData[$position->_ID] = $this->helperRepository->generateUniqueCode($this->model->_NAME);
            $positionData[$position->_TEXT_ID] = $textId;
            $positionData[$position->_INTERACTION_ID] = $interactionId;
            $position->fill($positionData);
            $position->save();
            return true;
        } catch (QueryException $e) {
            throw ErrorException::queryFailed($e->getMessage());
        }
    }
    public function updatePosition($position)
    {
        try {
            $updatePosition = Position::query()->find($position['id']);
            $updatePosition->update($position);
            return true;
        } catch (QueryException $e) {
            throw ErrorException::queryFailed($e->getMessage());
        }
    }
}
