function aceptedreject(type, trx) {
    $.ajax({
        url: 'php/ajax/kurirs.php?type=aceptedreject',
        method: 'post',
        data: { 'TransactionID': trx, 'Types': type },

        success: function(msg) {
            location.reload();
            alert(msg);
        }
    })
}

$(document).ready(function() {
    $("#images").fileinput({
        //'theme': 'explorer-fa',
        theme: 'fa',
        overwriteInitial: false,
        initialPreviewAsData: true,
        maxFilePreviewSize: 60,
        previewFileType: "image",
        allowedFileExtensions: ["jpg"],
        uploadAsync: false,
        minFileCount: 1,
        maxFileCount: 1,
        uploadUrl: '../php/ajax/uploadImagesProduct.php',
        uploadExtraData: function() {
            return {
                imagesid: $('#ImagesProductID').val(),
                imagesname: $('#ImagesName').val(),
                urlserver: $('#urlserver').val()
            };
        }
    }).on('fileloaded', function(event, file, previewId, index, reader) {
        console.log("fileloaded");
    }).on('filebatchuploadsuccess', function(event, data) {
        // var buttonSuccessProduct = $('<button class="btn btn-block btn-link">Done !</button>');
        // // $.each(data.files, function(key, file) {
        // //     var fname = file.name;
        // //     out = out + '<li>' + 'Uploaded file # ' + (key + 1) + ' - '  +  fname + ' successfully.' + '</li>';
        // // });
        // $('#kv-success-2').append(buttonSuccessProduct);
        // $('#kv-success-2').fadeIn('slow');
    });

    $('#formreturn').on('submit', function(e) {
        e.preventDefault();

        var TransactionID = $('#transactionID').val();
        var reason = $('#alasanreturn').val();

        $.ajax({
            url: '../php/ajax/kurirs.php?type=returnform',
            method: 'post',
            data: { 'TransactionID': TransactionID, 'alasan': reason },

            success: function(msg) {
                location.reload();
                alert(msg);
            }
        })
    });
})