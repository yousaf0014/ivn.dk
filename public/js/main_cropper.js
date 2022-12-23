$(function () {
  'use strict';
  var URL = window.URL || window.webkitURL;
  var $image = $('#image');
  var $dataX = $('#dataX');
  var $dataY = $('#dataY');
  var $dataHeight = $('#dataHeight');
  var $dataWidth = $('#dataWidth');
  var $dataRotate = $('#dataRotate');
  var $dataScaleX = $('#dataScaleX');
  var $dataScaleY = $('#dataScaleY');
  var options = {
        aspectRatio: 1/1,
        preview: '.img-preview',
        crop: function (e) {
          $dataX.val(Math.round(e.detail.x));
          $dataY.val(Math.round(e.detail.y));
          $dataHeight.val(Math.round(e.detail.height));
          $dataWidth.val(Math.round(e.detail.width));
          $dataRotate.val(e.detail.rotate);
          $dataScaleX.val(e.detail.scaleX);
          $dataScaleY.val(e.detail.scaleY);
        }
      };
  var originalImageURL = $image.attr('src');
  
  // Cropper
  $image.on().cropper(options);

  // Methods
  // Keyboard
  $(document.body).on('keydown', function (e) {

    if (!$image.data('cropper') || this.scrollTop > 300) {
      return;
    }

    switch (e.which) {
      case 37:
        e.preventDefault();
        $image.cropper('move', -1, 0);
        break;

      case 38:
        e.preventDefault();
        $image.cropper('move', 0, -1);
        break;

      case 39:
        e.preventDefault();
        $image.cropper('move', 1, 0);
        break;

      case 40:
        e.preventDefault();
        $image.cropper('move', 0, 1);
        break;
    }

  });


// Import image
  var $inputImage = $('#profilePic');

    $inputImage.change(function () {
      var files = this.files;
      var file;

      if (!$image.data('cropper')) {
        return;
      }

      if (files && files.length) {
        file = files[0];

        if (/^image\/\w+$/.test(file.type)) {
          uploadedImageName = file.name;
          uploadedImageType = file.type;

          uploadedImageURL = URL.createObjectURL(file);
          alert(uploadedImageURL)
          $image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
          
        } else {
          window.alert('Please choose an image file.');
        }
      }
    });  
});
