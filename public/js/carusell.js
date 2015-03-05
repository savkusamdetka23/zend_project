$('#carouselshowmanymoveone').carousel({
  interval: 4000
})

$('#carouselshowmanymoveone .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().addClass("extra1").appendTo($(this));
  
  for (var i=0;i<2;i++) {
    next=next.next();
    if (!next.length) {
    	next = $(this).siblings(':first');
  	}
    
    next.children(':first-child').clone().addClass("extra"+(i+2)).appendTo($(this));
  }
});