$(function() {
    if(Modernizr.history){

        var newHash      = "",
            $con = $("#main-page"),
            $mainBody    = $("#mainBody"),
            baseHeight   = 0,
            $el;
            
        $mainBody.height($mainBody.height());
        baseHeight = $mainBody.height() - $con.height();
        
        $(".nav").delegate("a", "click", function() {
            _link = $(this).attr();
            history.pushState(null, null, _link);
            loadContent(_link);
            return false;
        });

        function loadContent(href){
            $con
                    .find("#main-content")
                    .fadeOut(200, function() {
                        $con.hide().load(href + " #main-content", function() {
                            $con.fadeIn(200, function() {
                                $mainBody.animate({
                                    height: baseHeight + $con.height() + "px"
                                });
                            });
                            $(".nav li a").removeClass("active");
                            console.log(href);
                            $(".nav li a[href="+href+"]").addClass("active");
                        });
                    });
        }
        
        $(window).bind('popstate', function(){
           _link = location.pathname.replace(/^.*[\\\/]/, ''); //get filename only
           loadContent(_link);
        });

    } // otherwise, history is not supported, so nothing fancy here.

    
});