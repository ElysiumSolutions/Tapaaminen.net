window._ = require('lodash');

window.$ = window.jQuery = require('jquery');

$("#nav-toggle").click(function(){
	if($(".nav-menu").hasClass("is-active")){
		$(".nav-menu").removeClass("is-active");
	}else{
		$(".nav-menu").addClass('is-active');
	}
});