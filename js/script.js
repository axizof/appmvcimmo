var editPassword = document.getElementById("editPassword");
var editPassword2 = document.getElementById("editPassword2");
var edit = false;
var button = document.getElementById("modifierButton");
var confirmButton = document.getElementById("confirmButton");

function retirerReadonlyProfil() {
    var valeurDepart = editPassword.value;

    if (editPassword.readOnly) {
        editPassword.value = valeurDepart;
        editPassword.readOnly = false;

        // Faites la même chose pour le champ editPassword2
        editPassword2.readOnly = false;

        button.innerHTML = "Annuler";
        confirmButton.style.display = "inline-block";
    } else {
        editPassword.value = "";
        editPassword.readOnly = true;

        // Faites la même chose pour le champ editPassword2
        editPassword2.readOnly = true;

        button.innerHTML = "Modifier";
        confirmButton.style.display = "none";
    }
}

function confirmButton() {
    // Ajoutez le code pour traiter la confirmation ici
}
