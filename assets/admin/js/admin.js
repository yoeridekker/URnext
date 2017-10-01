( function ( $ ) {
    'use strict';

    $("input.switcher").switchButton({
        labels_placement: "right",
        width: 60,
        height: 20,
        button_width: 30,
        on_label: 'YES',
        off_label: 'NO'
    });

    // Add Color Picker to all inputs that have 'color-field' class
    $('.color-field').wpColorPicker();
    
} ( jQuery ) )