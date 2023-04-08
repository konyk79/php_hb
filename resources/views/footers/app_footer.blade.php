<!--   this view blade template for model App\Footer
* you can get access to current obgect of model via
* $footer
-->
<!--   start include @content... directives
* $self  - must point to model of this html view's entity to make possible use @content... directives
* to include insert such php string
*  $self= $objectOfModel;
* and take care that you Model has getContentByName() method
-->
<!--   SocialLinks
* For can get access to social links via ->sociallinks you must add: use Socialized;   in you model
-->
<!--   Menus
* For can get access to related menu via ->menus you must add: use Menuable;   in you model and has in model's table menu_id fiel
-->
@php $self=$footer @endphp
<!--   endinclude @content... directives -->
<!--Start footer-->
<footer class="footer">
    <div class="container flex-clearfix xs-flex-column">
        <img src="@contentImage('app_footer_logo')" alt="">
        @if($footer->menu)
            @includeIfExist($footer->menu->getViewName(),['menu'=>$footer->menu ])
        @endif
        @if($sociallinks=$footer->social_links)
            <div class="social-footer">
                @foreach($sociallinks as $link)
                    <a target="_blank" href="{{$link->href}}"><img src="{{$link->image}}" alt=""></a>
                @endforeach
            </div>
        @endif
    </div>
</footer>
<!--End footer-->