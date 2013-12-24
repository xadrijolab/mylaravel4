<?php 

class Question extends Eloquent {

	protected $table = 'questions';

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}

	public function answers()
	{
		return $this->hasMany('Answer');
	}

	public static function unsolved()
	{
		return static::where('solved', '=', 0)->orderBy('id', 'DESC')
			->paginate(3);
	}

	public static function your_questions()
	{
		return static::where('user_id', '=', Auth::user()->id)->paginate(3);
	}

	public static function search($keyword)
	{
		return static::where('question', 'LIKE', '%'.$keyword.'%')->paginate(3);
	}

	
}