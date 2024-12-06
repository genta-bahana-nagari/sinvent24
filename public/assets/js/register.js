$(document).ready(function() {
    $(".btn-register").click(function() {
        // Gather form input values
        var nama_lengkap = $("#nama_lengkap").val().trim();
        var email = $("#email").val().trim();
        var password = $("#password").val().trim();
        var token = $("meta[name='csrf-token']").attr("content");

        // Basic validation
        if (nama_lengkap === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Nama Lengkap Wajib Diisi!'
            });
            return;
        }

        if (email === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Alamat Email Wajib Diisi!'
            });
            return;
        }

        if (password === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Password Wajib Diisi!'
            });
            return;
        }

        // AJAX request
        $.ajax({
            url: "{{ route('register.store') }}",
            type: "POST",
            cache: false,
            data: {
                nama_lengkap: nama_lengkap,
                email: email,
                password: password,
                _token: token
            },
            success: function(response) {
                console.log("Response from server:", response); // Log response

                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Register Berhasil!',
                        text: 'Silahkan login!'
                    }).then(() => {
                        window.location.href = "{{ route('login') }}"; // Redirect to login
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Register Gagal!',
                        text: 'Silahkan coba lagi!'
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Opps!',
                    text: 'Terjadi kesalahan pada server!'
                });
                console.error("Server error:", xhr); // Log server error
            }
        });
    });
});
