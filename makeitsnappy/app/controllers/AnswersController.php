<?php 

class AnswersController extends BaseController {

	public function post_create()
	{
		$input = Input::all();

		$rules = array(
		'answer'=>'required|min:2|max:255'
		);

		$validator = Validator::make($input, $rules);

		if ($validator->fails()) 
		{
			return Redirect::back()->withErrors($validator)->withInput();
		} 
		else 
		{
			$question_id = Input::get('question_id');

			$answer = new Answer;
				$answer->answer = Input::get('answer');
				$answer->user_id = Auth::user()->id;
				$answer->question_id = $question_id;
			$answer->save();

			return Redirect::to('question/'. $question_id)->with('message', 'Your answer has been posted!');
		}
		
	}
}