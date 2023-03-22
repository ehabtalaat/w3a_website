"use strict";
function dragNdrop(event) {
    // var fileName = URL.createObjectURL(event.target.files[0]);
    // var preview =  document.getElementById("preview");
    // var previewImg = document.createElement("img");
    // previewImg.setAttribute("src", fileName);
    // preview.innerHTML = "";
    // preview.appendChild(previewImg);
    var file = event.target.files[0];
    var preview = event.target.parentNode.parentNode.nextElementSibling;
  
    if (file.type.match('image.*')) {
      var reader = new FileReader();
      reader.onload = function(e) {
        preview.innerHTML = '';
        var img = new Image();
        img.src = e.target.result;
        img.className = 'preview-image';
        preview.appendChild(img);
      }
      reader.readAsDataURL(file);
    } else {
      preview.innerHTML = 'File type not supported.';
    }
}
function drag() {
    document.getElementById('uploadFile').parentNode.className = 'draging dragBox';
}
function drop() {
    document.getElementById('uploadFile').parentNode.className = 'dragBox';
}
function dragNdrop1(event) {
    var fileName = URL.createObjectURL(event.target.files[0]);
    var preview =  document.getElementById("preview1");
    var previewImg = document.createElement("img");
    previewImg.setAttribute("src", fileName);
    preview.innerHTML = "";
    preview.appendChild(previewImg);
}

// $('body').on('change', '.image_file', function(e) {
//     console.log($(this).val());
//     var fileName = URL.createObjectURL(e.target.files[0]);
//     var  preview = $(this).parent().closest('#preview');
//     consele.log(preview)
//     var previewImg = document.createElement("img");
//     previewImg.setAttribute("src", fileName);
//  //   preview.innerHTML = "";
//     preview.append(previewImg);
// });