jQuery(document).ready(function($){function toggle_types(){$("body").on("change",".field-type",function(e){"select"==$(this).find("select option:selected").val()?$(this).siblings(".select-options").fadeIn("slow"):$(this).siblings(".select-options").hide(),"text"==$(this).find("select option:selected").val()||"number"==$(this).find("select option:selected").val()||"textarea"==$(this).find("select option:selected").val()?$(this).siblings(".input-placeholder").fadeIn("slow"):$(this).siblings(".input-placeholder").hide()})}!function(){let links=document.querySelectorAll(".tabs-menu li");for(let i=0;i<links.length;i++)links[i].addEventListener("click",function(event){event.preventDefault();let active=document.querySelector(".tab-content.active"),newTabId=event.target.getAttribute("href");if(localStorage.setItem("current_tab_menu_index",i),window.location.hash=newTabId,null!==active){active.classList.remove("active"),active.style.display="none";for(let i=0;i<links.length;i++)links[i].classList.remove("current")}links[i].classList.add("current"),document.querySelector("#"+newTabId).classList.add("active"),document.querySelector("#"+newTabId).style.display="block"});if(links.length>0){var active=localStorage.getItem("current_tab_menu_index"),refer=document.referrer;null!=active&&"class-wp-travel-engine-admin.php"===refer.split("&page=")[1]||(active=0),links[active].firstChild.click()}}(),$("textarea").removeAttr("required"),$(".trip-row:visible").length<1&&$(".tabs-note").show(),$(".trip_facts:visible").length<1&&$(".fields-note").show(),$(".trip_facts").each(function(){$(this).is(":visible")&&("select"==$(this).find("select option:selected").val()?($(this).find(".select-options").show(),$(this).find(".input-placeholder").hide()):($(this).find(".select-options").hide(),$(this).find(".input-placeholder").show()))}),$("body").on("click",".del-li",function(e){if(e.preventDefault(),!confirm(WPTE_OBJ.lang.are_you_sure_fact))return!1;$(this).parent().fadeOut("slow",function(){$(this).remove(),$(".trip_facts:visible").length<1?$(".fields-note").fadeIn("slow"):$(".fields-note").fadeOut("slow")})}),$("body").on("click","#add_remove_field",function(e){e.preventDefault();var len=0;$(".trip_facts").each(function(){var value=$(this).attr("data-id");isNaN(value)||(value=parseInt(value),len=value>len?value:len)}),len++;var newinput=$("#trip_facts_outer_template #trip_facts_inner_template").clone();newinput.html(function(i,oldHTML){return oldHTML.replace(/{{tripfactsindex}}/g,len)}),$("#writefacts").before(newinput.html()),toggle_types()}),$(".trip-info-list").sortable({handle:".handle"}),$(document).on("click",function(event){event||window.event;"trip-tabs-icon"!=$(event.target).attr("class")&&"wp-travel-engine-font-awesome-list"!=$(event.target).attr("class")&&$(".wp-travel-engine-font-awesome-list:visible").fadeOut("slow",function(){$(this).remove()})}),$(".tabs-custom, .email-custom").tabs(),$(".nb-tab-trigger").click(function(){$(".nb-tab-trigger").removeClass("nav-tab-active"),$(this).addClass("nav-tab-active");var configuration=$(this).data("configuration");$(".nb-configurations").hide(),$(".nb-"+configuration+"-configurations").show()}),$("body").on("click","#add_remove_tab",function(e){e.preventDefault();var maximum=0;$(".trip-row").each(function(){var value=$(this).attr("data-id");isNaN(value)||(value=parseInt(value),maximum=value>maximum?value:maximum)}),maximum++;var newField=$("#trip-template").clone();newField.html(function(i,oldHTML){return oldHTML.replace(/{{index}}/g,maximum)}),$("#writetrip").before(newField.html())}),$("body").on("click",".delete-tab",function(e){if(e.preventDefault(),!confirm(WPTE_OBJ.lang.are_you_sure_tab))return!1;$(this).parent().fadeOut("slow",function(){$(this).remove()}),$(".trip-row:visible").length<2?$(".tabs-note").fadeIn("slow"):$(".tabs-note").fadeOut("slow")}),$("body").on("click",".delete-faq",function(e){if(e.preventDefault(),!confirm(WPTE_OBJ.lang.are_you_sure_faq))return!1;$(this).parent().fadeOut("slow",function(){$(this).remove()}),$(".trip-row:visible").length<2?$(".tabs-note").fadeIn("slow"):$(".tabs-note").fadeOut("slow")}),$(".fields-accordion").sortable({handle:".tabs-handle"}),$(".tabs-accordion").sortable({handle:".tabs-handle"}),$("#itinerary-list").sortable({handle:".tabs-handle"}),$("#faqs-list").sortable({handle:".tabs-handle"}),toggle_types(),$(".accordion-tabs-toggle").next().hasClass("show"),$(".accordion-tabs-toggle").next().removeClass("show"),$(".accordion-tabs-toggle").next().slideUp(350),$(document).on("click",".accordion-tabs-toggle",function(){var $this=$(this);$this.next().hasClass("show")?($this.next().removeClass("show"),$this.next().slideUp(350),$this.find(".dashicons.dashicons-arrow-down.custom-toggle-tabs").toggleClass("open")):($this.parent().parent().find("li .inner").removeClass("show"),$this.parent().parent().find("li .inner").slideUp(350),$this.next().toggleClass("show"),$this.next().slideToggle(350),$this.find(".dashicons.dashicons-arrow-down.custom-toggle-tabs").toggleClass("open"))}),$("body").on("click",".disable-notif input",function(e){$(".disable-notif input").is(":checked")?$(".disable-notif input").attr("value","1"):$(".disable-notif input").attr("value","0")}),$("body").on("click",".disable-payment input",function(e){$(".disable-payment input").is(":checked")?$(".disable-payment input").attr("value","1"):$(".disable-payment input").attr("value","0")}),"stripe"==$(".payment-gateway-options").val()&&$("#pay_id").hide(),"paypal"==$(".payment-gateway-options").val()&&$("#stripepay_id").hide(),$("body").on("click",".wp-travel-engine-setting-sale",function(e){$(".wp-travel-engine-setting-sale").is(":checked")?$(".trip-price").fadeIn("slow"):$(".trip-price").fadeOut("slow")}),$(".hide-enquiry").is(":checked")?$(".enquiry-subject, .thankyou-page").fadeOut("slow"):$(".enquiry-subject, .thankyou-page").fadeIn("slow"),$("body").on("click",".hide-enquiry",function(e){$(this).is(":checked")?$(".enquiry-subject, .thankyou-page").fadeOut("slow"):$(".enquiry-subject, .thankyou-page").fadeIn("slow")}),$(".wp-travel-engine-setting-sale").each(function(){$(this).is(":checked")?$(".trip-price").show():$(".trip-price").hide()}),$(document).on("focus",".trip-tabs-icon",function(){if($(this).siblings(".wp-travel-engine-font-awesome-list").length<1){var $iconlist=$(".wp-travel-engine-font-awesome-list-template").clone();$(this).after($iconlist.html()),$(this).siblings(".wp-travel-engine-font-awesome-list").fadeIn("slow")}}),$(document).on("keyup",".trip-tabs-icon",function(){var value=$(this).val(),matcher=new RegExp(value,"gi");$(this).siblings(".wp-travel-engine-font-awesome-list").find("li").show().not(function(){return matcher.test($(this).find("svg").attr("data-icon"))}).hide()}),$(document).on("click",".wp-travel-engine-font-awesome-list li",function(event){var val=$(this).children("svg").attr("data-prefix")+" fa-"+$(this).children("svg").attr("data-icon");$(this).parent().parent().siblings(".trip-tabs-icon").attr("value",val),$(this).parent().parent().fadeOut("slow",function(){$(this).remove()}),event.preventDefault()}),$(document).on("click",function(e){"trip-tabs-icon"!=$(event.target).attr("class")&&$(".wp-travel-engine-font-awesome-list:visible").fadeOut("slow",function(){$(this).remove()})}),$(document).on("blur",".trip-tabs-icon",function(e){e.preventDefault(),$(this).siblings(".wp-travel-engine-font-awesome-list").fadeOut("slow",function(){$(this).remove()})}),$("body").on("click",".add-info",function(e){e.preventDefault();var val=$("#trip_facts").find(":selected").val();if(""==val)return $("#trip_facts").css("-webkit-box-shadow","inset 0px 0px 1px 1px red"),$("#trip_facts").css("-moz-box-shadow","inset 0px 0px 1px 1px red"),void $("#trip_facts").css("box-shadow","inset 0px 0px 1px 1px red");$("#trip_facts").css("-webkit-box-shadow","inset 0px 0px 0px 0px red"),$("#trip_facts").css("-moz-box-shadow","inset 0px 0px 0px 0px red"),$("#trip_facts").css("box-shadow","inset 0px 0px 0px 0px red"),nonce=$("#trip_facts").attr("data-nonce"),jQuery.ajax({type:"post",url:WTEAjaxData.ajaxurl,data:{action:"wp_add_trip_info",val:val,nonce:nonce},beforeSend:function(){$("#loader").fadeIn(500)},success:function(response){$(".trip-info-list").parent().append(response)},complete:function(){$("#loader").fadeOut(500)}})}),$(".tabs").tabs().addClass("ui-tabs-vertical ui-helper-clearfix"),$("body").on("click",".add-itinerary",function(e){e.preventDefault();var maximum=0;$(".itinerary-row").each(function(){var value=$(this).attr("data-id");isNaN(value)||(value=parseInt(value),maximum=value>maximum?value:maximum)}),maximum++;var newField=$("#itinerary-template").clone();newField.html(function(i,oldHTML){return oldHTML.replace(/{{index}}/g,maximum)}),newField.find(".itinerary-content").addClass("show"),newField.find(".itinerary-content").slideDown("slow"),newField.find(".itinerary-content").css("height","auto"),$("#itinerary-holder").before(newField.html()),toggle_types()}),$("body").on("click",".add-faq",function(e){e.preventDefault();var maximum=0;$(".faq-row").each(function(){var value=$(this).attr("data-id");isNaN(value)||(value=parseInt(value),maximum=value>maximum?value:maximum)}),maximum++;var newField=$("#faq-template").clone();newField.html(function(i,oldHTML){return oldHTML.replace(/{{index}}/g,maximum)}),newField.find(".faq-content").addClass("show"),newField.find(".faq-content").slideDown("slow"),newField.find(".faq-content").css("height","auto"),$("#faq-holder").before(newField.html()),toggle_types()}),$("body").on("keyup","#cost_includes",function(e){$("#include-result").val($("#cost_includes").val()),$("#include-result").val("<li>"+$("#include-result").val().replace(/\n/g,"</li><li>")+"</li>")}),$("body").on("keyup","#cost_excludes",function(e){$("#exclude-result").val($("#cost_excludes").val()),$("#exclude-result").val("<li>"+$("#exclude-result").val().replace(/\n/g,"</li><li>")+"</li>")}),$("body").on("keyup",".itinerary-content",function(e){$(this).siblings(".itinerary-content-inner").val($(this).val()),$(this).siblings(".itinerary-content-inner").val("<p>"+$(this).val().replace(/\n/g,"</p><p>")+"</p>")}),$(document).on("click",".expand-all-itinerary",function(e){e.preventDefault(),$(this).children("svg").hasClass("fa-toggle-off")&&$(this).children("svg").toggleClass("fa-toggle-on"),$(this).children("svg").hasClass("fa-toggle-on")&&$(this).children("svg").toggleClass("fa-toggle-off"),$(".itinerary-row").children(".itinerary-holder").children(".itinerary-content").toggleClass("show"),$(".itinerary-row").children(".itinerary-holder").children(".itinerary-content").slideToggle(350),$(".itinerary-row").find(".dashicons.dashicons-arrow-down.custom-toggle-tabs").toggleClass("rotator")}),$(".paypal-payment").is(":checked")?$(".wte-paypal-gateway-form").fadeIn("slow"):$(".wte-paypal-gateway-form").fadeOut("slow"),$("body").on("click",".paypal-payment",function(e){$(".paypal-payment").is(":checked")?$(".wte-paypal-gateway-form").fadeIn("slow"):$(".wte-paypal-gateway-form").fadeOut("slow")}),$("table.posts #the-list").sortable({items:"tr",axis:"y",helper:fixHelper,update:function(e,ui){$.post(ajaxurl,{action:"update-menu-order",order:$("#the-list").sortable("serialize")})}});var fixHelper=function(e,ui){return ui.children().children().each(function(){$(this).width($(this).width())}),ui};$(".trip-prev-price input").keypress(function(e){if(8!=e.which&&0!=e.which&&(e.which<48||e.which>57))return!1}),$(".trip-price input").keypress(function(e){if(8!=e.which&&0!=e.which&&(e.which<48||e.which>57))return!1}),$(".wp-travel-engine-fields-settings h3, .departure-status-options h3, .group-status-options h3").click(function(){$(this).nextAll().slideToggle()}),$("#extensions div h3").nextAll().slideUp(),$("#extensions div:first-child h3").nextAll().slideDown(),$(".trip_page_class-wp-travel-engine-admin select").select2({allowClear:!0,closeOnSelect:!1}),$("body").on("click",".button",function(e){$(".trip_page_class-wp-travel-engine-admin select").select2({allowClear:!0,closeOnSelect:!1})}),$("#wte-available-payment-gateway-srtble").sortable();var index=0<$(".wte-custom-pricing").length?$(".wte-custom-pricing").length+1:1;$(".wte-add-pricing-option").on("click",function(e){var option="custom_price_"+index,template=wp.template("wte-custom-pricing-option");$("#wte-pricing-options-holder").append(template({option:option,index:index})),++index}),$(".wp-travel-engine-setting-enable-pricing-sale").on("change",function(e){$(this).is(":checked")?$(this).parents(".repeater").siblings(".wp-travel-engine-pricing-sale").slideDown("slow"):$(this).parents(".repeater").siblings(".wp-travel-engine-pricing-sale").slideUp("slow")}),$("#wte-pricing-options-holder").sortable(),$("body").on("click",".multiple-pricing-repeater .dashicons-no",function(e){$(this).parent().fadeOut("slow",function(){$(this).remove()})})});