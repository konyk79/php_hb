<div class="form-group">
    @if($field->label)
        <label for="$field->name" class="col-md-4 col-xs-12 control-label">{{$field->label}}</label>
    @endif
    <div class="col-sm-3 text-center">
        @php
            if($user){
                $photo = $user->photo;
                $filename = 'default-user-image.png/';
                if(!is_null($photo)) {
                    $filename = $user->photo . "/";
                }
            }

        @endphp
        <img src="{{url('/dashboard/users/getImage/'.$filename)}}" class="img-circle" alt="Cinque Terre" width="150" height="150">
    </div>
    <div class="col-sm-9">



        {{--{!! Form::label('image', 'Фотография', ['class' => 'control-label ']) !!}--}}
        <hr>
        {!! Form::button(trans('profile_image.upload_image'), [ 'data-toggle' => 'modal', 'data-target' => '#crop-avatar', 'class' => 'button btn-black-border full-width mar-bot']) !!}
        @if(!is_null($user->photo))
            {!! Form::button(trans('profile_image.delete_image'), [ 'onclick' => 'location.href=\''. url('/dashboard/users/deleteImage' ) . '\'', 'class' => 'button btn-red full-width ']) !!}
        @endif
    </div>

</div>

<hr>

{{--@if($action == 'add-photo')--}}
    {{--@php--}}
        {{--$user=Auth::user();--}}
        {{--$url = getReturnURL('add_registration','/home/registrations');--}}
    {{--@endphp--}}
    {{--<div class="form-inline pull-right">--}}

        {{--@if($context == 'administration')--}}
            {{--{!! Form::button(' Готово', ['onclick' => 'location.href=\''. url('/home/administration/add/participant/' . $registration->id. '/service/to-event/' . $eventId) . '\'', 'class' => 'btn btn-success submit_save_data_btn']) !!}--}}
        {{--@elseif($context == 'landing')--}}
            {{--{!! Form::button(' Готово', ['onclick' => 'location.href=\''. url('/landing/event/' . $event->code . '/add/participant/service') . '\'', 'class' => 'btn btn-success submit_save_data_btn']) !!}--}}
        {{--@else--}}
            {{--{!! Form::button(' Готово', ['onclick' => 'location.href=\''. url($url) . '\'', 'class' => 'btn btn-success submit_save_data_btn']) !!}--}}
        {{--@endif--}}
    {{--</div>--}}
{{--@endif--}}