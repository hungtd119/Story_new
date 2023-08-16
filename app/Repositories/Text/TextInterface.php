<?php

namespace App\Repositories\Text;

use App\Http\Requests\TextStoreRequest;
use http\Env\Request;

interface TextInterface
{
    public function getAllTexts();
    public function getTextById($id);
    public function createText($textContent,$icon,$wordSync);
    public function updateText($id,$textContent,$icon,$wordSync);
    public function deleteText($id);
}
