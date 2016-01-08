<footer class="text-center">
  <div class="footer-above footer_box">
    <div class="container">
      <div class="row">
        <div class="footer-col col-xs-12 col-md-3 ftrblock">
          <p class="social-buttons"> <a href="https://twitter.com/sigmaways"><img src="img/tw.png"/></a> <a href="https://www.facebook.com/sigmaways"><img src="img/fb.png"/></a> <a href="https://www.linkedin.com/company/203731"><img src="img/linkedin.png"/></a> </p>
          <address>
          <strong>Sigmaways Inc</strong><br>
          39737 Paseo Padre Parkway<br>
          Fremont, CA 94538
          </address>
        </div>
        <div class="footer-col col-xs-12 col-md-3 ftrblock">
          <h4>Solutions</h4>
          <ul class="footer-list">
            <li><a href="#">Churn Analytics</a></li>
            <li><a href="#">Loyalty Analytics </a></li>
          </ul>
        </div>
        <div class="footer-col col-xs-12 col-md-3 ftrblock">
          <h4>CONTACT</h4>
          <ul class="footer-list">
            <li>
              <button type="button" class="btn btn-info btn-lg anchortext forgotpwdlink supportbox" data-toggle="modal" data-target="#myModal1">Request Demo</button>
            </li>
            <li>
              <button type="button" class="btn btn-info btn-lg anchortext forgotpwdlink supportbox" data-toggle="modal" data-target="#myModal2">Support</button>
            </li>
            <li><a href="<?php echo $siteurl; ?>/contactus">Contact</a></li>
          </ul>
        </div>
        <div class="footer-col col-xs-12 col-md-3 ftrblock">
          <h4>COMPANY</h4>
          <ul class="footer-list">
            <li><a href="http://sigmaways.com/">Company</a></li>
            <li><a href="<?php echo $siteurl; ?>/privacy">Privacy Policy</a></li>
            <li><a href="<?php echo $siteurl; ?>/termsofservices">Terms of Service</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="scroll-top page-scroll visible-xs visible-sm"> <a class="btn btn-primary scrolltotop" href="javascript:;"> <i class="fa fa-chevron-up"></i> </a> </div>
</footer>
<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->

<div id="myModal1" class="modal fade requestdemo" role="dialog">
  <div class="modal-dialog">
    <!-- Modal requestdome content-->
    <div class="modal-content">
      <div class="modal-hero">
        <p>Get in touch with us to schedule a private demo. We're here to understand your needs, show you our solutions, and answer any questions.</p>
      </div>
	  <form id="demo-form" method="post" action="<?php echo $siteurl; ?>/sendemail" novalidate="novalidate">
	  <input type="hidden" name="redirect" value="<?php echo $currentpage; ?>" />
      <div class="modal-body">
        
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-6">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="" size="40" class="form-control input-small required" placeholder="John">
                  </div>
                  <div class="col-xs-6">
                    <label for="first_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="" size="40" class="form-control input-small required" aria-required="true" placeholder="Doe">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" value="" size="40" aria-required="true" placeholder="johndoe@mybusiness.com" class="form-control required email">
              </div>
              <div class="form-group">
                <label for="website">Website</label>
                <input type="text" name="website" value="" size="40" aria-required="true" placeholder="mybusiness.com" class="form-control url">
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="company">Company</label>
                <input type="text" name="company" value="" size="40" class="form-control company-name" aria-required="true" autocomplete="off" placeholder="My Business">
              </div>
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" value="" size="40" placeholder="CMO, Sales, Business Developer..." class="form-control  required">
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phoneno" id="phoneno" value="" size="40" aria-required="true" placeholder="415-800-3787" class="form-control  required">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="comments">Comments</label>
            <textarea name="comments" data-optional="true" value="" placeholder="Anything else you would like to mention" class="form-control  required" style="height: 100px;"></textarea>
          </div>
        
      </div>
      <div class="modal-footer"><input class="btn btn-info" type="submit" name="requestdemo" value="Request Demo" /> </div>
	  </form>
    </div>
  </div>
</div>
<div id="myModal2" class="modal fade requestdemo" role="dialog">
  <div class="modal-dialog">
    <!-- Modal requestdome content-->
    <div class="modal-content">
      <div class="modal-hero">
        <p>Our average response time is 9 hours.</p>
        <p><a href="#" target="_blank">Active customers automatically get priority support</a>.</p>
      </div>
	  <form id="support-form" method="post" action="<?php echo $siteurl; ?>/sendemail">
	   <input type="hidden" name="redirect" value="<?php echo $currentpage; ?>" />
      <div class="modal-body">
        
          <div class="form-group">
            <label>Name</label>
            <div class="controls">
              <input name="name" value="" placeholder="Your name" class="form-control required">
            </div>
          </div>
          <div class="form-group">
            <label>Email</label>
            <div class="controls">
              <input name="email" value="" placeholder="Your email address" class="form-control required email">
            </div>
          </div>
          <div class="form-group">
            <label>Website</label>
            <div class="controls">
              <input name="website" value="" placeholder="Your website (if relevant)" class="form-control url" data-optional="true">
            </div>
          </div>
          <div class="form-group">
            <label>Message</label>
            <div class="controls">
              <textarea name="message" placeholder="Your message..." style="height: 210px" class="form-control required"></textarea>
            </div>
          </div>
        
      </div>
      <div class="modal-footer"><input class="btn btn-info" type="submit" name="requestsupport" value="Submit Request" /></div>
	  </form>
    </div>
  </div>
</div>
<!-- Portfolio Modals -->
<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/validate.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#support-form').validate();
	jQuery('#demo-form').validate({
		rules: {
			phoneno: {
				required: true,
				number: true,
				minlength: 10
			}
		},
		messages: {
			phoneno: {
				required: "Please enter phone number",
				number: "Please enter valid phone number",
				minlength: "Your phone number must be at least 10 number"
			}
		}
	});
	/*var navpos = jQuery('.footer_box').offset();
	jQuery(window).bind('scroll', function() {
	  if (jQuery(window).scrollTop() > navpos.top) {
		jQuery('.page-scroll').fadeIn('slow');
	   }
	   else {
		 jQuery('.page-scroll').fadeOut('slow');
	   }
	});*/
	jQuery('a.scrolltotop').click(function(){
		jQuery('html, body').animate({
			scrollTop:0
		}, 2000);
	});
	jQuery('#btnLogin').click(function(){
		jQuery('#toploginuser').validate();
		var error=false;
		var email=jQuery('#toploginuser #email').val();
		if(jQuery.trim(email)==''){error=true;}
		var pwd=jQuery('#toploginuser #pwd').val();
		if(jQuery.trim(pwd)==''){error=true;}
		if(!error)
		{
			jQuery.ajax({
				url: '<?php echo $siteurl; ?>/update',
				type: 'post',
				data: {email:email, pwd:pwd, login:'1'},
				success: function(res) {
					if(jQuery.trim(res)=='Done'){
						jQuery('label.showmsg').next('.showingerror').remove();
						window.location='<?php echo $siteurl; ?>/dashboard';
					}
					else
					{
						jQuery('label.showmsg').next('.showingerror').remove();
						jQuery('label.showmsg').after('<div class="showingerror">'+res+'</div>');
					}
				}	
			});
			return false;
		}
		jQuery('#toploginuser').submit();
	});
	
	jQuery('#btnForgotPassword').click(function(){
		jQuery('#formForgotPassword').validate();
		var error=false;
		var email=jQuery('#formForgotPassword #fgemail').val();
		if(jQuery.trim(email)==''){error=true;}
		if(!error)
		{
			jQuery.ajax({
				url: '<?php echo $siteurl; ?>/update',
				type: 'post',
				data: {email:email, forgotpwd:'1'},
				success: function(res) {
					jQuery('#formForgotPassword .showingerror').remove();
					jQuery('#formForgotPassword').prepend('<div class="showingerror">'+res+'</div>');
				}	
			});
			return false;
		}
		jQuery('#formForgotPassword').submit();
	});
});
</script>
<?php if($currentpage=='index.php'){ ?>
<script type="text/javascript" src="js/jquery.appear.js"></script>
<!-- Plugin JavaScript -->
<script>
$('*').each(function(){
		if($(this).attr('data-animation')) {
			var $animationName = $(this).attr('data-animation'),
				$animationDelay = "delay-"+$(this).attr('data-animation-delay');
			$(this).appear(function() {
				$(this).addClass('animated').addClass($animationName);
				$(this).addClass('animated').addClass($animationDelay);
			});
		}
	});
	
</script>
<?php } ?>
<?php if($currentpage=='login.php' || $currentpage=='register.php'){ ?>
<!-- Plugin JavaScript -->
<?php } ?>
<?php if($currentpage=='register.php'){ ?>
<link rel="stylesheet" type="text/css" href="css/all.min.css" />
<script type="text/javascript">
jQuery(document).ready(function(){
	
	jQuery.validator.addMethod("password",function(value,element)
	{
		return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/i.test(value); 
	},"Passwords must have a minimum of 8 characters with at least one digit and one letter.");
	jQuery('#newuser').validate({
		rules: {
			pwd: {
				required: true,
				minlength: 8,
				password: true,
			},
			phoneno: {
				required: true,
				number: true,
				minlength: 10
			}
		},
		messages: {
			pwd: {
				required: "Please provide a password",
				minlength: "Your password must be at least 8 characters long",
			},
			phoneno: {
				required: "Please enter phone number",
				number: "Please enter valid phone number",
				minlength: "Your phone number must be at least 10 number"
			}
		}
	});
		
});
</script>
<?php } ?>
<?php if($currentpage=='login.php' || $currentpage=='forgot-password.php' || $currentpage=='contactus.php'){ ?>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#loginuser').validate();
});
</script>
<?php } ?>
</body></html>