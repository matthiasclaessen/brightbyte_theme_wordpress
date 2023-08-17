document.addEventListener("DOMContentLoaded", () => {
    console.log("Document Loaded!");
});

jQuery(document).ready(function ($) {
    $("#filter").on("change", function () {
        const data = $("#filter").serialize(),
            url = "?" + data;

        history.pushState(false, false, url);
        window.location.reload();
    });
});
