<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    protected $fillable = ['title', 'mechanics', 'rules', 'prize', 'deadline', 'img'];

    /**
     * return the current unanswered question
     *
     * @return Question
     */
    public function nextQuestion()
    {
        $question_ids = UserAnswer
                ::where('user_id', auth()->user()->id)
                ->where('raffle_id', $this->id)
                ->lists('question_id');

        return Question
            ::where('raffle_id', $this->id)
            ->whereNotIn('id', $question_ids)
            ->first();
    }

    /**
     * check if raffle has question left to answer
     *
     * @return boolean
     */
    public function hasNextQuestion()
    {
        $question_ids = Question::where('raffle_id', $this->id)->lists('id');
        $user_answers = UserAnswer
                ::where('user_id', auth()->user()->id)
                ->where('raffle_id', $this->id)
                ->whereIn('question_id', $question_ids)
                ->get();
        return count($question_ids) !== count($user_answers);
    }

    /**
     * check if the user complete this raffle
     *
     * @return boolean
     */
    public function isCompleted()
    {
        $question_ids = Question::where('raffle_id', $this->id)->lists('id');
        $user_answers = UserAnswer
                ::where('user_id', auth()->user()->id)
                ->where('raffle_id', $this->id)
                ->whereIn('question_id', $question_ids)
                ->get();
        return count($question_ids) === count($user_answers);
    }

    /**
     * check if the user start this raffle but not completed it. (ongoind)
     *
     * @return boolean
     */
    public function isOngoing()
    {
        $question_ids = Question::where('raffle_id', $this->id)->lists('id');
        $user_start_raffle = UserAnswer
                ::where('user_id', auth()->user()->id)
                ->where('raffle_id', $this->id)
                ->whereIn('question_id', $question_ids)
                ->exists();
        return $user_start_raffle && ! $this->isCompleted();
    }

    /**
     * return the score of the raffle
     *
     * @return integer
     */
    public function score()
    {
        $s=0;
        $user_answers = UserAnswer
            ::where('raffle_id', $this->id)
            ->where('user_id', auth()->user()->id)
            ->get();
        foreach($user_answers as $user_answer){
            $correct_answer = Question::find($user_answer->question_id)->correctAnswer->answer;
            if($correct_answer ==  $user_answer->answer)
                $s+=1;
        }
        return ($s*100)/count($user_answers);
    }
}
