<!-- Modal -->
@include("forms.photo.photo_popup", ['model_id' => $user->id, 'route' => 'dashboard.users.upload.image', 'header' => __('registration_photo_form.popup_header')])