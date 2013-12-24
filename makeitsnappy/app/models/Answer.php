<?php 

class Answer extends Eloquent {

	protected $table = 'answers';

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function question()
	{
		return $this->belongsTo('Question');
	}
}