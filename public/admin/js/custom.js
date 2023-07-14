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

    //update admin status 
    $('.updateAdminStatus').click(function(){
        var status =  $(this).children("i").attr('status');
        var admin_id = $(this).attr('admin_id');
        $.ajax({
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : 'post',
            url : '/admin/update-admin-status',
            data : {status:status , admin_id : admin_id},
            success:function(resp){
                if(resp['status'] == 0){
                    $('#admin-'+admin_id).html("<i class='mdi mdi-bookmark-outline' status='inactive'></i>Inactive");
                }else if(resp['status'] == 1){
                    $('#admin-'+admin_id).html("<i class='mdi mdi-bookmark-check' status='active'></i>Active");
                }
            },
            error : function(){
                console.log('error')
            }
        });
    });
});