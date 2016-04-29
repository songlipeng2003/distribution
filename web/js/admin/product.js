$(function() {
    $('#file-upload').uploadify({
        'swf' : '/swf/uploadify.swf',
        'uploader' : '/site/upload',
        'buttonText': '上传',
        'onUploadSuccess': function(file, data, reponse){
            data = JSON.parse(data);
            if(data.result==0){
                html = "<div class='col-sm-3 thumbnail'>" 
                    + '<i class="glyphicon glyphicon-remove" onclick="return removeImage(this)"></i>'
                    + "<img src=" + data.file + ">"
                    + "<input type='hidden' name='Product[files][]' value='" + data.file + "'>"
                    + "</div>";
                $('#images').append(html);
            }else{
                alert(data.msg);
            }
        }
    });
});

function removeImage(element){
    var id = $(element).parent().data('product-id');
    var imageId = $(element).parent().data('image-id');
    if(id){
        var url = "/admin/product/remove-image?id=" + id + '&imageId=' + imageId ;
        $.getJSON(url, function(){
            $(element).parent().remove();
        });
    }else{
        $(element).parent().remove();
    }

    return false;
}