"use strict";

script = function() {
    function someEvent() {
        
    }

    function init() {
        someEvent();
    } return {
        init: init
    }
}();

$(document).ready(function() {
    // table = $("#table-data").DataTable({
    //     "processing": true,
    //     "serverSide": true,
    //     "order": [],
    //     "ajax": {
    //         "url": url+"transaction/pr/list",
    //         "type": "post",
    //     },
    //     "columnDefs": [
    //         {
    //             "targets": [0, -1],
    //             "orderable": false,
    //         },
    //     ],
    // });
    script.init();
});
