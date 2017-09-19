( function ( $ ) {
    'use strict';
    $( document ).ready( function () {

        $("input.switcher").switchButton({
            labels_placement: "right",
            width: 60,
            height: 20,
            button_width: 30
        });

        // Add Color Picker to all inputs that have 'color-field' class
        $('.color-field').wpColorPicker();
     
    })
} ( jQuery ) )