$(document).ready(function() {
  $('.buttonsRegSelect').click(function () {
    var f = document.getElementsByClassName("form_register");
    for (i = 0; i < f.length; i++) {
      f[i].style.display = 'none';
    }
    var r=document.getElementsByClassName("buttonsRegSelected");
    for (i = 0; i < r.length; i++) {
      r[i].classList.remove('buttonsRegSelected');
    }
    $(this).addClass('buttonsRegSelected');
    id=$(this).attr('href');
    id=id.replace("#","");
    var e = document.getElementById(id);
    if(e.style.display == 'block')
      e.style.display = 'none';
    else
      e.style.display = 'block';
  });
  if ($(".msg_success")[0]) {
    r=document.getElementsByClassName('register');
    for (i = 0; i < r.length; i++) {
      r[i].childNodes[0].style.background="#cccccc";
      r[i].childNodes[0].readOnly = true;
    }
  }

  const realFileBtn = document.getElementById("entity_image");
  const customBtn = document.getElementById("entity_image_button");
  const customTxt = document.getElementById("entity_image_txt");

  customBtn.addEventListener("click", function(){
      realFileBtn.click();
  });

  realFileBtn.addEventListener("change",function(){
      if (realFileBtn.value){
          customTxt.innerHTML=realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
      } else {
          customTxt.innerHTML="No file chosen,yet";
      }
  });
});

function auto_click_provider() {
  $(document).ready(function() {
    var auto_click=document.getElementsByClassName("buttonsRegSelect");
    console.log(auto_click[0]);
    auto_click[0].click();
  });
}

function auto_click_client() {
  $(document).ready(function() {
    var auto_click=document.getElementsByClassName("buttonsRegSelect");
    console.log(auto_click[1]);
    auto_click[1].click();
  });
}
