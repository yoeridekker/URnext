( function ( $ ) {
    'use strict';
    $( document ).ready( function () {
        console.log( 'working!' )

        $("input.switcher").switchButton({
            labels_placement: "right",
            width: 60,
            height: 20,
            button_width: 30
        });
    })
} ( jQuery ) )