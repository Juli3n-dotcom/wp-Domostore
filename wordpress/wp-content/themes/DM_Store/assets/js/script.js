$(document).ready(function(){
  $('.menu-btn').click(function(){
    $('.navbar').slideToggle(500);
  })
  // $('.menu-btn').click(function(){
  //   $('.header').toggleClass('white');
  //   $('#responsive_cart').toggleClass('black');
  // })
});

$(document).ready(function(){
  $('.search_click').click(function(){
    $('.search_container').slideToggle(500);
  })
});

$('.menu-icon').click(function(){
  $('.nav-icon-1').toggleClass('active')
  $('.nav-icon-2').toggleClass('active')
  $('.nav-icon-3').toggleClass('active')
});

$('.back_to_top a').on('click', function(e){
  if(this.hash !== ''){ 
    e.preventDefault();
    const hash = this.hash;

    $('html, body').animate({
      scrollTop : $(hash).offset().top
    }, 800);
  }
});

document.querySelector('.panier').addEventListener('click',()=>{
  document.querySelector('.panier_sidebar').classList.add('active');
  document.getElementById('main').classList.add('active');
});

document.querySelector('.panier_close').addEventListener('click',()=>{
document.querySelector('.panier_sidebar').classList.remove('active');
document.getElementById('main').classList.remove('active');
});

document.getElementById('main').addEventListener('click',()=>{
  document.querySelector('.panier_sidebar').classList.remove('active');
  document.getElementById('main').classList.remove('active');

  });

 document.querySelector('.menu_filter_open').addEventListener('click',()=>{
    document.querySelector('.responsive_sidebar').classList.add('active');
 });

 document.querySelector('.responsive_close').addEventListener('click',()=>{
  document.querySelector('.responsive_sidebar').classList.remove('active');
 });

 

window.sr = ScrollReveal();
sr.reveal('.title_page h2',{
  duration : 2000,
  origin : 'bottom',
  distance : '50px'
})
sr.reveal('.sidebar',{
  duration : 2000,
  origin : 'left',
  distance : '50px'
})
sr.reveal('.type-product',{
  duration : 2000,
  origin : 'bottom',
  distance : '50px'
})
sr.reveal('.title_404',{
    duration : 3000,
    origin : 'bottom',
    distance : '50px'
})
sr.reveal('.text_404',{
  duration : 3000,
  origin : 'bottom',
  distance : '50px'
})
sr.reveal('.ligne_404',{
  duration : 3000,
  origin : 'bottom',
  distance : '50px'
})
sr.reveal('.back_to_home_404',{
  duration : 3000,
  origin : 'bottom',
  distance : '50px'
})
sr.reveal('.filter',{
  duration : 2000,
  origin : 'left',
  distance : '50px'
})





