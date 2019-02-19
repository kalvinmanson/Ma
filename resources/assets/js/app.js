/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
$(function() {
  $('body').bootstrapMaterialDesign();
  $( ".ckfile" ).click(function() {
    var id = $(this).attr('id');
    openKCFinder(id);
    function openKCFinder(field) {
        window.KCFinder = {
            callBack: function(url) {
                $( "#"+id ).val(url);
                window.KCFinder = null;
            }
        };
        window.open('/editor/kcfinder/browse.php?type=images&dir=files/public', 'kcfinder_textbox',
            'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
            'resizable=1, scrollbars=0, width=800, height=600'
        );
    }
  });
});
