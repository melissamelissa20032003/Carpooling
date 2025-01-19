$(document).ready(function () {
    $('#search-form').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let url = form.attr('action');
        let data = form.serialize();

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (response) {
                if (response.html) {
                    $('#results-container').html(response.html);
                    showNotification(response.message, 'success');
                } else {
                    showNotification('Aucun résultat trouvé.', 'warning');
                }
            },
            error: function () {
                showNotification('Une erreur est survenue lors de la recherche.', 'error');
            }
        });
    });

    // Notification helper function
    function showNotification(message, type) {
        let notificationBar = $('#registration-notification-bar');
        let alertClass = type === 'success' ? 'alert-success' : type === 'warning' ? 'alert-warning' : 'alert-danger';

        notificationBar
            .removeClass()
            .addClass('alert ' + alertClass)
            .text(message)
            .fadeIn();

        setTimeout(() => {
            notificationBar.fadeOut();
        }, 3000);
    }
});
