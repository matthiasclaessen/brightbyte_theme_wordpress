document.addEventListener("DOMContentLoaded", () => {
    console.log("Document Loaded!");
});

jQuery(document).ready(function ($) {
    console.log("jQuery Loaded!");

    $("#filter").on("change", function () {
        const product_kind = $('#filter #category').val();
        const url = "?" + product_kind;

        const data = {
            category: product_kind,
            action: 'brightbyte_default_ajax_filter'
        }

        history.pushState(false, '', url);

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

document.addEventListener("DOMContentLoaded", function () {
    console.log("jQuery Loaded!");

    const filter = document.querySelector("#filter");
    filter.addEventListener("change", function () {
        const product_kind = document.querySelector('#filter #kind').value;
        const url = "?" + product_kind;

        const data = {
            category: product_kind,
            action: 'brightbyte_default_ajax_filter'
        };

        const xhr = new XMLHttpRequest();
        xhr.open("POST", ajaxurl);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.querySelector('.c-products #products').innerHTML = xhr.responseText;
            }
        };
        xhr.send(JSON.stringify(data));
    });
});