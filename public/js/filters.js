/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var nextinput = 0;
var services = {};
var lastTheme = 'skin-blue';

$(document).ready(function () {

    $("#theme_blue").click(function (event) {

        $("#main-body").removeClass(lastTheme);
        $("#main-body").addClass("skin-blue");
        lastTheme = "skin-blue";

    });


    $("#theme_black").click(function (event) {

        $("#main-body").removeClass(lastTheme);
        $("#main-body").addClass("skin-black");
        lastTheme = "skin-black";

    });


    $("#theme_purple").click(function (event) {

        $("#main-body").removeClass(lastTheme);
        $("#main-body").addClass("skin-purple");
        lastTheme = "skin-purple";

    });


    $("#theme_yellow").click(function (event) {

        $("#main-body").removeClass(lastTheme);
        $("#main-body").addClass("skin-yellow");
        lastTheme = "skin-yellow";

    });

    $("#theme_red").click(function (event) {

        $("#main-body").removeClass(lastTheme);
        $("#main-body").addClass("skin-red");
        lastTheme = "skin-red";

    });

    $("#theme_green").click(function (event) {

        $("#main-body").removeClass(lastTheme);
        $("#main-body").addClass("skin-green");
        lastTheme = "skin-green";

    });

    /* Im use this function to disable or enable the add button*/
    $("#service").on("keyup", function (event) {

        var lengthField = $("#service").val();

        if (lengthField != '') {
            $("#addService").removeAttr("disabled");

        } else {
            $("#addService").attr("disabled", "disabled");
        }
    });


    $("#searchLog").on("keyup", function (event) {

        var lengthField = $("#searchLog").val();

        if (lengthField != '') {
            $("#datepickerStart").attr("disabled", "disabled");
            $("#datepickerFinal").attr("disabled", "disabled");
            $("#service").attr("disabled", "disabled");
        } else {

            $("#datepickerStart").removeAttr("disabled");
            $("#datepickerFinal").removeAttr("disabled");
            $("#service").removeAttr("disabled");

        }
    });
});

window.onload = function () {
    document.requestLogs.pass.focus();
    document.requestLogs.addEventListener('submit', validate_form);

};

function newRequest() {

    location.href = '/logsmanager/';

}

function setCookieTheme(theme) {
    var cookie = document.cookie = 'theme=' + theme;
    console.log(cookie);
}


//Function add a filter when the client use the button enter
function addServiceEnter(e) {
    x = $('#service').val();

    if (e.keyCode == 13 && x != '') {
        addServices();
        return false;
    }
}

function validate_form(evObject) {

    evObject.preventDefault();
    var allClean = true;
    var formLogs = document.requestLogs;
    var spiner = '<div class="spinner"> \n\
                      <div class="rect1"></div> \n\
                      <div class="rect2"></div> \n\
                      <div class="rect3"></div> \n\
                      <div class="rect4"></div> \n\
                      <div class="rect5"></div>\n\
                      </div><br>Please wait while submmiting request...';


    for (var i = 0; i < formLogs.length; i++) {

        /*if (formLogs[i].name == 'user' || formLogs[i].name == 'pass') {

         if (formLogs[i].value == null || formLogs[i].value.length == 0 || /^\s*$/.test(formLogs[i].value)) {

         var input = formLogs[i].name;
         var upperInput = input.toUpperCase();
         alert(upperInput + ' must not be null or empty');
         allClean = false;
         break;
         }
         }*/

        if (valuePass() == 0 || valuePass().length < 5) {
            $("#password").addClass("has-error");
            alert('Pass must not be null, empty or length minor of 5 charachters');
            document.requestLogs.pass.focus();
            allClean = false;
            break;
        } else {
            $("#password").removeClass("has-error");

        }

        if (valuePartner() == 0) {
            $("#partnergroup").addClass("has-error");
            alert('Please choose a partner');
            document.requestLogs.partner.focus();
            allClean = false;
            break;
        } else {
            $("#partnergroup").removeClass("has-error");

        }

        /*if (valueEnvironment() == 0) {
         alert('Please choose an environment');
         allClean = false;
         break;
         }*/
    }

    if (allClean === true) {

        if (($("#results").length > 0)) {
            $("#results").remove();
            $('#collapseTwo').addClass("in");
            $('#collapseTwo').attr("aria-expanded", "false");
        }
        for (i = 0; i < nextinput; i++) {
            $('#remove-inputs' + i).css("display", "none");
        }

        $("#ser_" + nextinput).attr("disabled", "disabled");
        $("#submit").attr("disabled", "disabled");
        $("#service").attr("disabled", "disabled");


        $("#spin").append(spiner);
        $.ajax({
            url: '/logsmanager/show/',
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

                services = {};
                for (i = 0; i < nextinput; i++) {
                    $('#inputArea_' + i).remove();
                }
            }
        })
            .fail(function () {
                alert('Submit Failed ...');
            });

    }
}

function valuePartner() {
    var inputPartner = document.getElementById("partner");
    var valueInput = inputPartner.options[inputPartner.selectedIndex].value;
    return valueInput;

}

function valuePass() {
    var inputPartner = document.getElementById("pass");
    var valueInput = inputPartner.value;
    return valueInput;

}

/*function valueEnvironment()
 {
 var inputEnvironment = document.getElementById("enviroment");
 var valueInput = inputEnvironment.options[inputEnvironment.selectedIndex].value;
 return valueInput;
 }*/

function addServices(val) {

    $("#addService").attr("disabled", "disabled");
    $("#request_http").hide();

    if (val == null || val == '') {
        var value = checkBannedWords($('#service').val().trim());
    } else {
        var value = checkBannedWords(val);
    }

    if (value == '') {
        alert('We have a problem with your filter, we can\'t process this filter because you\'re using a banned word');
        $('#info').val('');
    } else {

        var id = "inputArea_" + nextinput;
        var id2 = "remove_" + nextinput;
        var removeButton = "<a id='remove-inputs" + nextinput + "'  href='#' onclick=\"removeInputs('" + id + "', '" + id2 + "','" + value + "');\" > <span class='glyphicon glyphicon-remove'></span>";
        var div = "<li style='list-style:none; display: inline;' class='input-service1' id='" + id + "'><input  type='text' value='" + value + "' id=ser_" + nextinput + " name=ser_" + nextinput + " class='input-service' readonly='readonly' /> " + removeButton + " </li>";

        $("#services").append(div);
        $('#service').val('');
        nextinput++;
    }
}

function saveFilters() {

    if (nextinput >= 0) {

        for (i = 0; i < nextinput; i++) {
            if ($("#ser_" + i).length > 0 && $("#ser_" + i).is(':visible')) {
                //Fill the filters array from the input #ser
                services[i] = $('#ser_' + i).val();
            }
        }

        var capsuleJson = JSON.stringify(services);
        document.getElementById('filters').value = capsuleJson;

    }
}

//Function is used to clear the input text fields
function checkBannedWords(wordToEval) {
    return wordToEval.replace(/[*'";\\^$#]|<script[^>]*\>|<\/script[^>]*>?|eval/g, '');
}

//Function is used to remove the input of filters
function removeInputs(id, id2) {
    $("#" + id).remove();
    $("#" + id2).remove();


}
























