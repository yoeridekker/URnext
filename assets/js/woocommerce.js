
(function($jquery) {

	"use strict";
    var cart,
        cartCount = 0,
        getCartCount = false,
        cartCountHtml;

    $jquery( document ).on('ready', function(){

        cart = $jquery('#urnext-cart');
        cartCountHtml = cart.find('span.count');

        urnext_WoocommerceCartTooltip();
        urnext_InputNumber();
        urnext_WoocommerceCartCount();
        setInterval( urnext_WoocommerceCartCount , 10000 ); 
    });

    function urnext_WoocommerceCartCount(){
        if( getCartCount && getCartCount.readyState !== 4 ){
            return false;
        }
        getCartCount = $jquery.ajax({
            url: localize.ajaxurl,
            type: 'post',
            dataType: 'json',
            data: {
                action: 'urnext_get_cart_count',
                previous: cartCount
            },
            async: true,
            success: function(data){
                if( data.count > 0 ){
                    cartCountHtml.text( data.count );
                    cartCountHtml.show();
                    if( data.count !== cartCount ){
                        cartCountHtml.addClass('notify').delay(300).queue( function(next){
                            $jquery(this).removeClass('notify');
                            next();
                        });
                    }
                }
                cartCount = parseInt( data.count );
            }
        });
    }

    function urnext_WoocommerceCartTooltip(){
        cart.tooltipster({
            side:'bottom',
            animation: 'fall',
            distance: 15,
            theme: 'bg-header-color header-text-color border-border-color',
            interactive: true,
            contentAsHTML: true,
            trigger: 'click',
            content: '<div class="padded5">Loading cart...</div>',
            functionBefore: function( instance, helper ) {
                var $origin = $jquery( helper.origin );
                if ( $origin.data('loaded') !== true ) {
                    $jquery.ajax({
                        url: localize.ajaxurl,
                        data: {
                            action: 'urnext_get_cart_contents'
                        },
                        dataType: 'html',
                        async: true,
                        success: function(data){
                            instance.content(data);
                            $origin.data('loaded', true);
                        }
                    });
                }
                instance.reposition();
            }
        });
    }

    function urnext_InputNumber(){
        $jquery('<div class="quantity-button bg-primary-color primary-text-color quantity-down">-</div>').insertBefore('.quantity input[type=number]');
        $jquery('<div class="quantity-button bg-primary-color primary-text-color quantity-up">+</div>').insertAfter('.quantity input[type=number]');
        
        $jquery('.quantity').each(function() {
            var spinner = $jquery(this),
                input   = spinner.find('input[type="number"]'),
                btnUp   = spinner.find('.quantity-up'),
                btnDown = spinner.find('.quantity-down'),
                getMin  = input.attr('min'),
                getMax  = input.attr('max'),
                getStep = input.attr('step'),
                step    = ( getStep !== '' ? parseFloat( getStep ) : 1 ),
                min     = ( getMin !== '' ? parseFloat( getMin ) : 1 ),
                max     = ( getMax !== '' ? parseFloat( getMax ) : 99999999 );

            btnUp.on('click', function() {
                var oldValue = input.val() !== '' ? parseFloat(input.val()) : 0 ;
                var newVal = ( oldValue >= max) ? oldValue : oldValue + step;
                input.val(newVal);
                input.trigger("change");
            });

            btnDown.on('click', function() {
                var oldValue = input.val() !== '' ? parseFloat(input.val()) : min ;
                var newVal = (oldValue <= min) ? oldValue : oldValue - step;
                input.val(newVal);
                input.trigger("change");
            });
        });
    }

}(jQuery));