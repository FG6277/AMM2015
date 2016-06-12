<h2> Bio </h2>
<div class="slider">
  <img class="slides" src="../images/slide/1.jpg" alt>
  <img class="slides" src="../images/slide/2.jpg" alt>
  <img class="slides" src="../images/slide/3.jpg" alt>
  <img class="slides" src="../images/slide/4.jpg" alt>
  <img class="slides" src="../images/slide/5.jpg" alt>
</div>
<script>
var index = 0;
slider();

function slider() {
    var i;
    var x = document.getElementsByClassName("slides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    index++;
    if (index > x.length) {index = 1}    
    x[index-1].style.display = "block";  
    setTimeout(slider, 2000); 
}
</script>
<div id ="bio">
<p>                        
    <i> 
        <strong>Become International Academy</strong>
        is an innovative language school
        dedicated to anyone who'd like to
        learn a new language and have fun.
        We have classes for people of any age,
        with related activities to do in company.
        In our school can also
        obtain international recognized certificates!
        You could attend any class, from basic level, to advanced levels! 
        Not only English, but also French,
        Spanish, German, Swedish, Russian,
        and even oriental languages as Arabic, Mandarin and Japanese !
        We also organize Italian classes for our
        foreign friends who wish to learn our language!
        What are you waiting for? Sign up and discover our classes and our offers!
    </i>
</p>
</div>