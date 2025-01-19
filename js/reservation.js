$(document).ready(function () {
    $('#ajax-reserve-btn').on('click', function (e) {
        e.preventDefault();
         
        let form = $('#reservation-form');
        let formData = form.serialize();

        // Désactiver le bouton pour éviter les soumissions multiples
        let submitButton = $('#ajax-reserve-btn');
        submitButton.prop('disabled', true).text('En cours...');

        $.ajax({
            url: reservationUrl, 
            
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.success) {
                    showNotification(response.message, 'success');
                    setTimeout(() => {
                        window.location.href = 'index.php?r=site/profile';
                    }, 3000);
                } else {
                    showNotification(response.message, 'error');
                }
            },
            error: function () {
                showNotification('Une erreur est survenue lors de la réservation.', 'error');
            },
            complete: function () {
                // Réactiver le bouton après la réponse
                submitButton.prop('disabled', false).text('Réserver');
            }
        });
    });

    
    function showNotification(message, type) {
        let notificationBar = $('#registration-notification-bar');
        notificationBar.removeClass().addClass('alert alert-' + type);
        notificationBar.text(message).fadeIn();

        setTimeout(() => {
            notificationBar.fadeOut();
        }, 3000);}
});
