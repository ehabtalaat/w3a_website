//=========== Active navbar Link in multi pages =============
const currentLocation = location.href;
const menuItem = document.querySelectorAll(".navbar .navbar-nav .nav-link");
const menuLength = menuItem.length;
for (let i = 0; i < menuLength; i++) {
  if (menuItem[i].href === currentLocation) {
    menuItem[i].className = "nav-link active";
  }
}


        $(":file").change(function () {
        $('#row').empty();
        if (this.files && this.files[0]) {
            for (var i = 0; i < this.files.length; i++) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[i]);
            }
        }
    });


    function imageIsLoaded(e) {

        $('#row').append('<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 d-flex align-items-center"><figure class="imghvr-fade"><img style="width:100px;height:100px;"src=' + e.target.result + '></figure></div>');
    }


    

//=========== Active navbar Link in multi pages =============