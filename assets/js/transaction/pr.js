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
    script.init();
});
