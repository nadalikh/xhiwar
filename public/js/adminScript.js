function changeRole(userid){
        $.get('changeRole', {userId:userid},function(data){
            swal("عملیات موفق ", "سطح دسترسی کاربر با موفقیت تغییر کرد.", "success")

        }).fail(function(){
            swal("عملیات ناموفق ", "ارسال اطلاعات با خطا مواجه شده است", "error")
        });
}
