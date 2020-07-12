$(document).ready(function(){
// start makeing barcode and printing it ===================================>
$('#printbarcode').click(function(e){
    e.preventDefault();
    var barcode=$('.barcode').val();
    $.ajax({
        url: "/js/barcodelib/barcode.php",
        method: "POST",
        data: {barcode:barcode},
        success: function (data) {
            $('#containerbarcode').html('');
            $('#containerbarcode').html(data);
            $("#containerbarcode").printArea();
            $("#containerbarcode").html('');
        }
    });
});
//end making barcode and printing it ===========>

// start makeing barcode and printing it ===================================>
$('#showprintbarcode').click(function(){
    var Barcode=$('#barcode').html(),
        name=$('#name').html(),
        sellPrice=$('#sellPrice').html();
    $.ajax({
        url: "/js/barcodelib/barcode.php",
        method: "POST",
        data: {Barcode:Barcode,name:name,sellPrice:sellPrice},
        success: function (data) {
            $('#containerbarcode').html('');
            $('#containerbarcode').html(data);
            $("#containerbarcode").printArea();
            $("#containerbarcode").html('');
        }
    });
});
//end making barcode and printing it in show ===========>
});