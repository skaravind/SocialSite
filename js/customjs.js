$(document).ready(function(){
/* 	 //sumernote for comment
	$('#comment-control').summernote({
	  toolbar: [
	    // [groupName, [list of button]]
	    ['style', ['bold', 'italic', 'underline', 'clear']],
	    ['font', ['strikethrough', 'superscript', 'subscript']],
	    ['fontsize', ['fontsize']],
	    ['color', ['color']],
	    ['para', ['ul', 'ol', 'paragraph']],
	    ['height', ['height']]
	  ]
	});  */
	
	$(".user_liked").click(function(){
		 $this1=$(this);
	 $.post('../custom_process.php', {code:'likeduser',userid:$(this).attr('datavalue')}, function(response) {
         $('.user_liked1').empty().html('Follower '+response); 	$this1.hide();
         }); 			
		});	
		
	$(".upvote").click(function(){
		 $this1=$(this);
		$postid=$(this).attr('datavalue');
		$datastatus=$(this).attr('datastatus');
		var code='vup';
	 $.post('../custom_process.php', {code:code,postid:$postid}, function(response) {
         $this1.empty().html('[Upvote '+response+']'); $this1.attr('datastatus','1');
		 
		 $(".downvote").each(function(){
			 if($(this).attr('datavalue')==$postid){
			 $this2=$(this);	 
				 $.post('../custom_process.php', {code:'vup1',postid:$postid,votes:'vdw'}, function(response) {
         $this2.empty().html('[Downvote '+response+']'); $this2.attr('datastatus','1');
				 });
			 }
		 });
		 
         });			
		});	
	$(".downvote").click(function(){
		 $this1=$(this);
		$postid=$(this).attr('datavalue');
		$datastatus=$(this).attr('datastatus');
		var code='vdw';
	 $.post('../custom_process.php', {code:code,postid:$postid}, function(response) {
         $this1.empty().html('[Downvote '+response+']'); $this1.attr('datastatus','1');		 
		 
		 $(".upvote").each(function(){
			 if($(this).attr('datavalue')==$postid){
			 $this2=$(this);	 
			$.post('../custom_process.php', {code:'vup1',postid:$postid,votes:'vup'}, function(response) {
         $this2.empty().html('[Upvoted '+response+']'); $this2.attr('datastatus','1');
				 });
			 }
		 });
         });			
		});	
		
		/* 
	
	$(".upvote,.downvote").click(function(){
		$this1=$(this);
		$postid=$(this).attr('datavalue');
		$datastatus=$(this).attr('datastatus');
		 if($(this).attr('datatype')=='upvote'){var code='vup';}else{var code='vdw';}
		 $.post('custom_process.php', {code:code,postid:$postid}, function(response) {           		   
		 if($this1.attr('datatype')=='upvote'){
		 if($datastatus=='1'){$this1.empty().html('[Upvote '+response+']');$this1.attr('datastatus','0');}
		 else{$this1.empty().html('[Upvoted '+response+']');$this1.attr('datastatus','1');}
			}
			 else{
			 if($datastatus=='1'){$this1.empty().html('[Downvote '+response+']');$this1.attr('datastatus','0');}
		 else{$this1.empty().html('[Downvoted '+response+']');$this1.attr('datastatus','1');}	 
				}
		});
	}); */
	 
		$( "li.dropdown" ).hover(function() {
		  $(".dropdown-content").css('display','block');
		  $(".navbar1").css('display','block');
			});
			
		$( "li.dropdown1" ).hover(function() {
		  $(".dropdown-content").css('display','none');
		  $(".navbar1").css('display','none');
			});
			
		$( ".stars" ).click(function() {
			$this1=$(this).attr('for');
	$("#rating").val($("#"+$this1).val());
		 document.formrate.submit();
			});
	
});
/* Coded by Jain software. Developer Rahul Rajak. */