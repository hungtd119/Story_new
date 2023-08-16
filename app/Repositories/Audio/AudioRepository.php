<?php

namespace App\Repositories\Audio;

use App\Exceptions\ErrorException;
use App\Models\Audio;
use App\Repositories\Helper\HelperInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AudioRepository implements AudioInterface
{
    protected $helperRepository;
    public function __construct(HelperInterface $helperRepository)
    {
        $this->helperRepository = $helperRepository;
    }

    public function getAllAudios()
    {
        // TODO: Implement getAllAudios() method.
        try {
            $audios = Audio::all();
            Log::info('Get all audios');
            return $audios;
        }catch (QueryException $exception){
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }

    public function getAudioById($id)
    {
        // TODO: Implement getAudioById() method.
        try {
            $audio = DB::table('audios')->find($id);
            Log::info('Get audio by id: '.$id);
            return $audio;
        }catch (QueryException $exception){
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }

    public function createAudio($filename, $path, $time, $text_id)
    {
        // TODO: Implement createAudio() method.
        try {
            $audio = new Audio();
            $audio->id = $this->helperRepository->generateUniqueCode('Audio');
            $audio->filename = $filename;
            $audio->path = $path;
            $audio->time = $time;
            $audio->text_id = $text_id;

            $audio->save();
            Log::info('Created a new audio',[
                'audio'=>$audio
            ]);
            return $audio;
        }catch (QueryException $exception){
            throw ErrorException::queryFailed($exception->getMessage());
        }
    }

    public function updateAudio($id, $filename, $path, $time, $text_id)
    {
        // TODO: Implement updateAudio() method.
        $audio = Audio::find($id);
        if (!$audio)
            throw ErrorException::notFound('Audio not found with id: '.$id);
        $audio->filename = $filename;
        $audio->path = $path;
        $audio->time = $time;
        $audio->text_id = $text_id;

        $audio->save();
        Log::info('Updated the audio',[
            'audio'=>$audio
        ]);
        return $audio;
    }

    public function deleteAudio($id)
    {
        // TODO: Implement deleteAudio() method.
        $audio = Audio::find($id);
        if (!$audio)
            throw ErrorException::notFound('Audio with id :' .$id . ' Not found');
        $audio->delete();
        Log::info('Deleted audio with id: '.$id);
        return true;
    }
}
