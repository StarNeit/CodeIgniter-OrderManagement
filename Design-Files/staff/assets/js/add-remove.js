// JavaScript Document

$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var select = '<select class="selectpicker col-md-4">'+
  '<optgroup label="Medication Reminders">'+
    '<option>Serve Medications</option>'+
    '<option>Medication Reminders</option>'+
  '</optgroup>'+
  '<optgroup label="Staying Active">'+
    '<option>Simple Exercises</option>'+
    '<option>Manual Transfers</option>'+
    '<option>Familiar with walking aids</option>'+
'<option>Familiar with functions of wheelchair</option>'+
  '</optgroup>'+
'<optgroup label="Meal Preparatioon & Grocery">'+
    '<option>Meal Preparation</option>'+
    '<option>Grocery Shopping</option>'+
  '</optgroup>'+
'<optgroup label="Escort Services">'+
    '<option>Valid driving license</option>'+
    '<option>Own a Car</option>'+
    '<option>Confident to Drive</option>'+
    '<option>Manual Transfers</option>'+
    '<option>Familiar with walking aids</option>'+
    '<option>Familiar with functions of wheelchair</option>'+
  '</optgroup>'+
'<optgroup label="Housekeeping">'+
    '<option>Bed making</option>'+
    '<option>Room cleaning</option>'+
    '<option>Laundry</option>'+
    '<option>Floor sweeping</option>'+
    '<option>Floor Vacuum</option>'+
    '<option>Floor Mopping</option>'+
  '</optgroup>'+
'<optgroup label="Personal Care & Hygiene">'+
    '<option>Bed Bath</option>'+
    '<option>Showering</option>'+
    '<option>Change Diaper</option>'+
    '<option>Manual Transfers</option>'+
  '</optgroup>'+
'<optgroup label="Companionship">'+
    '<option>Chitchat</option>'+
    '<option>Play Games</option>'+
  '</optgroup>'+
'<optgroup label="Check-in Visit">'+
    '<option>Check-in Visit</option>'+
  '</optgroup>'+
'<optgroup label="Night Survelliance">'+
    '<option>Night Survelliance</option>'+
  '</optgroup>'+
'</select>';
    var fieldHTML = '<div><input type="text" name="field_name[]" value="" class="col-md-6" placeholder="Text Here"/>'+select+'<a href="javascript:void(0);" class="remove_button" title="Remove field"><span class="remove_icon fa fa-minus-circle RemoveRow"></span>'; //New input field html 
    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});