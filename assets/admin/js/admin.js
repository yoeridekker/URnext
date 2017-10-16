( function ( $ ) {
    'use strict';

    // Set empty uploader
    var media_uploader = null;

    // first loop all possible repeater boxes 
    var urnext_repeater_clones = [];

    $('div.repeatcontainer').each( function( index, container ){
        var element         = $(container).find('div.repeatable:last-child');
        var element_name    = element.data('field');
        var clone_html      = element[0].outerHTML;
        urnext_repeater_clones[ element_name ] = clone_html;
    });

    console.log(urnext_repeater_clones);
    
    $('input.switcher').switchButton({
        labels_placement: 'right',
        width: 60,
        height: 20,
        button_width: 30,
        on_label: 'YES',
        off_label: 'NO'
    });
    
    // Add Color Picker to all inputs that have 'color-field' class
    $('.color-field').wpColorPicker();

    $('a.repeatbutton').on('click', function(event){
        event.preventDefault();
        var repeat_copy         = $(this).hasClass('copy') ? true : false ;
        var repeater_name       = $(this).data('for');
        var repeater_container  = $('#urnext-repeat-' + repeater_name + '-container');
        var repeater_html       = $( urnext_repeater_clones[repeater_name] );
        var last_repeater       = repeater_container.find('div.repeatable:last-of-type');
        var new_repeater        = repeater_html.insertAfter( last_repeater );
        if( !repeat_copy ) new_repeater.find('input, select, textarea').val('');
    });

    $('div.repeatcontainer').on('click', 'a.deletebutton', function(event){
        event.preventDefault();
        var deleteRow = confirm('Delete row?');
        if( deleteRow ) $(this).parent().remove();
    });

    
    $('#theme-options-panel').on('click', 'button.image-upload', function(event){
        var button = $(this);
        event.preventDefault();
        media_uploader = wp.media({
            frame:    "post", 
            state:    "insert", 
            multiple: false
        });
    
        media_uploader.on("insert", function(){
            var json = media_uploader.state().get("selection").first().toJSON();
            var image_url = json.url;
            var image_caption = json.caption;
            var image_title = json.title;
            console.log(json);
            button.next('input[type=text]').val(image_url);
        });
    
        media_uploader.open();
    });

    
    
    
} ( jQuery ) )