// This is a manifest file that'll be compiled into application.js, which will include all the files
// listed below.
//
// Any JavaScript/Coffee file within this directory, lib/assets/javascripts, vendor/assets/javascripts,
// or vendor/assets/javascripts of plugins, if any, can be referenced here using a relative path.
//
// It's not advisable to add code directly here, but if you do, it'll appear at the bottom of the
// compiled file.
//
// Read Sprockets README (https://github.com/sstephenson/sprockets#sprockets-directives) for details
// about supported directives.
//
//= require jquery
//= require jquery_ujs
//= require jquery.color.min
//= require util
//= require bootstrap
//= require moment.min
//= require bootstrap-sortable
//= require bootstrap-modal
//= require bootstrap-modalmanager
//= require underscore
//= require backbone
//= require backbone/main
//= require jquery.countdown
//= require accounting.min
//= require ajax_modal
//= require turbolinks
//= require social-share-button
//= require plugins/local_date
//= require plugins/time_remaining
//= require bootstrap_run
//= require jquery.currency
//= require playerstats.js.coffee
//= require entries
//= require contest
//= require balanced
//= require account
//= require gamecenter
//= require_tree .
"use strict";
/*globals jQuery, $ */

jQuery(document).on({
	"page:before-change": function () {
		$(".ajax-loader").fadeIn();
		$("html, body").animate({ scrollTop: 0 }, "fast");
	},
	"page:load": function () {
		$(".ajax-loader").show().fadeOut();
	},
	"page:restore": function () {
		$(".ajax-loader").hide();
	},
	"ready page:load": function (e) {
		$(".require-signin").on("click", function (e){
			e.preventDefault();
			var target_url = $(this).attr("href");
			window.target_url = target_url;
			new window.AjaxModal("/users/signin_popup").load();
		});

		$(".welcome-text > a").on("click", function (e){
			e.preventDefault();
			$(".usermenu").toggle();
		});
	}
});