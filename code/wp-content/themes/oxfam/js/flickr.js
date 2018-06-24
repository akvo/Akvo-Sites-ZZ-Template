function showpics() {
    var a = $("#box").val();
    $.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?tags=" + a + "&tagmode=any&format=json&jsoncallback=?", function(a) {
        $("#images").hide().html(a).fadeIn("fast"), $.each(a.items, function(a, e) {
            $("<img/>").attr("src", e.media.m).appendTo("#images")
        })
    })
}
