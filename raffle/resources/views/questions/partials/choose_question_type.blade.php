<div class="form-inline" role="form" style="padding: 15px 0;">
<div class="container">
<div class ="form-group">

  <label class="control-label labelFont">Questionnaires</label>
</div>

<div class="form-group">
    <label class="control-label" for="choice" style="margin-left: 10px;">Choose Question Type</label>
</div>

<div class="form-group">
    <div class="paddingLeft question-type-checkbox" style="margin-left: 10px;">

        <a
           class="btn btn-primary question_a"
           href="{{ route('question.create') }}?question_type=multiple_choice"
           id="multiple_choice_a"
        >
           Multiple Choice
        </a>

        <a
            class="btn btn-primary question_a"
            href="{{ route('question.create') }}?question_type=quantative"
            id="quantative_question_a"
            >
            Quantative Question
        </a>

        <a
            class="btn btn-primary question_a"
           href="{{ route('question.create') }}?question_type=qualitative"
            id="qualitative_question_a"
            >
            Qualitative Question
        </a>

 </div>

</div>
</div>
</div>
