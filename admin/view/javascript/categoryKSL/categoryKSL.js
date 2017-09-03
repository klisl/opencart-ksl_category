$(document).ready(function(){
    // отметить все checkbox`ы
    $('#checkbox_check').click(function(){  
        $('input[type=checkbox]').prop( "checked", function(i, prop) {
            return true;
          });        
    });
    
    // выбрать все checkbox`ы
    $('#checkbox_cancel').click(function(){
        $('input[type=checkbox]').prop( "checked", function(i, prop) {
            return false;
          });      
    });    
});