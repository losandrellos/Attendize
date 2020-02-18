@foreach($ticket->questions->where('is_enabled', 1)->sortBy('sort_order') as $question)
    <div class="col-md-12 {{ $question->question_show_if > 0 ? 'hidden question_show_if question_show_if': '' }}" id="{{md5('ticket_holder_questions'.$ticket->id.'.'.$i.'.'.$question->id)}}">
        <div class="form-group">
            {!! Form::label("ticket_holder_questions[{$ticket->id}][{$i}][$question->id]", $question->title, ['class' => $question->is_required ? 'required' : '']) !!}
            @if($question->question_type_id == config('attendize.question_textbox_single'))
                {!! Form::text("ticket_holder_questions[{$ticket->id}][{$i}][$question->id]", null, [$question->is_required ? 'required' : '' => $question->is_required ? 'required' : '', 'class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}   form-control"]) !!}
            @elseif($question->question_type_id == config('attendize.question_textbox_multi'))
                {!! Form::textarea("ticket_holder_questions[{$ticket->id}][{$i}][$question->id]", null, ['rows'=>5, $question->is_required ? 'required' : '' => $question->is_required ? 'required' : '', 'class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}  form-control"]) !!}
            @elseif($question->question_type_id == config('attendize.question_dropdown_single'))
                {!! Form::select("ticket_holder_questions[{$ticket->id}][{$i}][$question->id]", array_merge(['' => '-- Please Select --'], $question->options->pluck('name', 'name')->toArray()), null, [$question->is_required ? 'required' : '' => $question->is_required ? 'required' : '', 'class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}   form-control"]) !!}
            @elseif($question->question_type_id == config('attendize.question_dropdown_multi'))
                {!! Form::select("ticket_holder_questions[{$ticket->id}][{$i}][$question->id][]",$question->options->pluck('name', 'name'), null, [$question->is_required ? 'required' : '' => $question->is_required ? 'required' : '', 'multiple' => 'multiple','class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}   form-control"]) !!}
            @elseif($question->question_type_id == config('attendize.question_checkbox_multi'))
                <br>
                @foreach($question->options as $option)
                    <?php
                        $checkbox_id = md5($ticket->id.$i.$question->id.$option->name);
                    ?>
                    <div class="custom-checkbox">
                        {!! Form::checkbox("ticket_holder_questions[{$ticket->id}][{$i}][$question->id][]",$option->name, false,['class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}  ", 'id' => $checkbox_id]) !!}
                        <label for="{{ $checkbox_id }}">{{$option->name}}</label>
                    </div>
                @endforeach
            @elseif($question->question_type_id == config('attendize.question_radio_single'))
                <br>
                @foreach($question->options as $option)
                    <?php
                    $radio_id = md5($ticket->id.$i.$question->id.$option->name);
                    ?>
                <div class="custom-radio">
                    {!! Form::radio("ticket_holder_questions[{$ticket->id}][{$i}][$question->id]",$option->name, false, ['id' => $radio_id, 'class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}  "]) !!}
                    <label for="{{ $radio_id }}">{{$option->name}}</label>
                </div>
                @endforeach
            @endif
            @if ($question->description !== '')
                <div>
                    <p>{{$question->description}}</p>
                </div>
            @endif
            @if ($question->question_show_if > 0 )
                <span class="hidden show_if_md5">{{ md5($ticket->id.'0'.$question->question_show_if.'Yes') }}</span>
                <span class="hidden hide_if_md5">{{ md5($ticket->id.'0'.$question->question_show_if.'No') }}</span>
                <span class="hidden show_if_question_id">{{ $question->question_show_if }}</span>
            @endif
        </div>
    </div>
@endforeach
