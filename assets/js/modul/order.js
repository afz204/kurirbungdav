function selectFlorist(trx) {
    $('#selectFlorist').modal({ show: true, backdrop: 'static', keyboard: false });
    $('[name="IDSelectedFlorist"]').val(trx);
}

function selectKurir(trx) {
    $('#selectKurir').modal({ show: true, backdrop: 'static', keyboard: false });
    $('[name="IDSelectedKurir"]').val(trx);
}

function changeOrderStatus(status, trx, type) {
    $.ajax({
        url: '../php/ajax/order.php?type=changeOrderStatus',
        type: 'post',
        data: 'status=' + status + '&transctionID=' + trx + '&types=' + type,

        success: function(msg) {
            alert(msg);
            location.reload();
        }
    });
}

function proccessOrder(trx) {
    if (!confirm('Are you sure done with this?')) {
        return false;
    } else {
        $.ajax({
            url: '../php/ajax/order.php?type=proccessOrder',
            type: 'post',
            data: { transctionID: trx },

            success: function(msg) {
                alert(msg);
                window.location.href = '?p=order';
            }
        });
    }
}

function selectPayment(trx, id) {
    if (!confirm('Are you sure want to use this?')) {
        return false;
    } else {
        $.ajax({
            url: '../php/ajax/order.php?type=PaymentSelected',
            type: 'post',
            data: { transctionID: trx, paymentID: id },

            success: function(msg) {
                alert(msg);
                $('#btnProccessOrder').removeClass('hidden').fadeIn(1000);
            }
        });
    }
}

function btnProccessOrder(id) {

}

function dataCheckout(data) {
    //console.log(data);
    $.ajax({
        url: '../php/ajax/order.php?type=listCheckout',
        type: 'post',
        data: { transctionID: data },

        success: function(msg) {
            var data = JSON.parse(msg);
            //console.log(data);
            var listProduct = $('#checkoutData').html(" ");
            listProduct.hide().html(data.product).fadeIn(1000);
        }
    });
}

function changeQtyProduct(id, field, type, count, trx) {
    var input = $("input[name='" + id + "']");
    var currentVal = parseInt(input.val());
    //alert(currentVal);
    $.ajax({
        url: '../php/ajax/order.php?type=changeQty',
        type: 'post',
        data: 'id=' + type + '&types=' + field + '&count=' + count,

        success: function(msg) {
            //console.log(trx);
            dataCheckout(trx);
        }
    });
}

function modalListProduct() {
    $('#modalAddProducts').modal({ backdrop: 'static', keyboard: false });
}

function formRedeemPromo() {
    $('#linkRedem').addClass('hidden');
    $('#redeemPromo').removeClass('hidden').fadeIn(700);
}

function formAddProduct() {
    $('#addProductCheckout')[0].reset();
    $('#codeSearch').removeClass('parsley-success');
    $('#checkProduct').html('');
    $('#checkProduct').html('<button type="submit"  class="btn btn-block btn-primary ">submit</button>');
}

function formValidate(id) {
    var trx = $('#nomorTrx').val();

    if (id == 0) {
        var corp = $('#listCorporate option:selected').val();
        var cpic = $('#listPicCorp option:selected').val();
        var namepic = $('#listPicCorp option:selected').data('name');

        $.ajax({
            url: '../php/ajax/order.php?type=step1',
            type: 'post',
            data: { TransactionID: trx, CustomerID: corp, picID: cpic, namePic: namepic },

            success: function(msg) {
                alert(msg);
            }
        });
    };
    if (id == 1) {
        var receiveName = $('#nama_penerima').val();
        var receiveEmail = $('#email_penerima').val();
        var receiveProvinsi = $('#ProvinsiCorporate').val();
        var receiveKota = $('#KotaCorporate').val();
        var receiveKec = $('#kecamatanCorporate').val();
        var receiveKel = $('#kelurahanCorporate').val();
        var receiveAlamat = $('#alamat_lengkap').val();

        $.ajax({
            url: '../php/ajax/order.php?type=step2',
            type: 'post',
            data: {
                Name: receiveName,
                Email: receiveEmail,
                Provinsi: receiveProvinsi,
                Kota: receiveKota,
                Kec: receiveKec,
                Kel: receiveKel,
                Alamat: receiveAlamat,
                TransactionID: trx
            },

            success: function(msg) {
                alert(msg);
            }
        });
    };
    if (id == 2) {
        var charge = $('#delivery_charges option:selected').val();
        var dates = $('#delivery_dates').val();
        var times = $('#time_slot option:selected').val();
        var remarks = $('input[name=radio-remarks]:checked').val();

        $.ajax({
            url: '../php/ajax/order.php?type=step3',
            type: 'post',
            data: {
                TransactionID: trx,
                deliverCharge: charge,
                deliveryDate: dates,
                deliveryTimes: times,
                deliveryRemarks: remarks
            },

            success: function(msg) {
                alert(msg);
            }
        });
    };
    if (id == 3) {
        var from = $('#from').val();
        var to = $('#to').val();
        var msg = $('#isi_pesan').val();
        var level1 = $('#template_level1 option:selected').data('name');
        var level2 = $('#template_level2 option:selected').data('name');

        $.ajax({
            url: '../php/ajax/order.php?type=step4',
            type: 'post',
            data: {
                TransactionID: trx,
                from: from,
                to: to,
                msg: msg,
                level1: level1,
                level2: level2
            },

            success: function(msg) {
                alert(msg);
            }
        });
    };

    //for submit ajax check
    //$('#step_number').val();
}
$(window).load(function() {
    // Run code
    $('#SmartWizard').hide().fadeIn(1000);
});
$(document).ready(function() {
    // $('#delivery_charges').select2();

    $('#template_level1').select2({ width: '100%', theme: "bootstrap4" });
    $('#template_level2').select2({ width: '100%', theme: "bootstrap4" });
    $('#ListSelectedFlorist').select2({ width: '100%', theme: "bootstrap4" });
    $('#ListSelectedKurir').select2({ width: '100%', theme: "bootstrap4" });
    $('#tableOrder').DataTable();

    $('.AddDeliveryChargesClass').on('change', function() { // on change of state
        var value = $('#delivery_charges option:selected').data('price');
        if (this.checked) // if changed state is "CHECKED"
        {
            $('#delivery_charges_values').val(value);
            $('#manual_delivery_charges').removeClass('hidden');
        } else {
            if (!confirm('Are you Sure ?')) {
                return false;
            } else {
                $('#manual_delivery_charges').addClass('hidden');
            }
        }
    });

    $('.delivery_charges_values_btn').on('click', function(e) {
        e.preventDefault();

        var id = $(this).data('trx');
        var price = $('#delivery_charges_values').val();

        if ($.isNumeric(price)) {
            $.ajax({
                url: '../php/ajax/order.php?type=addDeliveryCharges',
                type: 'post',
                data: { transctionID: id, transctionPrice: price },

                success: function(msg) {
                    alert(msg);
                    dataCheckout(id);
                }
            });
        } else {
            alert('This Should Numeric Type!');
        }
    });

    $('#delivery_dates').datetimepicker({

        format: 'YYYY/MM/DD',
        minDate: new Date()

    });

    $('#template_level1').on('change', function(e) {
        e.preventDefault();
        var id = $(this).find("option:selected");
        var value = id.val();
        var text = id.text();

        $.ajax({
            url: '../php/ajax/order.php?type=cardTemplate',
            type: 'post',
            data: 'id=' + value,

            success: function(msg) {

                $('#template_level2').empty();
                $('#isi_pesan').empty();

                $.each(msg, function(a, b) {
                    $('#template_level2').append('<option data-msg="' + b.level3 + '" data-name="' + b.level1 + '" value="' + b.id + '">' + b.level1 + '</option>');
                    $('#isi_pesan').val(b.level3);
                    $('#template_level2').on('change', function(e) {
                        e.preventDefault();
                        var id = $(this).find("option:selected");
                        var value = id.val();
                        var text = id.text();
                        var msgg = id.data('msg');

                        $('#isi_pesan').val(msgg);
                    });
                });

                // $.each(msg, function(index, value) {
                //     $('#template_level2').append('<option value="' + value.id + '">' + value.level1 + '</option>');
                //     $('#isi_pesan').val(value.level3);

                // });


            }
        });
    });



    $('#kelurahanCorporate').on('change', function(e) {
        e.preventDefault();
        var id = $(this).find("option:selected");
        var value = id.val();
        var text = id.text();

        $.ajax({
            url: '../php/ajax/order.php?type=deliveryCharges',
            type: 'post',
            data: 'id=' + value,

            success: function(msg) {
                console.log(msg);
                $('#delivery_charges').empty();


                $('#delivery_charges').append('<option value="' + msg.id + '" data-price="' + msg.delivery_charges + '">' + msg.kelurahan + ' ' + msg.price + ' </option>');

            }
        });
    });


    $('#generateOrder').on('submit', function(e) {
        e.preventDefault();
        var type = $('#typeOrder option:selected').val();

        $.ajax({
            url: '../php/ajax/order.php?type=generate',
            type: 'post',
            data: 'type=' + type,

            success: function(msg) {
                if (type === '1') {

                    alert('Anda Memilih Corporate!');
                    var newLocation = '?p=neworder&trx=' + msg;
                    window.location = newLocation;
                    return false;

                } else {
                    alert('Anda Memilih Personal!');
                    var newLocation = '?p=neworder&trx=' + msg;
                    window.location = newLocation;
                    return false;
                }

            }
        });

    });

    $('#redeemPromo').on('submit', function(e) {
        e.preventDefault();
        var isFormValid = true;

        $("#codePromoInput").each(function() {
            if ($.trim($(this).val()).length == 0) {
                $(this).addClass("is-invalid");
                $('#validation-feedback').addClass('invalid-feedback').html('Tidak boleh kosong!');
                isFormValid = false;
            } else {
                $(this).removeClass("is-invalid");
                $(this).addClass("is-valid");
                $('#validation-feedback').removeClass('invalid-feedback');
                $('#validation-feedback').addClass('valid-feedback').html('Checking!');
            }
        });
    });
    $('#formSelectFlorist').on('submit', function(e) {
        e.preventDefault();
        var trx = $('[name="IDSelectedFlorist"]').val();
        var id = $('#ListSelectedFlorist option:selected').val();

        $.ajax({
            url: '../php/ajax/order.php?type=selectFlorist',
            type: 'post',
            data: 'transctionID=' + trx + '&floristID=' + id,
            success: function(msg) {
                alert(msg);
                location.reload();
            }
        });

    });

    $('#formSelectKurir').on('submit', function(e) {
        e.preventDefault();
        var trx = $('[name="IDSelectedKurir"]').val();
        var id = $('#ListSelectedKurir option:selected').val();

        $.ajax({
            url: '../php/ajax/order.php?type=selectKurir',
            type: 'post',
            data: 'transctionID=' + trx + '&KurirID=' + id,
            success: function(msg) {
                alert(msg);
                location.reload();
            }
        });

    });

    //button plus minuts product

    $(document).on('click', '.btn-number-count', function(e) {
        e.preventDefault();

        var field = $(this).data('field');
        var id = $(this).data('id');
        var type = $(this).data('type');
        var trx = $(this).data('trx');
        var input = $("input[name='" + field + "']");
        var currentVal = parseInt(input.val());
        //alert(trx);
        if (!isNaN(currentVal)) {
            if (type == 'minus') {
                var count = currentVal - 1;
                changeQtyProduct(id, type, field, count, trx);
                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {
                var count = currentVal + 1;
                changeQtyProduct(id, type, field, count, trx);
                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function() {
        $(this).data('oldValue', $(this).val());
    });
    $(document).on('change', '.input-number', function() {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number-count[data-type='minus']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number-count[data-type='plus']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });

    $(document).on('keydown', '.input-number', function(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    //ends buttton plus minus product

    //add procuts
    $('#addProductCheckout').on('submit', function(e) {
        e.preventDefault();
        btn_submit('checkProduct');
        var code = $('#codeSearch').val();
        var trx = $('#noTransaction').val();

        $.ajax({
            url: '../php/ajax/order.php?type=addProducts',
            type: 'post',
            data: 'id=' + code + '&trx=' + trx,

            success: function(msg) {
                dataCheckout(trx);
                var data = JSON.parse(msg);
                console.log(data);
                var count = parseInt(data.qty);
                $('#listProductsData').hide().append(data.data).fadeIn('fast');
                $('#countProduct').hide().html(count).fadeIn(800);

            }
        });
    });
    //modal add product close
    $('#modalAddProducts').on('hidden.bs.modal', function() {
        // do something…
        formAddProduct();
    });
    $(document).on('click', '.selling_price_btn', function(e) {
        e.preventDefault();

        var btnName = $(this).data('id');
        var trx = $(this).data('trx');
        var input = $("input[name='" + btnName + "']");
        var currentVal = parseInt(input.val());
        //alert(trx);
        if ($.isNumeric(currentVal) == true) {

            if (!confirm('Are you want to change price?')) {
                return false;
            } else {

                $.ajax({
                    url: '../php/ajax/order.php?type=changePriceProduct',
                    type: 'post',
                    data: 'id=' + btnName + '&new_price=' + currentVal,

                    success: function(msg) {
                        var data = JSON.parse(msg);
                        alert(data.msg);
                        var price = parseInt(data.price);
                        //location.reload();
                        //console.log(price);
                        input.attr('value', price);

                        dataCheckout(trx);

                    }
                });
            }
        } else {
            alert('Error!');
        }

        // if(! confirm('Are you want to change price?')){
        //     return false;
        // }else{


        //     $.ajax({
        //         url: '../php/ajax/order.php?type=changePriceProduct',
        //         type: 'post',
        //         data: 'id=' + btnName + '&new_price=' + currentVal,

        //         success: function(msg) {
        //             alert(msg);
        //             location.reload();
        //         }
        //     });
        // }

    });
    $(document).on('click', '.isi_remarks_btn', function(e) {
        e.preventDefault();

        var btnName = $(this).data('id');
        var input = $("textarea[name='" + btnName + "']");
        var currentVal = input.val();

        if (currentVal != '') {
            if (!confirm('Are you want to add Remarks?')) {
                return false;
            } else {


                $.ajax({
                    url: '../php/ajax/order.php?type=addRemarksProduct',
                    type: 'post',
                    data: 'id=' + btnName + '&remarks=' + currentVal,

                    success: function(msg) {
                        alert(msg);
                        //input.val(msg);
                        //location.reload();
                    }
                });
            }
        } else {
            alert('Error!');
        }
    });

    //delete product

    $(document).on('click', '.deleteListProduct', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var trx = $(this).data('trx');

        if (!confirm('Are you sure want to delete?')) {
            return false;
        } else {
            $.ajax({
                url: '../php/ajax/order.php?type=deleteProduct',
                type: 'post',
                data: { dataID: id },

                success: function(msg) {
                    alert(msg);
                    $('#ListProduct-' + id).remove();
                    dataCheckout(trx);
                }
            });
        }
    });

    $('#changeOrderStatus').on('change', function(e) {
        e.preventDefault();

        var data = $(this).find(':selected');

        var id = data.val();
        var trx = data.data('trx');

        if (!confirm('Are you sure want move to Production ?')) {
            return false;
        } else {
            changeOrderStatus(id, trx, 'florist');
        }
    });

})