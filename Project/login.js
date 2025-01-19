$(document).ready(function () {
    $('#login-form').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = form.serialize();

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.success) {
                    showNotification('Connexion réussie !', 'success');
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 2000);
                } else {
                    showNotification(response.message, 'error');
                }
            },
            error: function () {
                showNotification('Erreur lors de la connexion.', 'error');
            }
        });
    });
});
