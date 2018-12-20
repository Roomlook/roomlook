

<div class="slides">
    @include('partials.popup-room-slide')
    @foreach($project->rooms as $room)
        @foreach($room->pictures as $p)
            @if ($p->id != $picture->id)
                @include('partials.popup-room-slide', ['picture' => $p, 'room' => $room])
            @endif
        @endforeach
    @endforeach
    
    
</div>
<script>
   
    $(".slide").width($(window).width());
    var wWidth = $(window).width();
    var wHeight = $(window).height();
    // $(".landscape-img")
    // $(".landscape-img").each(function(e,i) {
        
    //         var height = $(i).height();
    //         var width = $(i).width();

    //         var percent = wHeight/height;
    //         // console.log(width  + " <= " + wWidth);
    //         if (width*percent <= wWidth) {
    //             $(i).css("height", wHeight);
    //             // console.log("height:");
    //         } else {
    //             $(i).css('width', wWidth);
    //             // console.log("width:" + width);
    //         }
    // });

    var wHeight = $(window).height();
    var wWidth = $(window).width();

    $(".landscape-img").css("max-height", wHeight);
    $(".slides").owlCarousel({
            navigation : true, // Show next and prev buttons
            slideSpeed : 300,
            paginationSpeed : 400,
            pagination : false,
            singleItem:true,
            fullWidth: true,

        });
    $(document).ready(function() {
        $(".slide").each(function(e, i) {
            var image = $(i).find(".popup-image-holder img");
            var imgHeight = image.height();
            var imgWidth = image.width();
            var tags = $(i).find(".tags");
            var tagHeight = tags.data("height");
            var tagWidth = tags.data("width");
            var percent = tagWidth/wWidth;
            var percentH = wHeight/tagHeight;
            console.log();
            if (image.hasClass("landscape-img")) {
                 if (tagWidth*percent <= wWidth) {
                    tags.css("height", wHeight);
                } else {
                    tags.css('width', wWidth);
                }
            } else {
                tags.css({height : wHeight, width : percentH*tagWidth});
            
            }
     if( $(window).width() <= 640 ) {
                    console.log("asd");
                    $(i).find(".popup-image-holder img").css({"top":"50%", "marginTop" : "-" + (imgHeight/2) + "px" });
                }
            
            // var imgH = $(i).find(".popup-image-holder img").height();
            // var imgW = $(i).find(".popup-image-holder img").width();
            $(i).find(".popup-image-holder img").on("load", function() {
                // var height = $(this).height();
                // var width = $(this).width();
                var height = $(this).height();
                var width = $(this).width();

                var percent = wHeight/height;
                if ($(this).hasClass("landscape-img")) {
                    
                    if (width*percent <= wWidth) {
                        $(this).css("height", wHeight);
                    } else {
                        $(this).css('width', wWidth);
                    }
                }
                var imgHeight = $(this).height();
                var imgWidth = $(this).width();
                $(i).find(".tags").css({height: imgHeight, width: imgWidth});
                if($(window).width() <= 640) {
                    $(i).find(".popup-image-holder img, .tags").css({"top":"50%", "marginTop" : "-" + (imgHeight/2) + "px" });
                    // $(i).find(".tags").css({"top":"50%", "marginTop" : "-" + (imgHeight/2) + "px" });
                }
                // console.log("SLIDE EACH " + imgHeight);
                //  console.log(imgWidth);
                
            }).each(function() {

              if(this.complete) {
                    $(this).load();
                }
            });
            // var height = image.height();
            // var width = image.width();

            // var percent = wHeight/height;
            
        });
        
        // $
    //  $(".similar-projects-slider").owlCarousel({
    //     navigation : true,
    //     slideSpeed : 300,
    //         addClassActive: true,
    //     paginationSpeed : 400,
    //     pagination : false,
    //     items : 4
    // });


    // $(".related-posts-slider").owlCarousel({
    //     navigation : true,
    //     slideSpeed : 300,
    //         addClassActive: true,
    //     paginationSpeed : 400,
    //     pagination : false,
    //     items : 4
    // });
    });
    
    </script>