$(function(){
    $('#extract_form').validate({
        showErrors: function(errorMap, errorList) {
            if(errorList.length>0){
                alert(errorList[0].message);
            }
        },
        messages: {
            'Extract[amount]' : {
                'required': '提现金额必须填写',
                'min' : '提现金额不能小于5',
                'max' : '提现金额不能大于200'
            },
        },
        onfocusout: false,
        onkeyup: false,
        onchange: false,
        submitHandler: function(form){
            $('#extract_form').ajaxSubmit({
                dataType: 'json',
                success: function(data){
                    if(data.result==0){
                        location.href = "/shop/user/extract/success";
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