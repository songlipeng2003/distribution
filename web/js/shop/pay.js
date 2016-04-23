$(function(){
    $.post(location.href, function(data){
        pingpp.createPayment(data, function(result, err) {
            if (result=="success") {
                alert('支付成功');
                location.href = "/shop/user/orders/pay-success";
            } else {
                console.log(result+" "+err.msg+" "+err.extra);
                location.href = "/shop/user/orders";
            }
        });
    });
});