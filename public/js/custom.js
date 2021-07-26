jQuery(function ($) {
    var baseURL = window.location.protocol + "//" + window.location.host;
    var triggerCroppie = false;

    const actualBtn = document.getElementById('cv');

    const fileChosen = document.getElementById('file-chosen');

    actualBtn.addEventListener('change', function(){
        fileChosen.textContent = this.files[0].name
    })
});
