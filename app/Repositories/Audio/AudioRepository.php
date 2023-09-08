<?php

namespace App\Repositories\Audio;

use App\Exceptions\ErrorException;
use App\Models\Audio;
use App\Repositories\BaseService;
use App\Repositories\Helper\HelperInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AudioRepository extends BaseService implements AudioInterface
{
    protected $helperRepository;
    public function __construct(Audio $audio, HelperInterface $helperRepository)
    {
        parent::__construct($audio, $helperRepository);
        $this->helperRepository = $helperRepository;
    }
}
