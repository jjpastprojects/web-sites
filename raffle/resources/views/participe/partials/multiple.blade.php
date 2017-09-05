<p>{{ $question->description }}</p>

@inject('multiChoice', 'App\Models\MultiChoice')

@foreach($multiChoice->where('question_id', $question->id)->get() as $answer)
    <div class="radio">
        <label>
            <input type="radio" name="answer" value="{{ $answer->answer }}" />
            {{ $answer->answer}}
        </label>
    </div>
@endforeach
