<?php

namespace App\Http\Controllers\API;

use App\Question;
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
        $questions = Question::with('answers')->where('user_id', $user_id)->get();

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
        $input = $request->all();

        $validator = Validator::make($input, [
            'question' => 'required'
        ]);

        if($validator->fails()){
            return $this->returnError('Validation Error.', $validator->errors());   
        }

        //$question = Question::forceCreate($input);

        if($question = Question::forceCreate($input['question'])) {
            //$inquiry = Question::find($question->id);
            //dd($input['answers']);
            //die();
            foreach ($input['answers'] as $answer) {
                $response = $question->answers()->create([
                    'answer' => $answer,
                ]);
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
        $question = Question::find($id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
