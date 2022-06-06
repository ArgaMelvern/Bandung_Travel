var p = window.location.pathname;
var token = $("meta[name='mtoken']").attr("content");

function isLogin(){
  return token != '';
}

function isLandingPage(){
  return p.length === 0 || p === "/" || p.match(/^\/?index/)
}

var myInput = document.getElementById('myInput')

if (isLandingPage()){
  window.onscroll = function() {scrollFunction()};
}else{
  document.getElementById("navbar").style.backgroundColor = "white";
  document.getElementById("navbar-brand").style.color =  "black";
  if(!isLogin() && !isLandingPage()){
    document.getElementById("btn-modalLogin").classList.add('btn-outline-dark');
    document.getElementById("btn-modalRegister").classList.add('btn-outline-dark');
  }
  let item = document.getElementsByClassName("nav-link");
  for (let i = 0; i < item.length; i++) {
    item[i].style.color = "black";
  }
}

$('a[data-bs-toggle="modal"][data-bs-target]').click(function () {
    var target = $(this).attr('href');
    $('a[data-bs-toggle="tab"][data-bs-target="' + target + '"]').tab('show');
})

$('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
  $(this).removeClass('active');
})

function scrollFunction() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    document.getElementById("navbar").style.backgroundColor = "white";
    if(!isLogin() && isLandingPage()){
      document.getElementById("btn-modalLogin").classList.add('btn-outline-dark');
      document.getElementById("btn-modalLogin").classList.remove('btn-outline-light');
      document.getElementById("btn-modalRegister").classList.add('btn-outline-dark');
      document.getElementById("btn-modalRegister").classList.remove('btn-outline-light');
    }
    let item = document.getElementsByClassName("nav-link");
    for (let i = 0; i < item.length; i++) {
      item[i].style.color = "black";
    }
    document.getElementById("navbar-brand").style.color =  "black";
  } else {
    document.getElementById("navbar").style.backgroundColor = "rgba(0,0,0,0)";
    if(!isLogin() && isLandingPage()){
      document.getElementById("btn-modalLogin").classList.remove('btn-outline-dark');
      document.getElementById("btn-modalLogin").classList.add('btn-outline-light');
      document.getElementById("btn-modalRegister").classList.remove('btn-outline-dark');
      document.getElementById("btn-modalRegister").classList.add('btn-outline-light');
    }
    let item = document.getElementsByClassName("nav-link");
    for (let i = 0; i < item.length; i++) {
      item[i].style.color = "white";
    }
    document.getElementById("navbar-brand").style.color = "white";
  }
}

$(document).ready(function(){

}).on('click', '#btn-save', function(){
  let id = $(this).data('id');
  if (isLogin()){
    alert("simpan");
  }else{
    document.getElementById('btn-modalLogin').click();
  }
})
