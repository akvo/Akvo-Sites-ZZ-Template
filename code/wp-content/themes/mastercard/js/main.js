/****Header3 Scroll Toggle****/
jQuery(window).scroll(function(){
  jQuery('.header4 nav').toggleClass('scrolled', $(this).scrollTop() > 5);
});
