$(document).ready(function () {

    //    Petro Polishchuk

    $('.update-profile-care li').each(function () {
        if ($(this).hasClass("active")) {
            $(this).children("input[type=checkbox]").prop('checked', true);
        }
    });


    $('.update-profile-care li').click(function () {

        var id = $(this).children("input[type=checkbox]").attr("name");

        $(".description").fadeOut();

        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this).children("input[type=checkbox]").prop('checked', false);

        } else {
            $(this).addClass("active");
            $(this).children("input[type=checkbox]").prop('checked', true);

            $("#" + id).fadeIn();
        }

    });

    $(".btn-certification").on("click", function () {
        console.log($(".certifications").length);
        id = $(".certifications").length + 1;

        $(".certifications").last().after('<ul class="certifications clearfix">' +
            '<li><input type="text" name="certification' + id + '" id="certification' + id + '"></li>' +
            '<li><input class="datetimepicker-h" type="text" id="cert_from' + id + '" name="cert_from' + id + '" placeholder="DD/MM/YY"/></li>' +
            '<li><input class="datetimepicker-h" type="text" id="cert_till' + id + '" name="cert_till' + id + '" placeholder="DD/MM/YY"/></li>' +
            '</ul>');
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

    Dropzone.options.userimage = {
        maxFilesize: 5,
        thumbnailWidth: 320,
        thumbnailHeight: 320,
        dictDefaultMessage: "<div>Drag & Drop Image Here</div><div>Only .png and .jpg files are accepted.</div><div class='user-image-upload'>or<span>Upload</span></div>",
        acceptedFiles: ".png, .jpg",
        uploadMultiple: false,
        maxFiles: 1
    };

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

    //$('.datetimepicker-h').datetimepicker({
    //    format: "DD/MM/YY"
    //});
 
    $("#datepicker").datepicker({
        dateFormat: "dd/mm/yy"
    });

    $("#datepicker2").datepicker({
        dateFormat: "dd/mm/yy"
    });

    $("#datepicker-1_1").datepicker({
        dateFormat: "dd/mm/yy"
    });

    $("#datepicker-2_1").datepicker({
        dateFormat: "dd/mm/yy"
    });
	
	$("#datepicker-3_1").datepicker({
        dateFormat: "dd/mm/yy"
    });
	
	$("#datepicker-4_1").datepicker({
		dateFormat: "dd/mm/yy"
    });
	
	$("#datepicker-5_1").datepicker({
		dateFormat: "dd/mm/yy"
    });

    $("#date").datepicker({
        dateFormat: "dd/mm/yy"
    });

    $("#date-screening").datepicker({
        dateFormat: "dd/mm/yy"
    });

    $("#date-completion").datepicker({
        dateFormat: "dd/mm/yy"
    });

    $("#birthday").datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true
    });

    /*--------------------------rating-------------------*/
    $('.rating').rating();
});


 

 
	
	
	

$(document).on('click', '.visit-schedule_block .add-schedule-block', function(){
    var block = $(this).parent().parent();
    var newblock = block.clone();

    $(newblock.find("input")).each(function( index ) {
        var name = $(this).attr("name");
        var number = name.substring(name.indexOf("_") + 1);
        var newname = name.slice(0, -1);
        newname = newname + (parseInt(number) + 1);
        $(this).attr("name", newname);

        $("#"+newname).datepicker({
            dateFormat: "dd/mm/yy"
        });
    });

    $(newblock.find("select")).each(function( index ) {
        var name = $(this).attr("name");
        var number = name.substring(name.indexOf("-") + 1);
        var newname = name.slice(0, -1);
        newname = newname + (parseInt(number) + 1);
        $(this).attr("name", newname);
    });

    block.before(newblock);

    $(this).removeClass("add-schedule-block").addClass("drop-schedule-block").children(".fa").removeClass("fa-plus").addClass("fa-minus");
});

$(document).on('click', '.visit-schedule_block .drop-schedule-block', function(){
    var block = $(this).parent().parent();
    block.remove();
});



$(document).ready(function(){
    $(".no1 ,.yes2").click(function(){
        $(".showyes").hide();
    });
    $(".yes1").click(function(){
        $(".showyes").show();
    });
});

$(document).ready(function(){
    $(".yes1 ,.yes2").click(function(){
        $(".Hide-data1").hide();
    });
    $(".no1").click(function(){
        $(".Hide-data1 ,.Hide-data3").show();
    });
});

$(document).ready(function(){
    $(".no2").click(function(){
        $(".Hide-data1 ,.Hide-data2").hide();
    });
    $(".yes2").click(function(){
        $(".Hide-data2").show();
    });
});

$(document).ready(function(){
    $(".yes1").click(function(){
        $(".Hide-data3").hide();
    });
});
