$(document).ready(function() {
$(".col-sm-4 control-label").on('keyup', function(e) {
    var val = $(this).val();
   if (val.match(/[^a-zA-Z]/g)) {
       $(this).val(val.replace(/[^a-zA-Z]/g, ''));
   }
});
});