$(function(){
    $.getJSON(location.href, function(data){
        if (result=="success") {
            alert('支付成功');
            location.href = "/shop/orders";
        } else {
            console.log(result+" "+err.msg+" "+err.extra);
        }
    });
});