<!-- Modal -->
{{--<div class="modal fade" id="ProfileImageModal" role="dialog">--}}
{{--<div class="modal-dialog modal-sm">--}}
{{--<div class="modal-content">--}}
{{--<div class="modal-header">--}}
{{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
{{--<h4 class="modal-title">{{ $header }}</h4>--}}
{{--</div>--}}
{{--{!! Form::open(['route' => [$route, $model_id], 'files' => true, 'method' => 'post', 'class' => 'form-horizontal']) !!}--}}
{{--<div class="modal-body">--}}
{{--<div class="h6">@lang('registration_photo_form.popup_comment')</div>--}}
{{--{!! Form::token() !!}--}}
{{--{!! Form::file('image', ['class' => 'form-control']) !!}--}}
{{--</div>--}}
{{--<div class="modal-footer">--}}
{{--{!! Form::button('Сохранить', ['type'=>'submit', 'class' => 'btn btn-success']) !!}--}}
{{--{!! Form::button('Закрыть', [ 'data-dismiss' => 'modal', 'data-target' => '#myModal', 'class' => 'btn btn-info']) !!}--}}
{{--</div>--}}
{{--{!! Form::close() !!}--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

<div id="crop-avatar" class="modal fade" role="dialog">
    <!-- Cropping modal -->
    <div id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="avatar-form" action="/dashboard/users/uploadImage" enctype="multipart/form-data" method="post">
                    {!! Form::token() !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="avatar-modal-label">{{trans('profile_image.choose_image')}}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">

                            <!-- Upload image and data -->
                            <div class="text-center avatar-upload">
                                {{--<input type="hidden" name="mode" value=" @mode ">--}}
                                {{--                                <input type="hidden" name="registrationId" value="{{$registration->id}}">--}}
                                <input type="hidden" class="avatar-src" name="avatar_src">
                                <input type="hidden" class="avatar-data" name="avatar_data">
                                <div class="text-center"><label for="avatarInput">{{trans('profile_image.choose_file_image')}}</label></div>

                                {{--<input type="file" class="avatar-input" id="avatarInput" name="avatar_file">--}}
                                <label for="file-image" class="button btn-black-border  mar-bot fileContainer">{{trans('profile_image.upload_image')}}<input type="file" class="avatar-input" id="avatarInput" name="avatar_file"/></label>
                            </div>

                            <!-- Crop and preview -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="avatar-wrapper"></div>
                                </div>
                                {{--<div class="col-md-3">--}}
                                {{--<div class="avatar-preview preview-md"></div>--}}
                                {{--<div class="avatar-preview preview-sm"></div>--}}
                                {{--</div>--}}
                            </div>


                        </div>
                    </div>
                    <div class="row avatar-btns modal-footer text-right">
                        {{--<div class="col-md-9"></div>--}}
                        <div class="col-md-3 pull-right">
                            <button type="submit" class="button btn-blue avatar-save">
                                {{trans('profile_image.upload_button')}}
                            </button>
                        </div>
                    </div>
                {{--<div class="modal-footer text-right">--}}
                {{--<button type="button" class="button btn-silver" data-dismiss="modal">Close</button>--}}
                {{--<button  type="submit"type="button" class="button btn-blue">Save changes</button>--}}
                {{--</div>--}}
                <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div> -->
                </form>
            </div>
        </div>
    </div><!-- /.modal -->


    <!-- Loading state -->
    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
</div>