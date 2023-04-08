<!--   this view blade template for model App\Form
* you can get access to current obgect of model via
* $form
-->
@php
    if($form){
    $form->updateSchema();
    }
$user = Auth::user();
@endphp

    @if(Session::has('error'))
        @php($error=Session::get('error'))
        <div class="form-notifications alert @if(!$error)alert-success @else  alert-danger @endif}}">
            {{($error)?$form->error_text:$form->success_text}}
        </div>
    @endif

<form action="{{$form->action.'/'.$form->id}}" method="{{$form->method}}">
    {{--@if (count($errors) > 0)--}}
        {{--<div class="contact_form_title has-error">--}}
            {{--{{dump($errors)}}--}}
            {{--@foreach ($errors->all() as $error)--}}
                {{--<p>--}}
                            {{--<span style="color: red; font-size: 12px" class="error">--}}
                                {{--{{ $error }}--}}
                            {{--</span>--}}
                {{--</p>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--@endif--}}
    @if($fields=$form->getFields())
        {{ csrf_field() }}
        @foreach($fields as $field)
            @if(View::exists('forms.contacts.'.$field->name))
                @include('forms.contacts.'.$field->name, ['field'=> $field])
            @elseif($field->element!== 'own')
                @includeIfExist('forms.fields.field', ['field'=> $field])
            @endif
        @endforeach
        <div class="form-group">
            <button class="button btn-blue-border" type="submit">Отправить</button>
        </div>
    @endif
    {{--<div class="form-group">--}}
    {{--<input type="text" name="name" class="form-control" placeholder="Your Name">--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<input type="text" name="email" class="form-control" placeholder="Your Email">--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<input type="text" name="subject" class="form-control" placeholder="Subject">--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<textarea class="form-control"  name="body" rows="4" placeholder="Your message"></textarea>--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<button class="button btn-blue-border" type="submit">Отправить</button>--}}
    {{--</div>--}}
</form>