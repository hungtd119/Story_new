<?php

namespace App\Http\Controllers;

use App\Http\Requests\TextStoreRequest;
use App\Repositories\Text\TextInterface;
use Symfony\Component\HttpFoundation\Response;

class TextController extends Controller
{
    protected $textRepository;
    public function __construct(TextInterface $textRepository)
    {
        $this->textRepository = $textRepository;
    }

    public function index (){
        $texts = $this->textRepository->getAllTexts();
//        return response([
//            'success'=>true,
//            'message'=>'find all texts',
//            'data'=>$texts
//        ],Response::HTTP_OK);
        return $this->responseJson('find all texts',$texts);
    }
    public function findById ($id) {
        $text = $this->textRepository->getTextById($id);
        return $this->responseJson('find text by id',$text);
    }
    public function delete ($id) {
        $text = $this->textRepository->deleteText($id);
//        return \response([
//            'success'=>true,
//            'message'=>'deleted text',
//        ],Response::HTTP_OK);
        return $this->responseJson('deleted text');
    }
    public function update (TextStoreRequest $request) {
        $text = $this->textRepository->updateText(
            $request->query('id'),
            $request->input('text'),
            $request->input('icon'),
            $request->input('wordSync'),
        );
        return $this->responseJson('updated text',$text);
    }
    public function create (TextStoreRequest $request) {
        $text = $this->textRepository->createText(
            $request->input('text'),
            $request->input('icon'),
            $request->input('wordSync'),
        );
        return $this->responseJson('created text',$text);
    }
}
