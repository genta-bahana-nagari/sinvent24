$(document).ready(function() {

    $(".btn-login").click( function() {

        var email = $("#email").val();
        var password = $("#password").val();
        var token = $("meta[name='csrf-token']").attr("content");

        if(email.length == "") {

            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Alamat Email Wajib Diisi !'
            });

        } else if(password.length == "") {

            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Password Wajib Diisi !'
            });

        } else {

            $.ajax({

                url: "{{ route('login.check_login') }}",
                type: "POST",
                dataType: "JSON",
                cache: false,
                data: {
                    "email": email,
                    "password": password,
                    "_token": token
                },

                success:function(response){

                    if (response.success) {

                        Swal.fire({
                            type: 'success',
                            title: 'Login Berhasil!',
                            text: 'Anda akan di arahkan dalam 3 Detik',
                            timer: 3000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                            .then (function() {
                                window.location.href = "{{ route('dashboard.index') }}";
                            });

                    } else {

                        console.log(response.success);

                        Swal.fire({
                            type: 'error',
                            title: 'Login Gagal!',
                            text: 'silahkan coba lagi!'
                        });

                    }

                    console.log(response);

                },

                error:function(response){

                    Swal.fire({
                        type: 'error',
                        title: 'Opps!',
                        text: 'server error!'
                    });

                    console.log(response);

                }

            });

        }

    });

});