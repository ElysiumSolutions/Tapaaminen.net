
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./jquery-ui.min');

$("#nav-toggle").click(function(){
    if($(".nav-menu").hasClass("is-active")){
        $(".nav-menu").removeClass("is-active");
    }else{
        $(".nav-menu").addClass('is-active');
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*
Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});
*/

$(document).ready(function(){
    $(".likeButton").click(function(){
        var postid = $(this).val();
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': window.Laravel['csrfToken']
            },
            url: "/palsta/tykkaa",
            data: {
                post: postid
            },
            dataType: 'html'
        }).done(function(data){
            data = JSON.parse(data);
            $("#post-"+postid+"-feedback").html(data['feedback']);
            $("#post-"+postid+"-likecount").html(data['likes']);
            $("#post-"+postid+"-feedback").show();
            $("#post-"+postid+"-feedback").fadeOut(4000);
        });
    });
});

window.removeTimeRow = function(date){
    $("#daterow_"+date).remove();
    var dates = $("#dates").val();
    var parts = dates.split('|');
    var datesnew = [];
    for(var i = 0; i < parts.length; i++){
        if(parts[i] != date){
            datesnew.push(parts[i]);
        }
    }
    $("#dates").val(datesnew.join("|"));
}

function fillTimesTable(){
    var dates = $("#dates").val();
    var parts = dates.split('|');
    for(var k = 0; k < parts.length; k++) {
        var date = parts[k];
        if(date !== "") {
            var dateparts = date.split('-');
            var printdate = dateparts[2] + "." + dateparts[1] + "." + dateparts[0];
            var column_amount = $("#column-amount").val();
            var timerow = '<tr id="daterow_' + date + '"><td>' + printdate + '</td>';
            for (var i = 0; i < column_amount; i++) {
                var j = i + 1;
                var rowname = 'time_' + j + '_' + date;
                timerow = timerow + '<td><input class="input is-small" type="text" name="' + rowname + '" id="' + rowname + '"></td>';
            }
            timerow = timerow + '' +
                '<td class="has-text-right"><button class="button is-danger is-small is-outlined" type="button" onclick="removeTimeRow(\'' + date + '\')"><span class="icon is-small"><i class="fa fa-times-circle"></i></span></button></td>' +
                '</tr>';
            $("#time-table tbody").append(timerow);
        }
    }
}

function chooseDate(date) {
    var dates = $("#dates").val();
    var parts = dates.split('|');
    if (parts.indexOf(date) < 0) {
        parts.push(date);
        $("#dates").val(parts.join("|"));

        var dateparts = date.split('-');
        var printdate = dateparts[2] + "." + dateparts[1] + "." + dateparts[0];
        var column_amount = $("#column-amount").val();
        var timerow = '<tr id="daterow_' + date + '"><td>' + printdate + '</td>';
        for (var i = 0; i < column_amount; i++) {
            var j = i+1;
            var rowname = 'time_'+j+'_'+date;
            timerow = timerow + '<td><input class="input is-small" type="text" name="'+rowname+'" id="'+rowname+'"></td>';
        }
        timerow = timerow + '' +
            '<td class="has-text-right"><button class="button is-danger is-small is-outlined" type="button" onclick="removeTimeRow(\'' + date + '\')"><span class="icon is-small"><i class="fa fa-times-circle"></i></span></button></td>' +
            '</tr>';
        $("#time-table tbody").append(timerow);
    }
}

$(document).ready(function(){
    if($( "#dates" ).length){
        fillTimesTable();
    }
    $( "#meeting-calendar" ).datepicker({
        showOtherMonths: false,
        closeText: "Sulje",
        prevText: "&#xAB;Edellinen",
        nextText: "Seuraava&#xBB;",
        currentText: "Tänään",
        monthNames: [ "Tammikuu","Helmikuu","Maaliskuu","Huhtikuu","Toukokuu","Kesäkuu",
            "Heinäkuu","Elokuu","Syyskuu","Lokakuu","Marraskuu","Joulukuu" ],
        monthNamesShort: [ "Tammi","Helmi","Maalis","Huhti","Touko","Kesä",
            "Heinä","Elo","Syys","Loka","Marras","Joulu" ],
        dayNamesShort: [ "Su","Ma","Ti","Ke","To","Pe","La" ],
        dayNames: [ "Sunnuntai","Maanantai","Tiistai","Keskiviikko","Torstai","Perjantai","Lauantai" ],
        dayNamesMin: [ "Su","Ma","Ti","Ke","To","Pe","La" ],
        weekHeader: "Vk",
        dateFormat: "yy-mm-dd",
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: "",
        numberOfMonths: 2,
        onSelect: function(date){
            chooseDate(date);
        }
    });
});

$("#flash-message-button").click(function(){
   $("#flash-message").hide();
});