document.addEventListener("DOMContentLoaded", () => {
    console.log("Document Loaded!");
});

jQuery(document).ready(function ($) {
    console.log("jQuery Loaded!");

    $("#filter").on("change", function () {
        const product_kind = $('#filter #kind').val();
        const url = "?" + product_kind;

        const data = {
            category: product_kind,
            action: 'brightbyte_default_ajax_filter'
        }

        $.ajax({
            type: 'POST',
            url: vars['ajaxurl'],
            data: data,
            success: function (response) {
                $('.c-products #products').html(response);
            }
        })
    });
});
