jQuery(document).ready(function($){$("#add-new-week").click(function(e){e.preventDefault(),$(this).replaceWith('<input type="text" id="week-name" placeholder="Enter the week name" /> <input type="submit" value="+ New Week" id="submit-week" class="button button-primary" />')}),$("#make-schedule").on("click","#submit-week",function(e){e.preventDefault();var a=$(this),t=a.prev().val();a.add("#week-name").attr("disabled","disabled"),a.after('<img src="'+mexp.admin_url+'/images/wpspin_light.gif" alt="Saving Week" style="margin-left:10px;" id="saving-week-term" />'),$.ajax({type:"POST",dataType:"json",url:ajaxurl,data:{action:"make_add_week",term_name:t,nonce:make_schedule.schedule_nonce},success:function(e){e.success?($("#add-week-wrapper").find("#message").remove(),$("#assign-week").append('<option value="'+e.term.id+'">'+e.term.name+"</option>").val(e.term.id),$("#add-week-wrapper").replaceWith('<div id="message" class="updated"><p>'+e.message+"</p></div>").delay(5e3).slideUp()):($("#add-week-wrapper").find("#message").remove(),$("#submit-week, #week-name").removeAttr("disabled"),$("#saving-week-term").remove(),$("#add-week-wrapper").append('<div id="message" class="error"><p>'+e.message+"</p></div>"))},error:function(e,a,t){console.log("ERROR"),console.log(a),console.log(t)}})})});