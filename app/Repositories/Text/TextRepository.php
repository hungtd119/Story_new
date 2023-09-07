<?php

namespace App\Repositories\Text;

use App\Exceptions\ErrorException;
use App\Http\Requests\TextStoreRequest;
use App\Models\Text;
use App\Repositories\BaseService;
use App\Repositories\Helper\HelperInterface;
use http\Env\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class TextRepository extends BaseService implements TextInterface
{
    protected $helperRepository;
    public function __construct(Text $text, HelperInterface $helperRepository)
    {
        parent::__construct($text, $helperRepository);
        $this->helperRepository = $helperRepository;
    }
}
