<!--   this view blade template for model App\Page
* uou can get access to current obgect of model via
* $header
-->
<!--   start include @content... directives
* $self  - must point to model of this html view's entity to make possible use @content... directives
* to include insert such php string
*  $self= $objectOfModel;
* and take care that you Model has getContentByName() method
-->
@php $self=$header @endphp
<!--   endinclude @content... directives -->

<div class="header-navigation "
     style="background-image: url( @contentImage('main_header') )" >
    @if($header->menu)
        @includeIfExist($header->menu->getViewName(),['menu'=>$header->menu ])
    @endif
</div>