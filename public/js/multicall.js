/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var nextinput = 0;
var services = {};
var lastTheme = 'skin-blue';
option = {};
cont = 0;

$(document).ready(function () {
//    $("#v_iv").change(function () {
//        var checkBoxIV = $(this);
//        var optionInput = "<div id='inputIv'><label class='radio-inline'><input id='incentivized' type='radio' name='incentivized' value='1' checked='checked'>Yes</label><label class='radio-inline'><input id='incentivized' type='radio' name='incentivized' value='0'>No</label></div>";
//        if (checkBoxIV.is(":checked")) {
//            console.log("you was selected iv video");
//            $("#ivOption").append(optionInput);
//        } else {
//            console.log("you are not selecting any aditional option");
//            $("#inputIv").remove();
//        }
//    }).change();


//    $("#fullscreen").change(function () {
//        var checkBoxIV = $(this);
//        var optionInput = "<div id='inputFull'><label class='radio-inline'><input id='fullscreen' type='radio' name='fullscreen' value='1' checked='checked'>Yes</label><label class='radio-inline'><input id='fullscreen' type='radio' name='fullscreen' value='0'>No</label></div>";
//        if (checkBoxIV.is(":checked")) {
//            console.log("you was selected iv video");
//            $("#fullOption").append(optionInput);
//        } else {
//            console.log("you are not selecting any aditional option");
//            $("#inputFull").remove();
//        }
//    }).change();


    $("#size").change(function () {
        var checkBoxIV = $(this);
        var optionInput = "<div class='form-group' id='inputFull'><label for='width'>Width </label><input class='form-control' id='width' type='number' name='width' value='240' ><br><label for='height'>Height </label><input class='form-control' id='height' type='number' name='height' value='320'></div>";
        if (checkBoxIV.is(":checked")) {
            console.log("you was selected iv video");
            $("#sizeOption").append(optionInput);
        } else {
            console.log("you are not selecting any aditional option");
            $("#inputFull").remove();
        }
    }).change();

    $("#ip_direction").change(function () {
        var checkBoxIV = $(this);
        var optionInput = "<div class='form-group' id='inputIP'><input placeholder='0.0.0.0' class='form-control' id='ip' type='text' name='ip_direction'></div>";
        if (checkBoxIV.is(":checked")) {
            console.log("you was selected iv video");
            $("#ipOption").append(optionInput);
        } else {
            console.log("you are not selecting any aditional option");
            $("#inputIP").remove();
        }
    }).change();


    $("#product_id").change(function () {
        var checkBoxIV = $(this);
        var optionInput = "<div class='form-group' id='inputProduct'><input placeholder='1490' class='form-control' id='ip' type='text' name='product_id'></div>";
        if (checkBoxIV.is(":checked")) {
            console.log("you was selected iv video");
            $("#productOption").append(optionInput);
        } else {
            console.log("you are not selecting any aditional option");
            $("#inputProduct").remove();
        }
    }).change();


    $("#os_type").change(function () {
        var checkBoxIV = $(this);
        var optionInput = "<div class='form-group' id='inputOS'><label class='radio-inline'><input id='os_radio' type='radio' name='os_value' value='android' checked='checked'><i class='fixed fa fa-fw  fa-android'></i></label><label class='radio-inline'><input id='os_radio' type='radio' name='os_value' value='ios'><i class='fixed fa fa-fw fa-apple'></i></label></div>";
        if (checkBoxIV.is(":checked")) {
            console.log("you was selected iv video");
            $("#osOption").append(optionInput);
        } else {
            console.log("you are not selecting any aditional option");
            $("#inputOS").remove();
        }
    }).change();

});

window.onload = function ()
{
    //document.requestAds.partner.focus;
    document.requestAds.addEventListener('submit', validate_form);

};

function validate_form(evObject)
{

    evObject.preventDefault();
    var allClean = true;
    var formAds = document.requestAds;
    var spiner = '<div class="spinner"> \n\
                      <div class="rect1"></div> \n\
                      <div class="rect2"></div> \n\
                      <div class="rect3"></div> \n\
                      <div class="rect4"></div> \n\
                      <div class="rect5"></div>\n\
                      </div><br>Please wait while submmiting request...';


    for (var i = 0; i < formAds.length; i++)
    {


        if (valuePartner() == 0) {
            $("#partnergroup").addClass("has-error");
            alert('Please choose a partner');
            document.requestAds.partner.focus();
            allClean = false;
            break;
        } else {
            $("#partnergroup").removeClass("has-error");

        }
        
        if (valueCountry() == 0) {
            $("#countrygroup").addClass("has-error");
            alert('Please choose a country');
            document.requestAds.partner.focus();
            allClean = false;
            break;
        } else {
            $("#countrygroup").removeClass("has-error");

        }


        if (valueType() == 0) {
            $("#typegroup").addClass("has-error");
            alert('Please choose a type of ad');
            document.requestAds.partner.focus();
            allClean = false;
            break;
        } else {
            $("#typegroup").removeClass("has-error");

        }

        if (valueTime() == 0) {
            $("#timelimit").addClass("has-error");
            alert('Please setting a valid time limit');
            document.requestAds.time.focus();
            allClean = false;
            break;
        } else {
            $("#timelimit").removeClass("has-error");

        }

        if (valueAttemts() == 0) {
            $("#attempts").addClass("has-error");
            alert('Please setting number of attempts');
            document.requestAds.attempt.focus();
            allClean = false;
            break;
        } else {
            $("#attempts").removeClass("has-error");

        }


    }

    if (allClean === true) {

        if (($("#results").length > 0)) {
            $("#results").remove();
            $('#collapseTwo').addClass("in");
            $('#collapseTwo').attr("aria-expanded", "false");
        }
        
        $("#spin").append(spiner);
        $.ajax({
            url: '/multirequest/multicall/',
            type: 'POST',
            data: $(this).serialize(), // it will serialize the form data
            dataType: 'html',
            success: function (data) {
                var newSpin = "<div id='spin'></div>";
                $('#resultsRequested').fadeOut('slow', function () {
                    $('#resultsRequested').fadeIn('slow').html('<div id="results">' + data + '</div>');
                });
                $("#service").removeAttr("disabled", "disabled");
                $("#submit").removeAttr("disabled", "disabled");
                $("#spin").remove();
                $("#submiting").append(newSpin);
                $('#pass').val('');
                //Collapse one
                $('#collapseOne').removeClass("in");
                $('#collapseOne').attr("aria-expanded", "false");
                $('#collapseOne').attr("style", "0px");
                //Colapse two
                $('#collapseTwo').addClass("in");
                $('#collapseTwo').attr("aria-expanded", "true");
                $('#collapseTwo').attr("style", "");
                $("#remove-inputs").css("display", "");
                $("#typeSearchNotice").removeAttr("checked");
                $("#typeSearch").removeAttr("checked", "checked");

            }
        })
                .fail(function () {
                    alert('Submit Failed ...');
                });

    }
}

function valuePartner()
{
    var inputPartner = document.getElementById("partner");
    var valueInput = inputPartner.options[inputPartner.selectedIndex].value;
    return valueInput;

}

function valueCountry()
{
    var inputCountry = document.getElementById("country");
    var valueInput = inputCountry.options[inputCountry.selectedIndex].value;
    return valueInput;
}

function valueType()
{
    var inputPartner = document.getElementById("type");
    var valueInput = inputPartner.options[inputPartner.selectedIndex].value;
    return valueInput;

}

function valueAttemts()
{
    var inputAttempts = document.getElementById("attempt");
    var valueInput = inputAttempts.value;
    return valueInput;

}

function valueTime()
{
    var inputTime = document.getElementById("time");
    var valueInput = inputTime.value;
    return valueInput;

}

//Function is used to clear the input text fields
function checkBannedWords(wordToEval)
{
    return wordToEval.replace(/[*'";\\^$#]|<script[^>]*\>|<\/script[^>]*>?|eval/g, '');
}
























