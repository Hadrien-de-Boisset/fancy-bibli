$(function() {

    $("li>ol").hide();

    $(".unroll").on("click", function(event) {

        event.stopPropagation();

        $(".visible").off("click", blockProgression)

        let depth = $(this).data("depth");

        let trigeredSlide = $(this).children("ol:first-of-type")

        $("li[data-depth='" + (depth) + "']>ol").not(trigeredSlide).slideUp();
        $("li[data-depth='" + (depth) + "']>ol").not(trigeredSlide).removeClass("visible")

        console.log("li[data-depth='" + (depth) + "']>ol");

        trigeredSlide.slideToggle();
        trigeredSlide.addClass("visible");
        $(".visible").on("click", blockProgression)
    })

    function blockProgression(event) {

        event.stopPropagation();

    };

});
