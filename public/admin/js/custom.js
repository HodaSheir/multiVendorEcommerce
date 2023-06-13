$(document).ready(function(){
    //check admin password is correct or not
    $('#current_password').keyup(function(){
        var current_pass = $('#current_password').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/check-current-password',
            data : {current_password : current_pass},
            success : function(res){
                if(res== "true"){
                    $('#check_password').html("<font color='green'> Current password is correct ! </font>");
                }else if(res == "false"){
                    $('#check_password').html("<font color='red'> Current password is incorrect ! </font>");
                }
            },
            error : function(){
                alert('error');
            }
        });
    });
});