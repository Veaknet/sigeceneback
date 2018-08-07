<?php

namespace App\Http\Controllers\API;

use App\Structure;
use App\Question;
use Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StructureController extends MasterController
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $structures = Structure::with('questions')->where('user_id', $user_id)->get();

        return $this->returnResponse($structures->toArray(), 'Structures returned successfully.');
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

        $validator = Validator::make($input['structure'], [
            'name' => 'required'
        ]);

        if($validator->fails()){
            return $this->returnError('Validation Error.', $validator->errors());   
        }
        //dd($input['structure']);
        //$question = Question::forceCreate($input);
        //$input['user_id'] = $id;
        if($structure = $user->structures()->create($input['structure'])) {
            //$inquiry = Question::find($question->id);
            //dd($input['answers']);
            //die();
            $structure->questions()->attach($input['questions']);
            //$structure->questions()->sync($input['questions']);

            //foreach ($input['questions'] as $question) {
                //$structure->questions()->attach($question['id']);
                //$structure->questions()->sync($question['id']);
                //$user->roles()->sync([$role_id_1, $role_id_2, ...]);
                //$structure->questions()->sync($question['id']);
            //}
            
            return $this->returnResponse($structure->toArray(), 'Structure returned successfully.');
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
        //
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
