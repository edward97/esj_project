$(document).ready(function() {
    "use strict";
    
    // ui-autocomplete
    $("#divisi-id").autocomplete({
        source: url+"dashboard/search/divisi",

        select: function(event, ui) {
            $('[name="divisi-id"]').val(ui.item.label);
        }
    });
});
