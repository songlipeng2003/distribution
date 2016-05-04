$(function(){
    // 省市区三级联动
    $.getJSON('/regions/1/children', function(data){
        $.each(data, function(i, e){
            $('#province_id').append("<option value='"+e.id+"''>"+e.name+"</option>");
        });
    });

    $('#province_id').change(function(){
        val = $(this).val();
        $('#city_id').html(' <option value="">请选择</option>');
        $('#region_id').html(' <option value="">请选择</option>');
        if(val!=''){
            $.getJSON('/regions/'+val+'/children', function(data){
                $.each(data, function(i, e){
                    $('#city_id').append("<option value='"+e.id+"''>"+e.name+"</option>");
                });
            });
        }
    });

    $('#city_id').change(function(){
        val = $(this).val();
        $('#region_id').html(' <option value="">请选择</option>');
        if(val!=''){
            $('#region_id').html(' <option value="">请选择</option>');
            $.getJSON('/regions/'+val+'/children', function(data){
                $.each(data, function(i, e){
                    $('#region_id').append("<option value='"+e.id+"''>"+e.name+"</option>");
                });
            });
        }
    });

    // 购买数量
    var number = $('#quantity').val();
    $('#op_plus').click(function(){
        number++;
        updateNumber();
    });

    $('#op_minus').click(function(){
        number--;
        number = number<1 ? 1 : number;
        updateNumber();
    });

    function updateNumber(){
        $('[data-number]').text(number);
        $('#quantity').val(number);

        var price = $('[data-price]').data('price');
        price = Number.parseInt(price);

        var totalPrice = price*number;
        $('[data-total-price]').text(totalPrice);
    }

    $('#checkout_form').validate({
        showErrors: function(errorMap, errorList) {   
            // var msg = "";
            // $.each( errorList, function(i,v){   
            //   msg += (v.message+"\r\n");   
            // });
            // if(msg!="") alert(msg);
            if(errorList.length>0){
                alert(errorList[0].message);
            }
        },
        messages: {
            'QuickCheckoutForm[name]' : {
                'required': '收货人必须填写'
            },
            'QuickCheckoutForm[phone]' : {
                'required': '电话必须填写',
                'minlength': '电话必须是11位',
                'maxlength': '电话必须是11位'
            },
            'QuickCheckoutForm[provinceId]' : {
                'required': '省份必须选择'
            },
            'QuickCheckoutForm[cityId]' : {
                'required': '市必须选择'
            },
            'QuickCheckoutForm[regionId]' : {
                'required': '区必须选择'
            },
            'QuickCheckoutForm[address]' : {
                'required': '详细地址必须填写',
                'minlength': '详细地址最少5个字',
                'maxlength': '详细地址最多30个字'
            }
        },
        onfocusout: false,
        onkeyup: false,
        onchange: false,
        submitHandler: function(form){
            $('#checkout_form').ajaxSubmit({
                dataType: 'json',
                success: function(data){
                    if(data.result==0){
                        location.href = "/shop/user/order/pay?id=" + data.data.id;
                    }else{
                        alert(data.msg);
                    }
                }
            });
        }
    });

    $('#checkout').click(function(){
        $('#checkout_form').submit();

        return false;
    });
});