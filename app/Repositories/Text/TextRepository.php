<?php

namespace App\Repositories\Text;

use App\Exceptions\ErrorException;
use App\Http\Requests\TextStoreRequest;
use App\Models\Text;
use App\Repositories\Helper\HelperInterface;
use http\Env\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class TextRepository implements TextInterface
{
    protected $helperRepository;
    public function __construct(HelperInterface $helperRepository)
    {
        $this->helperRepository = $helperRepository;
    }
    public function getAllTexts()
    {
        // TODO: Implement getAllTexts() method.
        try {
            $texts = Text::with('audio')->get();
            Log::info('Get all Texts');
            return $texts;
        }
        catch (QueryException $exception){
            throw ErrorException::queryFailed($exception);
        }
    }

    public function getTextById($id)
    {
        // TODO: Implement getTextById() method.
        try {
            $text = Text::with('audio')->find($id);
            if (!$text)
                throw ErrorException::notFound('Text not found with id '.$id);
            Log::info('Get text by id');
            return $text;
        }catch (QueryException $exception){
            throw ErrorException::queryFailed($exception);
        }
    }

    public function createText($textContent,$icon,$wordSync)
    {
        // TODO: Implement createText() method.
        try {
            $text = new Text();
            $text->id = $this->helperRepository->generateUniqueCode('Text');
            $text->text = $textContent;
            $text->icon = $icon;
            $text->wordSync = $wordSync;
            $text->save();
            Log::info('Created a new Text');
            return $text;
        }catch (QueryException $exception){
            throw ErrorException::queryFailed($exception);
        }
    }

    public function updateText($id,$textContent,$icon,$wordSync)
    {
        // TODO: Implement updateText() method.
        try {
            $text = Text::find($id);
            if (!$text)
                throw ErrorException::notFound('Text not found with id '.$id);
            $text->text = $textContent;
            $text->icon = $icon;
            $text->wordSync = $wordSync;
            $text->save();
            Log::info('Updated text with id: '.$id);
            return $text;
        }
        catch (QueryException $exception){
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }

    public function deleteText($id)
    {
        // TODO: Implement deleteText() method.
        try {
            $text = Text::find($id);
            if (!$text)
                throw ErrorException::notFound('Text not found with id '.$id);
            $text->delete();
            Log::info('Deleted Text with id: '.$id);
            return true;
        }catch (QueryException $exception){
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }
}
