<?php

class QuestionsController extends BaseController {

	public function index()
	{
		return View::make('questions.index')
			->with('title', 'Make It Snappy Q&A - Home')
			->with('questions', Question::unsolved());
	}

	public function post_create()
	{
		$input = Input::all();

		$rules = array(
			'question'=>'required|min:10|max:255',
			'solved'=>'in:0,1'
		);

		$validator = Validator::make($input, $rules);

		if ($validator->fails()) 
	    {
	    	return Redirect::back()->withErrors($validator)->withInput();
	    }
	    {
	    	$question = new Question;
	    		$question->question = Input::get('question');
	    		$question->user_id = Auth::user()->id;
	    	$question->save();

	    	return Redirect::to('/')->with('message', 'Your question has been posted!');
	    }
	}

	public function get_view($id = null)
	{
		return View::make('questions.view')
			->with('title', 'Make It Snappy - View Question')
			->with('question', Question::find($id));
	}

	public function get_your_questions()
	{
		return View::make('questions.your_questions')
			->with('title', 'Make It Snappy Q&A - Your Questions')
			->with('username', Auth::user()->username)
			->with('questions', Question::your_questions());
	}

	public function get_edit($id = NULL)
	{
		if (!$this->question_belongs_to_user($id)) {
			return Redirect::to('your-questions')->with('message', 'Invalid Question');
		} 
		
		return View::make('questions.edit')
			->with('title', 'Make It Snappy Q&A - Edit')
			->with('question', Question::find($id));		
	}

	public function put_update()
	{
		$id = Input::get('question_id');

		if (!$this->question_belongs_to_user($id)) {
			return Redirect::to('your-questions')->with('message', 'Invalid Question');
		}

		$input = Input::all();

		$rules = array(
			'question' => 'required',			
		);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			$question = Question::find($id);
				$question->question = Input::get('question');
				$question->solved = Input::get('solved');				
			$question->save();

			return Redirect::to('question/'. $id)->with('message', 'Your question has been updated');
		}
	}

	public function get_results($keyword)
	{
		return View::make('questions.results')
			->with('title', 'Make It Snappy Q&A - Search Results')
			->with('questions', Question::search($keyword));
	}

	public function post_search()
	{
		$keyword = Input::get('keyword');

		if (empty($keyword)) {
			return Redirect::to('/')->with('message', 'No keyword entered, please try again');
		} 

		return Redirect::to('results/'.$keyword);
		
	}

	private function question_belongs_to_user($id)
	{
		$question = Question::find($id);

		if($question->user_id == Auth::user()->id)
		{
			return true;
		}
		return false;
	}
}