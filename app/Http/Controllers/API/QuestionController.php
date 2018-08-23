<?php

namespace App\Http\Controllers\API;

use App\Question;
use App\TypeQuestion;
use App\Answer;
use Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\API\MasterController as MasterController;

class QuestionController extends MasterController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $questions = Question::with(['answers', 'typeQuestion'])->where('user_id', $user_id)->get();

        return $this->returnResponse($questions->toArray(), 'Question returned successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::id();
        $user = Auth::user();
        $input = $request->all();
        $type = TypeQuestion::find($input['type_question_id']);

        //dd($input['question']);
        //die();
        $validator = Validator::make($input['question'], [
            'question' => 'required'
        ]);

        if($validator->fails()){
            return $this->returnError('Validation Error.', $validator->errors());   
        }
        
        $question = new Question($input['question']);
        $question->user()->associate($user);
        $question->typeQuestion()->associate($type);

        //$question = Question::forceCreate($input);
        //$user->structures()->create($input['structure'])) {
        if($question->save()) {
            //$inquiry = Question::find($question->id);
            //dd($input['answers']);
            //die();
            if($input['answers']) {
                foreach ($input['answers'] as $answer) {
                    $response = $question->answers()->create([
                        'answer' => $answer,
                    ]);
                }
            }
            
            return $this->returnResponse($question->toArray(), 'Question returned successfully.');
        }else {
            return $this->returnError('La pregunta no pudo ser guardada, intente de nuevo');
        }

        return response()->json($question->toArray(), 200);
        //return $this->returnResponse($question->toArray(), 'Post created successfully.');

        //return ['created' => true];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::with(['answers', 'typeQuestion'])->find($id);
        //$question = Question::find($id);
        return $this->returnResponse($question->toArray(), 'Question returned successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::find($id);
        //$user_id = Auth::id();
        $user = Auth::user();
        $input = $request->all();
        $type = TypeQuestion::find($input['type_question_id']);

        //dump($request->all());
        //die();
        $validator = Validator::make($input['question'], [
            'question' => 'required'
        ]);

        if($validator->fails()){
            return $this->returnError('Validation Error.', $validator->errors());   
        }
        
        //$question = $input['question'];
        $question->question = $input['question']['question'];
        //$question->user()->associate($user);
        $question->typeQuestion()->associate($type);
        $question->answers()->delete();
        //$question = Question::forceCreate($input);
        //$user->structures()->create($input['structure'])) {
        if($question->save()) {
            //$inquiry = Question::find($question->id);
            //dd($input['answers']);
            //die();
            if($input['answers']) {
                foreach ($input['answers'] as $answer) {
                    $response = $question->answers()->create([
                        'answer' => $answer['answer'],
                    ]);
                }
            }
            
            return $this->returnResponse($question->toArray(), 'Question returned successfully.');
        }else {
            return $this->returnError('La pregunta no pudo ser guardada, intente de nuevo');
        }

        return response()->json($question->toArray(), 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);

        // delete related   
        $question->answers()->delete();
        $question->structures()->detach();
        //$user->delete();
        if($question = $question->delete()) {
            return $this->returnResponse($question, 'Question delete successfully.');
        }else {
            return $this->returnError('La pregunta no pudo ser eliminada, intente de nuevo');
        }
    }
}
