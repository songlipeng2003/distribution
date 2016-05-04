$(function(){
    $.post(location.href, function(data){
        pingpp.createPayment(data, function(result, err) {
            if (result=="success") {
                location.href = "/shop/user/order/pay-success";
            } else {
                console.log(result+" "+err.msg+" "+err.extra);
                location.href = "/shop/user/order";
            }
        });
    });
});