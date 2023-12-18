// script.js

function updateSelectedCategories(selectElement) {
    var selectedCategoriesDiv = document.getElementById("selectedCategories");
    selectedCategoriesDiv.innerHTML = ""; // Effacez le contenu précédent

    for (var i = 0; i < selectElement.selectedOptions.length; i++) {
        var selectedOption = selectElement.selectedOptions[i];
        selectedCategoriesDiv.innerHTML += '<span class="selectedCategory">' + selectedOption.text + '</span>';
    }
}

document.getElementById('uploadForm').addEventListener('submit', function (event) {
    event.preventDefault();

    // Reste du code pour envoyer la requête AJAX vers votre script PHP
});
