<?php

namespace App\Http\Controllers;

use App\Http\Requests\AudioStoreRequest;
use App\Repositories\Audio\AudioInterface;
use Illuminate\Http\Request;

class AudioController extends Controller
{
    protected $audioRepository;

    public function __construct(AudioInterface $audioRepository)
    {
        $this->audioRepository = $audioRepository;
    }

    public function index()
    {
        $audios = $this->audioRepository->getAllAudios();
        return $this->responseJson(
            'get all audios',
            $audios);
    }

    public function findById($id)
    {
        $audio = $this->audioRepository->getAudioById($id);
        return $this->responseJson( 'Get audio by id', $audio);
    }

    public function delete($id)
    {
        $deletedAudio = $this->audioRepository->deleteAudio($id);
        return $this->responseJson('deleted audio with id ' . $id);
    }

    public function create(AudioStoreRequest $request)
    {
        $audio = $this->audioRepository->createAudio(
            $request->input('filename'),
            $request->input('path'),
            $request->input('time'),
            $request->input('text_id'),
        );
        return $this->responseJson('created audio',$audio);
    }

    public function update(AudioStoreRequest $request)
    {
        $updatedAudio = $this->audioRepository->updateAudio(
            $request->query('id'),
            $request->input('filename'),
            $request->input('path'),
            $request->input('time'),
            $request->input('text_id'),
        );
        return $this->responseJson('updated audio',$updatedAudio);
    }
}
