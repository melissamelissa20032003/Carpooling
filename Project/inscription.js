$(document).ready(function () {
    $('#ajax-register-btn').on('click', function (e) {
        e.preventDefault();

        let form = $('#registration-form');
        let formData = form.serialize();
        let button = $(this);
        let notificationBar = $('#registration-notification-bar');

        // Disable the button to prevent multiple submissions
        button.prop('disabled', true).text('En cours...');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    showNotification(response.message, 'success');
                    setTimeout(() => {
                        window.location.href = loginUrl; // Redirect to login after success
                    }, 3000);
                } else {
                    showNotification(response.message, 'danger'); // Display error message
                }
            },
            error: function () {
                showNotification('Une erreur est survenue lors de l\'inscription.', 'danger');
            },
            complete: function () {
                // Re-enable the button after the response
                button.prop('disabled', false).text('S\'inscrire');
            }
        });
    });

    function showNotification(message, type) {
        let notificationBar = $('#registration-notification-bar');
        notificationBar
            .removeClass()
            .addClass('alert alert-' + type)
            .text(message)
            .fadeIn();

        setTimeout(() => {
            notificationBar.fadeOut();
        }, 3000); // Adjust display time as needed
    }
});
