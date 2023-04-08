<!--   this view blade template for model App\Form
* you can get access to current obgect of model via
* $form
-->
@php
    if($form){
    $form->updateSchema();
    }
$user = Auth::user();
$isProfileExists = false;//!is_null($currentUser->profile);
    function isOldValueExist($value) {
        return !(old($value) === null || old($value) === "");
    }
@endphp
<form method="POST" action="{{ $form->action }}" class="main-form">
    @if($fields=$form->getFields())
        {{ csrf_field() }}
        @foreach($fields as $field)
            @if(View::exists('forms.register.'.$field->name))
                @include('forms.register.'.$field->name, ['field'=> $field])
            @elseif($field->element!== 'own')
                @includeIfExist('forms.fields.field', ['field'=> $field])
            @endif
        @endforeach
    @endif
    <!--end if type choice сoorporate-->
    {{--<div class="   form-group ">--}}
        {{--<a href="@contentHref('contact_us_reg')" class="button btn-black full-width height-control">@contentHrefText('contact_us_reg')</a>--}}
    {{--</div>--}}
    <div class="   form-group {{  ($isError=$errors->has('confirmed')) ? ' has-error' : '' }} flex-block align-items-center justify-content-space-beetwen xs-flex-column">
        {{--<div class="checkbox">--}}
            {{--<input id="checkbox1" type="checkbox">--}}
            {{--<label for="checkbox1">Запомнить меня</label>--}}
        {{--</div>--}}
        <div class="checkbox">
            <input id="checkbox1"  required name="confirmed" type="checkbox"     @if(old('confirmed')) checked @endif>

            <label for="checkbox1"><a href="" data-toggle="modal" data-target="#myModal">{{($field=$form->getField('confirmed'))->placeholder}}</a></label>
            @if($isError)
                <div class="text-danger">{{  $isError=$errors->first($field->name)}}</div>
            @endif
        </div>
        <button class="button btn-blue" type="submit">{{$form->submit_title}}</button>
    </div>
</form>
 {{--Modal page vith --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">@contentTitle('agreement_reg')</h4>
            </div>
            <div class="modal-body">
                @contentText('agreement_reg')
            </div>
            <div class="modal-footer">
                <button type="button" class="button btn-silver" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
