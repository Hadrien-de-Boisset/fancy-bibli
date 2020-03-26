$(function() {

    $("li>ol").hide();

    $(".unroll").on("click", function(event) {

        event.stopPropagation();

        $(".visible").off("click", blockProgression)

        let depth = $(this).data("depth");

        let trigeredSlide = $(this).children("ol:first-of-type");
        let competitorSlides = $("li[data-depth='" + (depth) + "']>ol").not(trigeredSlide);

        competitorSlides.removeClass("visible");
        competitorSlides.slideUp();

        console.log("li[data-depth='" + (depth) + "']>ol");

        trigeredSlide.toggleClass("visible");
        trigeredSlide.slideToggle();

        //open or close folder icon//
        $(this).find(">:first-child>i").toggleClass('fa-folder-open');
        $(this).find(">:first-child>i").toggleClass('fa-folder');
        $("li[data-depth='" + (depth) + "']").not($(this)).find(">:first-child>i.fa-folder-open").addClass('fa-folder');
        $("li[data-depth='" + (depth) + "']").not($(this)).find(">:first-child>i.fa-folder-open").removeClass('fa-folder-open');


        //These are for the mobile theme only//
        $(this).find(">:first-child").toggleClass('in-file');
        toggleBackGroundColor($(this));
        toggleBackGroundColor($("li[data-depth='" + (depth) + "']").not($(this)));
        $("li[data-depth='" + (depth) + "']").not($(this)).find(">:first-child").removeClass('in-file');
        // End of mobilr only stuff//

        $(".visible").on("click", blockProgression)
    })

    function toggleBackGroundColor(object) {

        if (object.find(">ol:first-of-type").hasClass('visible')) {
            console.log("ol actif")
            if (object.data("depth") % 2 == 0) {
                object.removeClass("parent-background");
                object.addClass("dark");
                console.log("active, set to dark");
            }
            else {
                object.removeClass("parent-background");
                object.addClass("light");
                console.log("active, set to light");
            }
        }
        else {
            object.removeClass("dark");
            object.removeClass("light");
            object.addClass("parent-background");
        }
    }

    function blockProgression(event) {

        event.stopPropagation();

    };

});
