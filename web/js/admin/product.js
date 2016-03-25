$(function() {
    $('#file-upload').uploadify({
        'swf' : '/swf/uploadify.swf',
        'uploader' : '/site/upload',
        'buttonText': '上传',
        'onUploadSuccess': function(file, data, reponse){
            data = JSON.parse(data);
            if(data.result==0){
                html = "<div class='col-sm-3 thumbnail'>" 
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