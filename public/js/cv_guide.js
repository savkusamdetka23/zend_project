var timeout    = 500;
var closetimer = 0;
var ddmenuitem = 0;

function jsddm_open()
{  jsddm_canceltimer();
    jsddm_close();
    ddmenuitem = $(this).find('ul').css('visibility', 'visible');}

function jsddm_close()
{  if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

function jsddm_timer()
{  closetimer = window.setTimeout(jsddm_close, timeout);}

function jsddm_canceltimer()
{  if(closetimer)
{  window.clearTimeout(closetimer);
    closetimer = null;}}

$(document).ready(function(){
    var cv_guide = {

        loadMenu : function() {

            $('#main_manu > li').bind('mouseover', jsddm_open)
                $('#main_manu > li').bind('mouseout',  jsddm_timer);

            document.onclick = jsddm_close;

        },
      loadPage : function() {
        var myParam = location.search.split('dataLoad=')[1];
        if (myParam) {
            $("a[href=" + myParam + "]").click();
        }
      },
      initializeSubMenu : function() {
          var subMenu = $(".sub_menu > li > a");
          subMenu.each( function( index, element ) {
                  $(this).click(function(e) {

                      if (window.location.href.indexOf(this.getAttribute("href")) == -1) {
                          window.location = this.getAttribute("href")+ "?dataLoad=" + $(this).data("href");
                      }
                      var href = $(this).data("href");
                      $("a[href=" + href + "]").click();
                      return false;
                  });
          });
      },
      loadEstablishments : function() {
          var establishmentloading = $(".establishmentloading > li > a");
          var disabled = false;
          establishmentloading.each( function( index, element ) {
              $(this).click(function(e) {
                  if (disabled) {
                      e.preventDefault();
                  } else {
                      disabled = true;
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
                          scroll  : true, // The main bit, if set to false posts will not load as the user scrolls.
                          // but will still load if the user clicks.
                          success : function() { // Used to enable links after content loading
                              disabled = false;
                          }

                      });
                      $(this).tab('show');

                      //$(this).data("offset",5);
                      return false;
                  }
              });

          });
      }
    };
    cv_guide.loadEstablishments();
    cv_guide.initializeSubMenu();
    cv_guide.loadMenu();
    cv_guide.loadPage();

});
