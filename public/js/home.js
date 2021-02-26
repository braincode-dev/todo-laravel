$("#login-button").click(function(event){
    event.preventDefault();
    const email = $('#email').val();
    const password = $('#password').val();

    $.ajax({
        url: "/login",
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            email, password
        },
        success: function (result) {
            console.log(result);
            $('.alert-home').removeClass('show');
            $('form').fadeOut(500);
            $('.wrapper').addClass('form-success');

            setTimeout(function(){
                window.location.replace("/profile/dashboard");
            }, 2000);
        },
        error: function(result){
            const mess = result.responseJSON.message;
            $('.text-err').html(mess);
            $('.alert-home').addClass('show');
        }
    });



});
