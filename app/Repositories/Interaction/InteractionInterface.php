<?php

namespace App\Repositories\Interaction;

interface InteractionInterface
{
    public function getInteractionsByPageId($id);
    public function getInteractionFull($id);
}
