/**
 * Affiche une notification dans le bandeau global.
 * @param {string} message - Le message à afficher.
 * @param {string} type - Le type de notification (success, error, info, warning).
 */
function showNotification(message, type = 'info') {
    let notificationBar = $('#notification-bar');

    // Réinitialiser les classes et ajouter le type
    notificationBar.removeClass().addClass('notification-bar ' + type);

    // Insérer le texte et afficher le bandeau
    notificationBar.text(message).fadeIn().delay(3000).fadeOut();
}
