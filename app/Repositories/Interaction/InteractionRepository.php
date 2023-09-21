<?php

namespace App\Repositories\Interaction;

use App\Exceptions\ErrorException;
use App\Models\Interaction;
use App\Repositories\BaseService;
use App\Repositories\Helper\HelperInterface;
use Illuminate\Database\QueryException;

class InteractionRepository extends BaseService implements InteractionInterface
{
    protected $helperRepository;
    public function __construct(Interaction $interaction, HelperInterface $helperRepository)
    {
        parent::__construct($interaction, $helperRepository);
        $this->helperRepository = $helperRepository;
    }
    public function getInteractionsByPageId($id)
    {
        try {
            $interactions = Interaction::query()->with('positions')->where('page_id', $id)->get();
            $count = Interaction::query()->where('page_id', $id)->count();
            return [
                'interactions' => $interactions,
                'count' => $count
            ];
        } catch (QueryException $exception) {
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }
    public function getInteractionFull($id)
    {
        try {
            $interaction = Interaction::query()->with('positions.text.audio', 'text')->where('id', $id)->first();
            return $interaction;
        } catch (QueryException $exception) {
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }
}
