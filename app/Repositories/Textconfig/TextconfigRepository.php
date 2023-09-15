<?php

namespace App\Repositories\Textconfig;

use App\Exceptions\ErrorException;
use App\Http\Requests\TextStoreRequest;
use App\Models\Text;
use App\Models\Textconfig;
use App\Repositories\BaseService;
use App\Repositories\Helper\HelperInterface;
use http\Env\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class TextconfigRepository extends BaseService implements TextconfigInterface
{
    protected $helperRepository;
    public function __construct(Textconfig $textconfig, HelperInterface $helperRepository)
    {
        parent::__construct($textconfig, $helperRepository);
        $this->helperRepository = $helperRepository;
    }
}
