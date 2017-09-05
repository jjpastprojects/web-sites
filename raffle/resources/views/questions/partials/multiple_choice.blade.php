<form action="{{ route('question.store.multiple') }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<input type="hidden" name="raffle_id" value="{{ Cache::get('raffle_id') }}">

<div class="formbg row question-container" id="multiple_choice">
    <h2>Multiple Choice</h2>
    <div class="form-horizontal textboxPadding question-holder" question="1">
        <div class="clearfix" style="margin-bottom: 15px;">
        <div class="col-md-6">
            <div class="question-textarea-container">
                <textarea class="form-control" name="description" style="height: 150px;"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="question-radio-container">
                <div class="radio">
                    <label class="labelWidth">
                        <input style="margin-top: 10px;" type="radio" name="correct_answer" value="1" checked>
                        <input type="text" class="form-control customPlaceholder answerino" name="answers[1]" id="answer" placeholder="Enter Answer">
                    </label>
                </div>
                <div class="radio">
                    <label class="labelWidth">
                        <input style="margin-top: 10px;" type="radio" name="correct_answer" value="2" checked>
                        <input type="text" class="form-control customPlaceholder answerino" name="answers[2]" id="answer" placeholder="Enter Answer">
                    </label>
                </div>
                <div class="radio">
                    <label class="labelWidth">
                        <input style="margin-top: 10px;" type="radio" name="correct_answer" value="3" checked>
                        <input type="text" class="form-control customPlaceholder answerino" name="answers[3]" id="answer" placeholder="Enter Answer">
                    </label>
                </div>
                <div class="radio">
                    <label class="labelWidth">
                        <input style="margin-top: 10px;" type="radio" name="correct_answer" value="4" checked>
                        <input type="text" class="form-control customPlaceholder answerino" name="answers[4]" id="answer" placeholder="Enter Answer">
                    </label>
                </div>
            </div>
            <div class="" style="margin-top: 15px;">
                <input class="btn btn-primary" type="submit" value="next Question" />
            </div>
        </div>
        </div>
    </div>
</div>
</form>
