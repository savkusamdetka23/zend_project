$(document).ready(function(){

    var cv_guide = {
      loadEstablishments : function() {
          var establishmentloading = $(".establishmentloading > a");
          establishmentloading.each( function( index, element ) {
              $(this).click(function() {
                // $(".estcontent").load($(this).attr("href"));
                  $(".estcontent").html("");
                  $(".estcontent").scrollPagination({

                      nop     : 5, // The number of posts per scroll to be loaded
                      url     : $(this).attr("href"),
                      offset  : 0, // Initial offset, begins at 0 in this case
                      error   : 'No More Posts!', // When the user reaches the end this is the message that is
                      // displayed. You can change this if you want.
                      delay   : 1000, // When you scroll down the posts will load after a delayed amount of time.
                      // This is mainly for usability concerns. You can alter this as you see fit
                      scroll  : true // The main bit, if set to false posts will not load as the user scrolls.
                      // but will still load if the user clicks.

                  });

                  //$(this).data("offset",5);
                  return false;
              });
          });
      }
    };
    cv_guide.loadEstablishments();
});
