$.fn.select2.defaults.set("theme", "bootstrap");
$.fn.select2.defaults.language = 'vi';

function formatContact(contact) {
    if (contact.loading) return contact.text;

    var $markup = "";
    if (contact) {
        if (contact.description) {
            $markup = "<div>" + contact.name + " (" + contact.description + ")</div>";
        } else {
            $markup = "<div>" + contact.name + "</div>";
        }
    }
    return $markup;
}

function formatContactSelection(contact) {
    if (contact && contact.name) {
        return contact.name;
    }
    return contact.text;
}

$(function() {
    $("#parent_id").select2({
        placeholder: "Chọn đơn vị",
        allowClear: true,
        ajax: {
            url: window.Laravel.$apiContactsSearch,
            dataType: 'json',
            data: function (params) {
                return {
                    query: params.term ? params.term : "" // search term
                };
            },
            processResults: function (data) {
                return {
                    results: data.data
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        templateResult: formatContact, // omitted for brevity, see the source of this page
        templateSelection: formatContactSelection // omitted for brevity, see the source of this page
    });

    $('label[for="parent_id"]').click(function() {
        $('#parent_id').select2("open");
    });
});