</div>
</div>
<!--content-->
<div id="preloader"><lottie-player 
    src="{{asset('lotti/loader.json')}}"  background="transparent"  speed="1"  style="width: 200px; height: 400px;"  loop  autoplay></lottie-player></div>
</div>
</main>
@include("layouts.admin_includes.messages")
<style>
       #preloader {
  /* background-image: url('../lf30_editor_vltgu0mr.json'); */
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  background-color: #fff;
  background-size: 50%;
  height: 100vh;
  width: 100%;
  position: fixed;
  z-index: 1000;
} 
</style>

    <script>
          let loader = document.getElementById('preloader');
window.addEventListener('load', function () {
  loader.style.display = 'none';
});
var loader1 = document.getElementById('preloader');
   $("form").on("submit", function(){
    
  //e.preventDefault();
  loader1.style.display = 'flex';
 
});
$(".side_btn").click(function(){
  $("#aside").toggle();
});
    </script>
@yield("scripts")
</body>
</html>