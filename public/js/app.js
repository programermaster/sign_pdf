 $(document).ready(function(){

    var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
      backgroundColor: 'rgba(255, 255, 255, 0)',
      penColor: 'rgb(0, 0, 0)'
    });

     $("form").submit(function (evt) {
          $("#signature64").text(signaturePad.toDataURL());

     });
});

