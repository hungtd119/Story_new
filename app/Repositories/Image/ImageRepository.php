<?php

namespace App\Repositories\Image;

use App\Models\Image;
use App\Repositories\BaseService;
use App\Repositories\Helper\HelperInterface;

class ImageRepository extends BaseService
{
    protected $helperRepository;
    public function __construct(Image $image, HelperInterface $helperRepository)
    {
        parent::__construct($image, $helperRepository);
        $this->helperRepository = $helperRepository;
    }
}
