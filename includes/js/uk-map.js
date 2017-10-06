$('img[usemap]').rwdImageMaps().maphilight({fade: false, strokeColor: '000000', strokeWidth: 5, shadow: true});

$('#links a').mouseover(function(){
    $('#area-' + $(this).data('area')).mouseover();
}).mouseout(function(){
    $('#area-' + $(this).data('area')).mouseout();
});

$('area').mouseover(function(){
    $('#link-' + $(this).data('area')).addClass('text-danger');
}).mouseout(function(){
    $('#link-' + $(this).data('area')).removeClass('text-danger');
});