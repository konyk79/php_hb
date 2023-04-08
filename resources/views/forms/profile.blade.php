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
<form method="POST" action="{{ $form->action.'/'.$user->id }}" class=" settings-user">
    @if($fields=$form->getFields())
        {{ csrf_field() }}

            <div class="row setting-user-data">
                <div class="col-md-offset-3 col-md-6">
                {{--<div class="col-lg-12 col-md-8">--}}
        @foreach($fields as $field)
            @if(View::exists('forms.profile.'.$field->name))
                @include('forms.profile.'.$field->name, ['field'=> $field])
            @elseif($field->element!== 'own')
                @includeIfExist('forms.fields.field', ['field'=> $field])
            @endif
        @endforeach
        {{--</div>--}}
                    <div class="form-group reset-flex text-right sm-text-center">
                        <button type="submit" class="button btn-blue">{{$form->submit_title}}</button>
                    </div>
                </div>
            </div>
    @endif
</form>
@php($action = 'add-photo')
@include("forms.photo.photo_popup_registration", ['profile_context' => '/home', 'action' => $action])
