<!--   this view blade template for model App\Form
* you can get access to current obgect of model via
* $form
-->
@php
    if($form){
    $form->updateSchema();
    }

@endphp
<!--Start subsctibe-->
{{--anchor ned include scroll_down.js in layout--}}
@if (Session::has('anchor'))
    <input type="hidden" name="anchor" value="{{ Session::get('anchor') }}">
@endif
{{-- END anchor--}}
<div class="footer-subscribe">
    <div class="container flex-clearfix flex-block align-items-center xs-flex-column">
        <div class="title white-text xs-text-center">{{$form->title}}</div>
        <form action="{{$form->action.'/'.$form->id}}" method="{{$form->method}}" class="xs-margin-t">
            @if($fields=$form->getFields())
                {{ csrf_field() }}
                @foreach($fields as $field)
                    @switch($field->type)
                        @case('string')
                        @case('integer')
                        <input type="text" @if($field->required) required @endif name="{{$field->name}}"
                               id="{{$field->name}}"
                               placeholder="{{$field->placeholder}}"
                               class="form-control">
                        @break
                        @case('integer')
                        <input type="number" name="{{$field->name}}" id="{{$field->name}}"
                               placeholder="{{$field->placeholder}}"
                               class="form-control">
                        @break
                    @endswitch
                @endforeach
            @endif
            <button type="submit" class="button btn-black">
                <span class="icon"></span>
            </button>
        </form>


    </div>
    <div class="form-notifications">
    @if(Session::has('error'))
        {{(Session::get('error'))?$form->error_text:$form->success_text}}
    @endif
    </div>
</div>
<!--End subscribe-->