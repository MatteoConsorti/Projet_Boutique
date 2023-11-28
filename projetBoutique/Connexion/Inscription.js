document.addEventListener('DOMContentLoaded', function() {
    const password = document.querySelector('#password');
    const passwordStrength = document.querySelector('#password-strength');

    password.addEventListener('input', function() {
        const passwordValue = password.value;

        // Évaluez ici la force du mot de passe selon vos critères
        // Exemple basique, évaluez la longueur du mot de passe
        if (passwordValue.length < 8) {
            // Mot de passe faible
            passwordStrength.value = 25; // Changez la valeur de la barre de progression
            passwordStrength.style.backgroundColor = 'red'; // Changez la couleur de la barre
            passwordStrength.nextElementSibling.textContent = 'Mot de passe faible'; // Affichez le texte en dessous
            passwordStrength.nextElementSibling.style.color = 'red'; // Changez la couleur du texte
        } else if (passwordValue.length >= 8 && passwordValue.length < 12) {
            // Mot de passe moyen
            passwordStrength.value = 50;
            passwordStrength.style.backgroundColor = 'yellow';
            passwordStrength.nextElementSibling.textContent = 'Mot de passe moyen';
            passwordStrength.nextElementSibling.style.color = 'Orange';
        } else {
            // Mot de passe fort
            passwordStrength.value = 100;
            passwordStrength.style.backgroundColor = 'green';
            passwordStrength.nextElementSibling.textContent = 'Mot de passe fort';
            passwordStrength.nextElementSibling.style.color = 'green';
        }
    });
});
