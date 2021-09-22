jQuery(function ($) {
    var baseURL = window.location.protocol + "//" + window.location.host;
    var triggerCroppie = false;

    let actualBtn = document.getElementById('cv');
    if (actualBtn === null) {
        actualBtn = document.getElementById('content_image');
    }
    const fileChosen = document.getElementById('file-chosen');

    if (actualBtn != null) {
        actualBtn.addEventListener('change', function () {
            fileChosen.textContent = this.files[0].name
        })
    }
});
