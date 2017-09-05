<form action="{{ route('question.store.quantative') }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="raffle_id" value="{{ Cache::get('raffle_id') }}">
<div class="formbg row question-container" id="quantative_question">
    <h2>Quantative Question</h2>
    <div class="form-horizontal textboxPadding question-holder" question="1">
        <div class="clearfix" style="margin-bottom: 15px;">
        <div class="col-md-12">
            <div class="question-textarea-container">
                <textarea class="form-control" name="description" style="height: 150px;"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="text-right" style="margin-top: 15px;">
                <input class="btn btn-primary done-question" type="submit" value="next Question" />
            </div>
        </div>
        </div>
    </div>
</div>
</form>
