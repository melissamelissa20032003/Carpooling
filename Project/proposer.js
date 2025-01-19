$(document).ready(function () {
    $('#proposer-voyage-form').on('beforeSubmit', function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = form.serialize();

        $.ajax({
            url: form.attr('action'), // Form's action attribute is used
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    showNotification(response.message, 'success');
                    setTimeout(() => {
                        window.location.href = response.redirect; // Redirect if provided
                    }, 4000);
                } else {
                    showNotification(response.message, 'error');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Show a fallback success message for debugging
                showNotification('Erreur AJAX ou problème côté serveur.', 'error');
                console.error('Erreur AJAX:', textStatus, errorThrown, jqXHR.responseText);
            }
        });

        return false; // Prevent default form submission
    });

    function showNotification(message, type) {
        let notificationBar = $('#registration-notification-bar');
        let alertClass = type === 'success' ? 'alert-success' : 'alert-danger';

        notificationBar
            .removeClass()
            .addClass('alert ' + alertClass)
            .text(message)
            .fadeIn();

        setTimeout(() => {
            notificationBar.fadeOut();
        }, 4000);
    }
});

