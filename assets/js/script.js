$(document).ready(function () {

    activateServices();
  
    function activateServices()
    {

        $('.update-profile-care li').removeClass('active');

        $(".description input:checked").each(function(){
            service_id = $(this).closest('.description').data('service');
            $("#li-"+service_id).addClass('active');
        });
    }

    $(".description input").on('change', activateServices);

     $('.update-profile-care li').click(function () {
      

        $(".description").hide();
        var $checkbox =  $(this).children("input[type=checkbox]");

        var val = $checkbox.val();
        $('#service-'+val).fadeIn();
    });


    /*
    $('.update-profile-care li').each(function () {
        if ($(this).hasClass("active")) {
            $(this).children("input[type=checkbox]").prop('checked', true);
        }
    });


    $('.update-profile-care li').click(function () {

        var $checkbox =  $(this).children("input[type=checkbox]");

        $(".description").hide();

        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
           $checkbox.prop('checked', false);

        } else {
            $(this).addClass("active");
            $checkbox.prop('checked', true);

        }
        var val = $checkbox.val();
        $('#service-'+val).fadeIn();
    });
    */

    $(".btn-certification").on("click", function () {
       

        $(".certifications").last().after('<ul class="certifications clearfix">' +
            '<li><input type="text" name="certification[]' + '"></li>' +
            '<li><input class="standard_date" type="text"  name="cert_from[]" placeholder="DD/MM/YY"/></li>' +
            '<li><input class="standard_date" type="text"  name="cert_till[]" placeholder="DD/MM/YY"/></li>' +
            '</ul>');
    
            triggerDatePicker();
    });

    $(".submit").click(function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        $.get(link, function (data) {
            $('html, body').animate({
                scrollTop: $(".update-details").offset().top
            }, 1000);

            setTimeout(function () {
                $(".wizard-frame").fadeOut(function () {
                    $(".wizard-frame").html(data).fadeIn();
                })
            }, 1000);

        });

    });

   /* Dropzone.options.userimage = {
        maxFilesize: 5,
        thumbnailWidth: 320,
        thumbnailHeight: 320,
        dictDefaultMessage: "<div>Drag & Drop Image Here</div><div>Only .png and .jpg files are accepted.</div><div class='user-image-upload'>or<span>Upload</span></div>",
        acceptedFiles: ".png, .jpg",
        uploadMultiple: false,
        maxFiles: 1
    };*/

// not Petro's code


    /*------------------------close-top-bar---------------------------*/

    $('#close-top-bar').on('click', (function (e) {

        e.preventDefault();
        $('#top-bar').hide();

    }));

    /*-------------------modals----------------------------------------*/


    $(".btn-modal").click(function () {
        $("#myModal").modal('show');
    });

    $("#myModalBox").modal('show');

    $("#modal-show").click(function () {
        $("#myModalBox-bid").modal('show');
    });

    $("#btn-time-need").click(function (e) {
        e.preventDefault();
        $("#myModalBox-time-need").modal('show');
    });

    $("#modal-nda").click(function (e) {
        e.preventDefault();
        $("#myModalBox-nda").modal('show');
    });

    if ($.cookie('modal_shown') == null) {
        $.cookie('modal_shown', 'yes');
        $('#myModalBox_update').modal('show');
    }


    /*-----------------------video----------------*/

    $('#btn-play').click(function (e) {
        e.preventDefault();
        $('#video')[0].play();
        $(this).fadeOut();
        $('#video')[0].setAttribute("controls", "controls");
    });


    /*-----------------------upload-file------------------*/

    var file_api = ( window.File && window.FileReader && window.FileList && window.Blob ) ? true : false;

    var inp = $('.file_upload input');


    // Crutches for the :focus style:
    inp.focus(function () {
        $(this).parent().addClass("focus");
    }).blur(function () {
        $(this).parent().removeClass("focus");
    });

    inp.change(function () {
        var file_name;

        var btn = $(this).parent().find('.button');
        var lbl = $(this).parent().find('mark');

        if (file_api && this.files[0]) {
            file_name = this.files[0].name;
        }

        if (!file_name.length) {
            return;
        }

        if (lbl.is(':visible')) {
            lbl.text(file_name);
            btn.text('Chosen');
        } else {
            btn.text(file_name);
        }
    });

    $(window).resize(function () {
        $('.file_upload input').triggerHandler('change');
    });

    /*---------------popover------------------------------*/

    $('#popoverData').popover();
    $('#popoverOption').popover({ trigger: "hover" });


    /*-----------------------datepicker--------------------*/
 function triggerDatePicker(){
          $('.standard_date').datepicker({dateFormat: "dd/mm/yy", changeMonth:true, changeYear: true, yearRange: "-20:+10"});		 	
    }

    $('.datetimepicker-h').datetimepicker({
        format: "DD/MM/YY"
    });
    $("#datepicker").datetimepicker({
        dateFormat: "dd/mm/yy"
    });

    $("#datepicker2").datetimepicker({
        dateFormat: "dd/mm/yy"
    });

    $("#datepicker-1_1").datetimepicker({
        dateFormat: "dd/mm/yy"
    });

    $("#datepicker-2_1").datetimepicker({
        dateFormat: "dd/mm/yy"
    });

    $("#date").datetimepicker({
        dateFormat: "dd/mm/yy"
    });

    $("#date-screening").datetimepicker({
        format: "DD/MM/YYYY"
    });

    $("#date-completion").datetimepicker({
        format: "DD/MM/YYYY"
    });

    $("#birthday").datetimepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true
    });

     $( ".datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy',
        yearRange: "1900:2016"
    });

    /*--------------------------rating-------------------*/
  //  $('.rating').rating();
});


//$(document).on('click', '.schedule_block .add-schedule-block', function(){
//   
//
//    var block = $(this).parent().parent();
//
//    $('.datepicker').datepicker('destroy').removeAttr('id');
//    var newblock = block.clone(true);
//
//    block.after(newblock);
//    newblock.find('input:text,select').val('');
//    newblock.find('input:checkbox').prop('checked', 0);
//
//    $("input.datepicker").datepicker({
//        dateFormat: "dd/mm/yy"
//    });
//
//   $('.care-week ul.repeat_days').each(function(index, el){
//        $(el).find('input').prop('name', "repeat_days["+index+"][]");
//   })
//
//    $(this).removeClass("add-schedule-block").addClass("drop-schedule-block").children(".fa").removeClass("fa-plus").addClass("fa-minus");
//});

$(document).on('click', '.drop-schedule-block', function(){
    var block = $(this).parent().parent();
    block.remove();
});

$(document).on('click', '.repeat', function(){
    $('.one_day_visit').toggle();
    $(".care-week").toggle();

});

$(document).on('click', '.fullday', function(){
    $('.fullday_yes').toggle();
    $(".repeat_block").toggle();

});


// schedule_visit services
$(document).ready(function () {
        

    visitServices();
  
    function visitServices()
    {
        $(".visit-profile-care li").hide();
        $(".visit-description").hide();

        $(".visit-description input:checked").each(function(){
            service_id = $(this).closest('.visit-description').data('service');

            $("#serviceli-"+service_id).addClass('active').show();
        });
    }
    $(".visit-description input").on('change', visitServices);

     $('.visit-profile-care li').click(function () {

        //make it readonly
        return;

        $(this).toggleClass('active');
        var $checkbox =  $(this).children("input[type=checkbox]");
        var val = $checkbox.val();
        if ($(this).hasClass('active')) {
            $('#serviceskill-'+val).find("input[type=checkbox]").prop('checked', true);
        }else{
            $('#serviceskill-'+val).find("input[type=checkbox]").prop('checked', false);
        }
        
    });
 });