function changeRole(userid){
        $.get('changeRole', {userId:userid},function(data){
            swal("عملیات موفق ", "ارسال اطلاعات با خطا مواجه شده است", "success")

        }).fail(function(){
            swal("عملیات ناموفق ", "ارسال اطلاعات با خطا مواجه شده است", "error")
        });
}
