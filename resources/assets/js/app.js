
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

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

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

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