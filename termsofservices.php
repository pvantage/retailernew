<?php require_once('header-withoutlogin.php');
$errors=array();
$company='';
$full_name='';
$phoneno='';
$country='';
$state='';
$username='';
$email='';
if(isset($_POST['username']))
{
	$post['company']=$_POST['company'];
	if(trim($post['company'])=='')
	{
		array_push($errors,'Please enter company name.');
	}
	$post['full_name']=$_POST['full_name'];
	if(trim($post['full_name'])=='')
	{
		array_push($errors,'Please enter contact name.');
	}
	$post['phoneno']=$_POST['phoneno'];
	if(trim($post['phoneno'])=='')
	{
		array_push($errors,'Please enter phone number.');
	}
	$post['country']=$_POST['country'];
	if(trim($post['country'])=='')
	{
		array_push($errors,'Please enter country.');
	}
	$post['state']=$_POST['state'];
	if(trim($post['state'])=='')
	{
		array_push($errors,'Please enter state.');
	}
	$post['user_login']=$_POST['username'];
	if(trim($post['user_login'])=='')
	{
		array_push($errors,'Please enter username.');
	}
	/*$check=$user->Userfield('user_login', $post['user_login']);
	if(!empty($check))
	{
		array_push($errors,'Username already exist, please try another.');
	}*/
	
	if(trim($_POST['pwd'])!=trim($_POST['pwd2']))
	{
		array_push($errors,'Password is not matched with confirm password.');
	}
	$post['user_email']=$_POST['email'];
	if(trim($post['user_email'])=='')
	{
		array_push($errors,'Please enter email address.');
	}
	$check=$user->Userfield('user_email', $post['user_email']);
	if(!empty($check))
	{
		array_push($errors,'Email address already exist, please try another.');
	}
	$post['user_type']='user';
	$post['cdate']=date('Y-m-d H:i:s');
	$post['udate']=$post['cdate'];
	$post['active']=0;
	$post['activationkey']=sha1($post['user_email'].$_salt.$post['udate']);
	$post['user_pass']=sha1($_POST['pwd'].$post['cdate']);
	$token=$user->generatePassword(6,8);
	$post['tokenid']=md5($token.$_salt.$post['user_email']);
	$key=$user->generatePassword(9,5);
	$post['keyid']=md5($key.$_salt.$post['user_email']);
	if(empty($errors))
	{
		$fieldnames='';
		$fieldvalues='';
		$cnt=1;
		foreach($post as $key=>$value)
		{
			if($cnt==1)
			{
				$fieldnames.="`$key`";
				$fieldvalues.="'$value'";
			}
			else
			{
				$fieldnames.=", `$key`";
				$fieldvalues.=", '$value'";
			}
			$cnt++;
		}
		$res=$user->addUser($fieldnames,$fieldvalues);
		if($res>0)
		{
			$activatationlink=$siteurl.'/?activateaccount='.$post['activationkey'].'&email='.$post['user_email'];
			
			$to      = 	$post['user_email'];
			$subject = $sitname.' : Registration';	
			$from = $owner_email;
			$fromname=$sitname;
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= "Content-type: text/html; charset=utf-8" . "\r\nFrom: $fromname <$from>\r\nReply-To: $from";
			
			$message="Dear ".$post['user_login'].",<br /><br />
			Please make a note of your credentials which will be used on your analytics request.<br /><br />
			Token: ".$post['tokenid']."<br />
			Key: ".$post['keyid']."<br /><br />
			Your login detail given below:<br /><br />
			Email: ".$post['user_email']."<br />
			Password: ".$_POST['pwd']."<br /><br />
			To activate your account please click on <a href='".$activatationlink."'>".$activatationlink."</a><br />";
			$message.=$email_signature;
			@mail($to, $subject, $message, $headers);
			
			$_SESSION['message']='You are register successfully, please check your email to confirm your account.';
			@header('Location: '.$siteurl.'/register');
		}
	}
	else
	{
		foreach($_POST as $key=>$value)
		{
			${$key}=$value;
		}
	}
}
 ?>


    <!-- Portfolio Grid Section -->
	<div class="container innerpage cont_page">
		 <div class="row">
		<div class="entry">
		<h2 class="main_heading">Terms of Condition</h2>
				<p>THESE TERMS AND CONDITIONS ("TERMS") ARE A LEGAL CONTRACT BETWEEN YOU AND COMPANY.  THE TERMS EXPLAIN HOW YOU ARE PERMITTED TO USE THE WEBSITE LOCATED AT THE URL: <a href="http://sigmaways.com/">http://sigmaways.com/</a> AS WELL AS ALL ASSOCIATED SITES LINKED TO <a href="http://sigmaways.com/">http://sigmaways.com/</a> BY COMPANY, ITS SUBSIDIARIES AND AFFILIATED COMPANIES (COLLECTIVELY, THE "SITE").  UNLESS OTHERWISE SPECIFICED, ALL REFERENCES TO "SITE" INCLUDE THE SERVICES AVAILABLE THROUGH THIS SITE (THE "SERVICES") AND ANY SOFTWARE THAT Company PROVIDES TO YOU THAT ALLOWS YOU TO ACCESS THE SITE FROM A MOBILE DEVICE (A "MOBILE APPLICATION"). THE TERM "SERVICES" ALSO INCLUDES ANY PROOF OF CONCEPT OR OTHER PROFESSIONAL SERVICES THAT YOU AND COMPANY AGREE IN WRITING IN A STATEMENT OF WORK WILL BE PERFORMED BY COMPANY. BY USING SELECTING OR CHECKING "I AGREE", YOU ARE AGREEING TO ALL THE TERMS; IF YOU DO NOT AGREE WITH ANY OF THESE TERMS, DO NOT SELECT OR CHECK "I AGREE" OR ACCESS OR OTHERWISE USE THIS SITE, ANY SERVICES AVAILABLE THROUGH THIS SITE OR ANY INFORMATION CONTAINED ON THIS SITE.</p>
<h2>Changes</h2>
<p>Company may make changes to the content and Services offered on the Site at any time. Company can change, update, or add or remove provisions of these Terms, at any time by having you agree to a new version of these Terms or by posting the updated Terms on this Site and by providing you notice.  By assenting to the updated Terms or using this Site after Company has updated the Terms, you are agreeing to all the updated Terms; if you do not agree with any of the updated Terms, you must stop using the Site and receiving Services.</p>
<h2>Eligibility</h2>
<p>By using the Site, you represent that you are 18 years of age or older, or if you are between the ages of 13 and 18, that you are using the Site with the permission of your parent or legal guardian, or that you are an emancipated minor between the ages of 13 and 18. If you are a parent or legal guardian who is registering for a child, you hereby agree to bind your child to these Terms and to fully indemnify and hold harmless Company if your child breaches or disaffirms any term or condition of these Terms. If you are using this Site on behalf of a company, you represent that you are authorized to legally bind Company to these Terms.</p>
<p>If Company believes that you do not meet any of these requirements Company may immediately terminate your use of the Site.</p>
<h2>General Use</h2>
<p>Company provides content through the Site and through the Services that is copyrighted and/or trademarked work of Company or Companys third-party licensors and suppliers or other users of the Site (collectively, the "Materials").  Materials may include logos, graphics, video, images, software and other content, including snippets of Javascript or other code that enable our analytics service.</p>
<p>Subject to the terms and conditions of these Terms, and your compliance with these Terms, Company hereby grants you a limited, personal, non-exclusive and non-transferable license to use and to display the Materials and to use this Site in each case solely for your personal or own internal use, including by copying the snippets of Javascript code and embedding them into your website for analytics or tracking purposes.  Except as expressly authorized in the foregoing license, you have no other rights in the Site or any Materials and you may not modify, edit, copy, reproduce, create derivative works of, reverse engineer, alter, enhance or in any way exploit any of the Site or Materials in any manner.</p>
<p>If you breach any of these Terms, the above license will terminate automatically and you must immediately cease using and delete or destroy any downloaded, electronic or printed Materials.</p>
<h2>Using the Site and the Services on the Site</h2>
<p>You can simply view the Site and not use any Services on the Site.  You need not register with Company to simply visit and view the Site.</p>
<p>However, in order to access certain password-restricted areas of the Site (such as the subscriber or member areas) and to use certain Services and Materials offered on and through the Site, you must register with Company for an account and receive a password.</p>
<h2>Password Restricted Areas of this Site</h2>
<p>If you desire to register for an account with Company, you must submit the following information through the account registration page on the Site:  your first name, last name, company name, email address, and website password.  You will also have the ability to provide additional optional information, such as company size and work phone number, which is not required to register for an account but may be helpful to Company in providing you with a more customized experience when using the Site or its Services.  Once you have submitted your account registration information, you will be automatically approved and logged in to the system.</p>
<p>Currently, Company provides you with the ability to register for an account on the Site using your existing account and log-in credentials through LinkedIn Connect and in the future possible other third party sites (the "Third-Party Websites").  The Third-Party Websites may change from time to time.  (each of those log-in credentials, a "Third-Party Site Password").</p>
<p>You are responsible for maintaining the confidentiality of your Company Password and any Third-Party Site Password (collectively, "Passwords), and you are responsible for all activities that occur using your Passwords. You agree not to share your Passwords, let others access or use your Passwords or do anything else that might jeopardize the security of your Passwords.  You agree to notify Company if any of your Passwords on this Site is lost, stolen, if you are aware of any unauthorized use of your Passwords on this Site or if you know of any other breach of security in relation to this Site.</p>
<p>All the information that you provide when registering for an account and otherwise through the Site must be accurate, complete and up to date.  You may change, correct or remove any information from your account by either logging into your account directly (currently at <a href="http://www.sigmaways.com/members/settings/profile">http://www.sigmaways.com/members/settings/profile</a>) and making the desired changes or contacting Company using the contact information at the end of these Terms requesting that we make the change. </p>
<p>If you register for a "beta account" or other pre-release version of the Site and/or the Services and Materials on the Site ("Beta Release"), you acknowledge and agree that the Beta Release may contain, in Company sole discretion, more or fewer features or different licensing terms than a subsequent commercial release version of the Site and/or Services that may be offered through the Site.  You acknowledge and agree that any "beta account" will automatically convert to a commercial release version account upon the launch date of the Site and its Services to the public ("Public Launch Date").   If you do not desire to continue using the Site or its Services after the Public Launch Date, you may contact Company to delete your account in accordance with the terms and conditions governing deletion of personal information set forth in Companys Privacy Policy.  While Company generally intends to distribute commercial release versions of the Site and the Services and Materials on the Site, Company reserves the right not to release later commercial release versions of any Beta Release.  Without limiting any disclaimer of warranty or other limitation stated herein, you agree that any Beta Release is not considered by Company to be suitable for commercial use, and that it may contain errors affecting its proper operation.  BY ACCEPTING THESE TERMS, YOU ACKNOWLEDGE AND AGREE THAT USE OF A BETA RELEASE MAY EXHIBIT SPORADIC DISRUPTIONS THAT HAVE THE POTENTIAL TO DISRUPT YOUR USE OF THE SITE IN GENERAL AND ANY SERVICES THAT MAY BE OFFERED THROUGH THE SITE.  COMPANY SPECIFICALLY DISCLAIMS ALL DAMAGES RESULTING FROM YOUR USE OF ANY BETA RELEASE.</p>
<h2>Subscriptions and Payment</h2>
<p>By registering for an account with Company, you become a "Subscriber" with access to certain password-restricted areas of the Site and to use certain Services and Materials offered on and through the Site (a "Subscription").  Each Subscription and the rights and privileges provided to a Subscriber is personal and non-transferable.  All sales and payments of Subscription fees will be in US Dollars.</p>
<p>The fee that we will charge you for your Subscription will be the price posted on the Site or otherwise communicated to you on the date that you register as a Subscriber. Company reserves the right to change prices for Subscriptions at any time, and does not provide price protection or refunds in the event of promotions or price decreases.</p>
<p>You may pay for your Subscription fee only with credit and debit card payments (Visa, MasterCard, American Express, and Discover).  We will charge your credit or debit card for your first Subscription fee on the date that we process your order for your Subscription (or if you sign-up for a Subscription that includes a free-trial period, we will charge your credit or debit card for your first Subscription fee upon the expiration date of the applicable free-trial period).  After your credit or debit card is charged the first Subscription fee (or if you sign-up for a Subscription that includes a free-trial period, once we have processed your order for your Subscription), you will receive a confirmation e-mail notifying you of your ability to access those Subscription-only portions of, and Materials on, the Site.</p>
<p>With respect to receipts, we typically send a receipt of payment after you enroll for a paid subscription. If you add a credit card during a free-trial period and we do not process your payment at that time, Sigmaways will process your payment when the trial ends.  You will not be sent a receipt, however.  You can select to receive receipts when we charge your credit card.  Unless you configure your account to receive receipts, this feature will be disabled and you will not receive a receipt.</p>
<p>You may have one or more subscriptions. You must have a separate subscription for each website or project. Please review our website for our then-current pricing.  Each subscription is treated separately under an account. Under your account, you can associate a subscription with the same or different credit cards as other subscriptions.</p>
<p><u>IMPORTANT NOTICE:</u> COMPANY WILL AUTOMATICALLY RENEW YOUR MEMBERSHIP ON EACH MONTHLY OR YEARLY ANNIVERSARY OF THAT DATE THAT COMPANY FIRST CHARGES YOUR CREDIT OR DEBIT CARD FOR THE FIRST SUBSCRIPTION FEE AND, AS AUTHORIZED BY YOU DURING THE SUBSCRIPTION SIGN-UP PROCESS, COMPANY WILL CHARGE YOUR CREDIT OR DEBIT CARD WITH THE APPLICABLE YEARLY OR MONTHLY SUBSCRIPTION FEE AND ANY SALES OR SIMILAR TAXES THAT MAY BE IMPOSED ON YOUR SUBSCRIPTION FEE PAYMENT (UNLESS YOU CANCEL PRIOR TO THE ANNIVERSARY DATE). IF YOU SIGN UP FOR A SUBSCRIPTION THAT INCLUDES A FREE-TRIAL PERIOD, UNLESS YOU HAVE CANCELLED YOUR SUBSCRIPTION PRIOR TO THE EXPIRATION OF THE FREE-TRIAL PERIOD, AS AUTHORIZED BY YOU DURING THE SUBSCRIPTION SIGN-UP PROCESS, COMPANY WILL AUTOMATICALLY CHARGE YOU FOR THE FIRST YEARLY OR MONTHLY SUBSCRIPTION FEE, AS APPLICABLE, UPON THE EXPIRATION OF THE FREE-TRIAL PERIOD AND EACH SUBSEQUENT YEARLY OR MONTHLY SUBSCRIPTION FEE ON THE YEARLY OR MONTHLY ANNIVERSARY OF THE DATE OF THE FIRST BILLING. EACH SUBSCRIPTION RENEWAL PERIOD IS FOR ONE YEAR OR MONTH, DEPENDING ON THE TYPE OF SUBSCRIPTION SELECTED.  YOU MAY CANCEL YOUR MEMBERSHIP AT ANY TIME BY CONTACTING COMPANY. YOU ALSO MAY CHANGE YOUR SUBSCRIPTION AT ANY TIME, IN WHICH CASE THE SYSTEM WILL DOWNGRADE YOU AND ISSUE A PRO-RATED ACCOUNT CREDIT.  COMPANY REQUIRES A REASONABLE AMOUNT OF TIME TO PROCESS YOUR SUBSCRIPTION CANCELLATION REQUEST.  IF YOU CANCEL YOUR SUBSCRIPTION, YOU WILL ENJOY YOUR SUBSCRIPTION BENEFITS UNTIL THE EXPIRATION OF THE THEN-CURRENT YEARLY OR MONTHLY SUBSCRIPTION TERM FOR WHICH YOU HAVE PAID, AND YOUR SUBSCRIPTION BENEFITS WILL EXPIRE AT THE END OF THE THEN-CURRENT TERM.</p>
<p>You will be liable for paying any and all applicable sales and use taxes for the purchase of your subscription based on the mailing address that you provide when you register as a subscriber, and you authorize Company to charge your credit or debit card for any such applicable taxes.</p>
<h2>Purchases</h2>
<p>If applicable, you agree to pay all fees or charges to your account based on Companys fees, charges, and billing terms in effect as shown on the applicable payment page <a href="http://www.sigmaways.com/members/settings/package">http://www.sigmaways.com/members/settings/package</a>.  If you do not pay on time or if Company cannot charge your credit card, PayPal or other payment method for any reason, Company reserves the right to either suspend or terminate your access to the Site and account and terminate these Terms.  You are expressly agreeing that Company is permitted to bill you for the applicable fees, any applicable tax and any other charges you may incur in connection with your use of this Site and the fees will be billed to your credit card, PayPal or other payment method designated on your initial registration with this Site, and thereafter at regular intervals for the remainder of the term of these Terms.  If you cancel your account at any time, you will not receive any refund.  If you have a balance due on any account, you agree that Company may charge such unpaid fees to your credit card or otherwise bill you for such unpaid fees.</p>
<h2>Mobile Applications</h2>
<p>Company makes available Mobile Applications to access the Site via a mobile device.  To use the Mobile Application you must have a mobile device that is compatible with the mobile service.  Company does not warrant that the Mobile Application will be compatible with your mobile device.  Company hereby grants to you a non-exclusive, non-transferable, revocable license to use an object code copy of the Mobile Application for one registered account on one mobile device owned or leased solely by you, for your personal use.  You may not: (i) modify, disassemble, decompile or reverse engineer the Mobile Application, except to the extent that such restriction is expressly prohibited by law; (ii) rent, lease, loan, resell, sublicense, distribute or otherwise transfer the Mobile Application to any third-party or use the Mobile Application to provide time sharing or similar services for any third-party; (iii) make any copies of the Mobile Application; (iv) remove, circumvent, disable, damage or otherwise interfere with security-related features of the Mobile Application, features that prevent or restrict use or copying of any content accessible through the Mobile Application, or features that enforce limitations on use of the Mobile Application; or (v) delete the copyright and other proprietary rights notices on the Mobile Application.  You acknowledge that Company may from time to time issue upgraded versions of the Mobile Application, and may automatically electronically upgrade the version of the Mobile Application that you are using on your mobile device.  You consent to such automatic upgrading on your mobile device, and agree that these Terms will apply to all such upgrades.  The foregoing license grant is not a sale of the Mobile Application or any copy thereof, and Company and its third-party licensors or suppliers retain all right, title, and interest in and to the Mobile Application (and any copy of the Mobile Application).  Standard carrier data charges may apply to your use of the Mobile Application.</p>
<p>The following additional terms and conditions apply with respect to any Mobile Application that Company provides to you designed for use on an Apple iOS-powered mobile device (an "iOS App"):</p>
<ul>
<li>You  acknowledge that these Terms are between you and Company only, and not with Apple, Inc. ("Apple").</li>
<li>Your use of Companys iOS App must comply with Apples then-current App Store Terms of Service.</li>
<li>Company, and not Apple, are solely responsible for our iOS App and the Services and Content available thereon.  You acknowledge that Apple has no obligation to provide maintenance and support services with respect to our iOS App.  To the maximum extent permitted by applicable law, Apple will have no warranty obligation whatsoever with respect to our iOS App.</li>
<li>You agree that Company, and not Apple, are responsible for addressing any claims by you or any third-party relating to our iOS App or your possession and/or use of our iOS App, including, but not limited to: (i) product liability claims; (ii) any claim that the iOS App fails to conform to any applicable legal or regulatory requirement; and (iii) claims arising under consumer protection or similar legislation, and all such claims are governed solely by these Terms and any law applicable to us as provider of the iOS App.</li>
<li>You agree that Company, and not Apple, shall be responsible, to the extent required by these Terms, for the investigation, defense, settlement and discharge of any third-party intellectual property infringement claim related to our iOS App or your possession and use of our iOS App.</li>
<li>You represent and warrant that (i) you are not located in a country that is subject to a U.S. Government embargo, or that has been designated by the U.S. Government as a "terrorist supporting" country; and (ii) You are not listed on any U.S. Government list of prohibited or restricted parties.</li>
<li>You agree to comply with all applicable third-party terms of agreement when using our iOS App (e.g., you must not be in violation of your wireless data service terms of agreement when using the iOS App).</li>
<li>The parties agree that Apple and Apples subsidiaries are third-party beneficiaries to these Terms as they relate to your license of Companys iOS App.  Upon your acceptance of these Terms, Apple will have the right (and will be deemed to have accepted the right) to enforce these Terms against you as they relate to your license of the iOS App as a third-party beneficiary thereof.</li>
</ul>
<p>The following additional terms and conditions apply with respect to any Mobile Application that Company provides to you designed for use on an Android-powered mobile device (an "Android App"):</p>
<ul>
<li>You acknowledge that these Terms are between you and Company only, and not with Google, Inc. ("Google").</li>
<li>Your use of Companys Android App must comply with Googles then-current Android Market Terms of Service.</li>
<li>Google is only a provider of the Android Market where you obtained the Android App.  Company, and not Google, are solely responsible for Companys Android App and the Services and Content available thereon.  Google has no obligation or liability to you with respect to Companys Android App or these Terms.</li>
<li>You acknowledge and agree that Google is a third-party beneficiary to the Terms as they relate to Companys Android App.</li>
</ul>
<h2>Electronic Communications</h2>
<p>By using the Site and/or the Services provided on or through the Site, you consent to receiving electronic communications from Company.  These electronic communications may include notices about applicable fees and charges, transactional information and other information concerning or related to the Site and/or Services provided on or through the Site.  These electronic communications are part of your relationship with Company.  You agree that any notices, agreements, disclosures or other communications that we send you electronically will satisfy any legal communication requirements, including that such communications be in writing.</p>
<h2>Privacy Policy</h2>
<p>Please review Company Privacy Policy, which is available at: <a href="http://www.sigmaways.com/privacy/">http://www.sigmaways.com/privacy/</a> (the "Privacy Policy"), which explains how we use information that received we collect from our users or visitors to our properties (such as the Sigmaways website, members area, live application and the mobile apps) (the "Sigmaways Data"). For the avoidance of doubt, the Privacy Policy does not apply to the data collected through the use of the Services from your properties (and such data from your properties is referred to as the "Tracking Data".</p>
<h2>Tracking Data and Information.</h2>
<p>You own the Tracking Data. We may retain and use the Tracking Data to provide the Services. We will share Tracking Data with (a) third parties where we (i) have received your approval or consent; (ii) conclude that it is required by law or has a good faith belief that access, preservation or disclosure of Tracking Data is reasonably necessary to protect our rights, property or safety or that of our users or the public; (iii) provide Tracking Data in certain limited circumstances to third parties to carry out tasks on our behalf (e.g., billing or data storage) with restrictions that prevent the Data from being used or shared except as directed by us; and (b) affiliates, service providers, third parties as a result of business transfers, the Government and other third parties in response to judicial or legal proceedings or process, subpoenas, discovery requests, etc. as further contemplated by the Privacy Policy. When you delete your account, we will purge the Tracking Data on the next data deletion/cleanup cycle. With your approval, we allow third party services to access the Tracking Data via the API.</p>
<p>You hereby agree to not transfer, or cause to be transferred, to Company any of the following types of data: Social Security number; tax ID number; credit card number or financial account number; date of birth; drivers license, passport or other government identification number; login credentials; medical information; biometric data; sensitive data (as that term is defined by the Data Protection Directive); protected health information (as that term is defined under the Health Insurance Portability and Accountability Act and its implementing regulations, as amended); any nonpublic personal information (as defined by the Gramm-Leach-Bliley Act); or any data subject to data breach notification obligations under state, federal or other law.</p>
<p>You agree to make all necessary and appropriate disclosures to your customers about the collection and use of their information through our Services (including use of cookies and other tracking mechanisms) and how it is shared, including with us, and its security.</p>
<h2>Links to Third-Party Sites</h2>
<p>This Site may be linked to other web sites that are not Company sites, including, without limitation, social networking, blogging and similar websites through which you are able to log into this Site using your existing account and log-in credentials for such third-party websites, including, without limitation, LinkedIn (any and all of which of the foregoing listed websites may change from time to time) and websites that provide question-and-answer forum functionality (collectively, "Third-Party Sites").  Certain areas of the Site may allow you to interact and/or conduct transactions with such Third-Party Sites, and, if applicable, allow you to configure your privacy settings in your Third-Party Site account to permit your activities on this Site to be shared with your contacts in your Third-Party Site account and, in certain situations, you may be transferred to a Third-Party Site through a link but it may appear that you are still on this Site.  In any case, you acknowledge and agree that the Third-Party Sites may have different privacy policies and terms and conditions and/or user guides and business practices than Company, and you further acknowledge and agree that your use of such Third-Party Sites is governed by the respective Third-Party Web Site privacy policy and terms and conditions and/or user guides.  You hereby agree to comply with any and all terms and conditions, users guides and privacy policies of any of Third-Party Sites.  Company is providing links to the Third-Party Sites to you as a convenience, and Company does not verify, make any representations or take responsibility for such Third-Party Sites, including, without limitation, the truthfulness, accuracy, quality or completeness of the content, services, links displayed and/or any other activities conducted on or through such Third-Party Sites. YOU AGREE THAT COMPANY WILL NOT, UNDER ANY CIRCUMSTANCES, BE RESPONSIBLE OR LIABLE, DIRECTLY OR INDIRECTLY, FOR ANY GOODS, SERVICES, INFORMATION, RESOURCES AND/OR CONTENT AVAILABLE ON OR THROUGH ANY THIRD-PARTY WEB SITES AND/OR THIRD-PARTY DEALINGS OR COMMUNICATIONS, OR FOR ANY HARM RELATED THERETO, OR FOR ANY DAMAGES OR LOSS CAUSED OR ALLEGED TO BE CAUSED BY OR IN CONNECTION WITH YOUR USE OR RELIANCE ON THE CONTENT OR BUSINESS PRACTICES OF ANY THIRD-PARTY.  there MAY ALSO BE endorsement of third-party websites, third-party products/services and/or third-parties AVAILABLE from THE site, SUCH AS guest posts or posts about COMPANYS BUSINESS partners. COMPANY HAS NO LIABILITY FOR ANY SUCH ENDORSEMENT OR INFORMATION.</p>
<h2>Submissions</h2>
<p>You are responsible for the information, opinions, messages, comments, photos, videos, graphics, sounds and other content or material that you submit, upload, post or otherwise make available on or through the Site (each a "Submission") and through the Services available in connection with this Site.  You may not upload, post or otherwise make available on this Site any material protected by copyright, trademark, or any other proprietary right without the express permission of the owner of such copyright, trademark or other proprietary right owned by a third-party, and the burden of determining whether any material is protected by any such right is on you.  You shall be solely liable for any damage resulting from any infringement of copyrights, trademarks, proprietary rights, violation of contract, privacy or publicity rights or any other harm resulting from any Submission that you make.  You have full responsibility for each Submission you make, including its legality, reliability and appropriateness.</p>
<p>Unless otherwise explicitly stated herein or in Company Privacy Policy, you agree that any Submission provided by you in connection with this Site is provided on a non-proprietary and non-confidential basis.  You hereby grant to Company a non-exclusive, perpetual, irrevocable, royalty-free, fully paid-up, worldwide license (including the right to sublicense through multiple tiers) to use, reproduce, process, adapt, publicly perform, publicly display, modify, prepare derivative works, publish, transmit and distribute each of your Submissions, or any portion thereof, in any form, medium or distribution method now known or hereafter existing, known or developed, and authorize others to use the Submissions.  We may modify or adapt your Submissions in order to transmit, display or distribute them over computer networks and in various media and/or make changes to the Submissions as necessary to conform and adapt them to any requirements or limitations of any networks, devices, services or media.  Company agrees to use any personally identifiable information contained in any of your Submissions in accordance with Companys Privacy Policy.</p>
<p>You agree to pay for all royalties, fees, damages and any other monies owing any person by reason of any Submissions posted by you to or through this Site.</p>
<p>When you provide Submissions you agree that those Submissions shall not be in violation of the "Unauthorized Activities" paragraph below.  <strong>Those prohibitions do not require Company to monitor, police or remove any Submissions or other information submitted by you or any other user.</strong></p>
<h2>Unauthorized Activities</h2>
<p>When using this Site and/or the services, you agree not to:</p>
<ul>
<li>Defame, abuse, harass, stalk, threaten, or otherwise violate the legal rights (such as rights of privacy and publicity) of others.</li>
<li>Use racially, ethnically, or otherwise offensive language.</li>
<li>Discuss or incite illegal activity.</li>
<li>Use explicit/obscene language or solicit/post sexually explicit images (actual or simulated).</li>
<li>Post anything that exploits children or minors or that depicts cruelty to animals.</li>
<li>Post any copyrighted or trademarked materials without the express permission from the owner.</li>
<li>Disseminate any unsolicited or unauthorized advertising, promotional materials, 'junk mail, 'spam, 'chain letters, 'pyramid schemes, or any other form of such solicitation.</li>
<li>Use any robot, spider, scraper or other automated means to access the Site.</li>
<li>Take any action that imposes an unreasonable or disproportionately large load on our infrastructure.</li>
<li>Alter the opinions or comments posted by others on this Site.</li>
<li>Post anything contrary to our public image, goodwill or reputation.</li>
</ul>
<p>This list of prohibitions provides examples and is not complete or exclusive.  Company reserves the right to (a) terminate access to your account, your ability to post to this Site (or use the Services) and (b) refuse, delete or remove any Submissions; with or without cause and with or without notice, for any reason or no reason, or for any action that Company determines is inappropriate or disruptive to this Site or to any other user of this Site and/or Services.  <strong>Company may report to law enforcement authorities any actions that may be illegal, and any reports it receives of such conduct.  When legally required or at Companys discretion, Company will cooperate with law enforcement agencies in any investigation of alleged illegal activity on this Site or on the Internet.</strong></p>
<p>Unauthorized use of any Materials or Third-Party Content contained on this Site may violate certain laws and regulations.</p>
<p>You agree to indemnify and hold Company and its officers, directors, employees, affiliates, agents, licensors, and business partners harmless from and against any and all costs, damages, liabilities, and expenses (including attorneys fees and costs of defense) Company or any other indemnified party suffers in relation to, arising from, or for the purpose of avoiding, any claim or demand from a third-party that your use of this Site or the use of this Site by any person using your user name and/or password (including without limitation, your participation in the posting areas or, your Submissions) violates any applicable law or regulation, or the copyrights, trademark rights or other rights of any third-party.</p>
<p>If you disclose to Company any information or data which includes personally identifiable information ("PII") of end users of your site or application ("Customer Site") to Company, you represent and warrant that: (i) you comply with all applicable laws relating to the collection, use and disclosure of PII on your Customer Site; (ii) you have posted and maintain a privacy policy on your Customer Site, which clearly and conspicuously discloses that: (a) you use third-party service providers to provide services to you in connection with your operation of your Customer Site, including the collection and tracking of certain data and information regarding the characteristics and activities of visitors to such Customer Site; and (b) you may disclose end user PII to certain such third-party service providers in connection with their provision of services to you; and (iii) you have made all required notifications and obtained all required consents and authorizations from your end users relating to the disclosure of end user PII to a third party service provider like Company. You further acknowledge and agree that your indemnity obligation under the indemnity in the paragraph immediately above applies to your disclosure of end user PII under this Agreement.</p>
<h2>Professional Services</h2>
<p>You agree to pay Company for the proof of concept and other professional services performed under a statement of work ("SOW") as provided in the SOW. Unless otherwise provided in a SOW, you shall pay each invoice under a SOW within 30 days of the invoice date.  Amounts not paid when due will bear interest at the lesser of 1.5% per month and the maximum amount permissible by law. A SOW will begin when signed by the parties and will expire on the date of completion of the Services under the SOW, unless earlier terminated pursuant to this paragraph.  A party may terminate a SOW upon 30 days written notice to the other party, if the other party materially breaches a SOW and the breach remains uncured at the end of the 30 day cure period. Company hereby grants you a non-exclusive license to use the deliverables provided by Company to you under a SOW for internal evaluation purposes only.</p>
<h2>Proprietary Rights</h2>
<p>Sigmaways is a trademark of Company in the United States.  Other trademarks, names and logos on this Site are the property of their respective owners.</p>
<p>Unless otherwise specified in these Terms, all information and screens appearing on this Site, including documents, services, site design, text, graphics, logos, images and icons, as well as the arrangement thereof, are the sole property of Company, Copyright � 2013-14 Sigmaways, Inc.  All rights not expressly granted herein are reserved.  Except as otherwise required or limited by applicable law, any reproduction, distribution, modification, retransmission, or publication of any copyrighted material is strictly prohibited without the express written consent of the copyright owner or license.</p>
<p>The Mobile Application software that is provided to you through the Site and Services and related documentation are "Commercial Items", as that term is defined at 48 C.F.R. '$2.101, consisting of "Commercial Computer Software" and "Commercial Computer Software Documentation", as such terms are used in 48 C.F.R. '$12.212 or 48 C.F.R. '$227.7202, as applicable. Consistent with 48 C.F.R. '$12.212 or 48 C.F.R. '$227.7202-1 through 227.7202-4, as applicable, if you are a government entity, the Commercial Computer Software and Commercial Computer Software Documentation are being licensed to U.S. Government end users (a) only as Commercial Items and (b) with only those rights as are granted to all other end users pursuant to the terms and conditions herein.  Unpublished-rights reserved under the copyright laws of the United States.     </p>
<h2>Intellectual Property Infringement</h2>
<p>Company respects the intellectual property rights of others, and we ask you to do the same.  Company may, in appropriate circumstances and at our discretion, terminate service and/or access to this Site for users who infringe the intellectual property rights of others.  If you believe that your work is the subject of copyright infringement and/or trademark infringement and appears on our Site, please provide Companys designated agent the following information:</p>
<ul>
<li>A physical or electronic signature of a person authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.</li>
<li>Identification of the copyrighted and/or trademarked work claimed to have been infringed, or, if multiple works at a single online site are covered by a single notification, a representative list of such works at that site.</li>
<li>Identification of the material that is claimed to be infringing or to be the subject of infringing activity and that is to be removed or access to which is to be disabled at the Site, and information reasonably sufficient to permit Company to locate the material.</li>
<li>Information reasonably sufficient to permit Company to contact you as the complaining party, such as an address, telephone number, and, if available, an electronic mail address at which you may be contacted.</li>
<li>A statement that you have a good faith belief that use of the material in the manner complained of is not authorized by the copyright and/or trademark owner, its agent, or the law.</li>
<li>A statement that the information in the notification is accurate, and under penalty of perjury, that you are authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.</li>
</ul>
<p>Companys agent for notice of claims of copyright or trademark infringement on this Site can be reached as follows:</p>
<p>Sigmaways Inc<br>
39737 Paseo Padre Parkway<br>
Fremont, CA 94538

<a href="mailto:legal@sigmaways.com">legal@sigmaways.com</a></p>
<p>Please also note that for copyright infringements under Section 512(f) of the Copyright Act, any person who knowingly materially misrepresents that material or activity is infringing may be subject to liability.</p>
<h3>Submitting a DMCA Counter-Notification</h3>
<p>We will notify you that we have removed or disabled access to copyright-protected material that you provided, if such removal is pursuant to a valid DMCA take-down notice that we have received. If you receive such notice from us, you may provide us with a counter-notification in writing to Company designated agent that includes all of the following information:</p>
<ol>
<li>Your physical or electronic signature;</li>
<li>Identification of the material that has been removed or to which access has been disabled, and the location at which the material appeared before it was removed or access to it was disabled;</li>
<li>A statement from you under the penalty of perjury, that you have a good faith belief that the material was removed or disabled as a result of a mistake or misidentification of the material to be removed or disabled; and</li>
<li>Your name, physical address and telephone number, and a statement that you consent to the jurisdiction of a court for the judicial district in which your physical address is located, or if your physical address is outside of the United States, for any judicial district in which Company may be located, and that you will accept service of process from the person who provided notification of allegedly infringing material or an agent of such person.</li>
</ol>
<h3>Termination of Repeat Infringers</h3>
<p>Company reserves the right, in its sole discretion, to terminate the account or access of any user of our web site and/or service who is the subject of repeated DMCA or other infringement notifications.   </p>
<h2>Disclaimer of Warranties</h2>
<p>Your use of this Site and/or the Services is at your own risk.  The Materials have not been verified or authenticated in whole or in part by Company, and they may include inaccuracies or typographical or other errors.  Company does not warrant the accuracy of timeliness of the Materials contained on this Site.  Company has no liability for any errors or omissions in the Materials, whether provided by Company, our licensors or suppliers or other users.</p>
<p>COMPANY, FOR ITSELF AND ITS LICENSORS, MAKES NO EXPRESS, IMPLIED OR STATUTORY REPRESENTATIONS, WARRANTIES, OR GUARANTEES IN CONNECTION WITH THIS SITE, THE SERVICES, OR ANY MATERIALS RELATING TO THE QUALITY, SUITABILITY, TRUTH, ACCURACY OR COMPLETENESS OF ANY INFORMATION OR MATERIAL CONTAINED OR PRESENTED ON THIS SITE, INCLUDING WITHOUT LIMITATION THE MATERIALS.  UNLESS OTHERWISE EXPLICITLY STATED, TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW, THIS SITE, THE SERVICES, AND MATERIALS, AND ANY INFORMATION OR MATERIAL CONTAINED OR PRESENTED ON THIS SITE IS PROVIDED TO YOU ON AN "AS IS," "AS AVAILABLE" AND "WHERE-IS" BASIS WITH NO WARRANTY OF IMPLIED WARRANTY OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENT OF THIRD-PARTY RIGHTS.  COMPANY DOES NOT PROVIDE ANY WARRANTIES AGAINST VIRUSES, SPYWARE OR MALWARE THAT MAY BE INSTALLED ON YOUR COMPUTER.</p>
<h2>Limitation of Liability</h2>
<p>Company SHALL NOT BE LIABLE TO YOU FOR ANY DAMAGES RESULTING FROM YOUR DISPLAYING, COPYING, OR DOWNLOADING ANY MATERIALS TO OR FROM THIS SITE.  IN NO EVENT SHALL Company BE LIABLE TO YOU FOR ANY INDIRECT, EXTRAORDINARY, EXEMPLARY, PUNITIVE, SPECIAL, INCIDENTAL, OR CONSEQUENTIAL DAMAGES (INCLUDING LOSS OF DATA, REVENUE, PROFITS, USE OR OTHER ECONOMIC ADVANTAGE) HOWEVER ARISING, EVEN IF Company KNOWS THERE IS A POSSIBILITY OF SUCH DAMAGE.</p>
<p>NOTWITHSTANDING ANYTHING TO THE CONTRARY IN THIS AGREEMENT, IN NO EVENT WILL COMPANYS LIABILITY EXCEED FIFTY DOLLARS (USD $50), EVEN IN THE EVENT OF A FAILURE OF THE ESSENTIAL PURPOSE OR ANY LIMITED REMEDY UNDER THIS AGREEMENT.</p>
<h2>Local Laws; Export Control</h2>
<p>Company controls and operates this Site from its headquarters in the United States of America and the Materials may not be appropriate or available for use in other locations.  If you use this Site outside the United States of America, you are responsible for following applicable local laws.</p>
<h2>Feedback</h2>
<p>If you send or transmit any communications, comments, questions, suggestions, or related materials to Company, whether by letter, email, telephone, or otherwise (collectively, "Feedback"), suggesting or recommending changes to the Site, any Services offered through the Site or Materials, including, without limitation, new features or functionality relating thereto, all such Feedback is, and will be treated as, non-confidential and non-proprietary.  You hereby assign all right, title, and interest in, and Company is free to use, without any attribution or compensation to you, any ideas, know-how, concepts, techniques, or other intellectual property and proprietary rights contained in the Feedback, whether or not patentable, for any purpose whatsoever, including but not limited to, developing, manufacturing, having manufactured, licensing, marketing, and selling, directly or indirectly, products and services using such Feedback.  You understand and agree that Company is not obligated to use, display, reproduce, or distribute any such ideas, know-how, concepts, or techniques contained in the Feedback, and you have no right to compel such use, display, reproduction, or distribution.</p>
<h2>General</h2>
<p>Company prefers to advise you if we feel you are not complying with these Terms and to recommend any necessary corrective action.  However, certain violations of these Terms, as determined by Company, may result in immediate termination of your access to this Site without prior notice to you.  The Federal Arbitration Act, California state law and applicable U.S. federal law, without regard to the choice or conflicts of law provisions, will govern these Terms.  Foreign laws do not apply.  The United Nations on Contracts for the International Sale of Goods and any laws based on the Uniform Computer Information Transactions Act (UCITA) shall not apply to this Agreement.  Any disputes relating to these Terms or this Site will be heard in the federal and state courts located in San Francisco, California.  If any of these Terms is found to be inconsistent with applicable law, then such term shall be interpreted to reflect the intentions of the parties, and no other terms will be modified.  Companys failure to enforce any of these Terms is not a waiver of such term.  These Terms are the entire agreement between you and Company and supersede all prior or contemporaneous negotiations, discussions or agreements between you and Company about this Site.  The proprietary rights, disclaimer of warranties, representations made by you, indemnities, limitations of liability and general provisions shall survive any termination of these Terms.</p>
<h2>Contact Us</h2>
<p>If you have any questions about these Terms or otherwise need to contact Company for any reason, you can reach us at Legal Department:</p>
<p>Sigmaways Inc<br />
39737 Paseo Padre Parkway<br />
Fremont, CA 94538

<a href="mailto:legal@sigmaways.com">support@sigmaways.com.</a></p>
<p><small>The Terms of Service was last updated on 12/15/2015.</small></p>
							</div>
	  </div>
	  </div>
	
<?php require_once('footer-withoutlogin.php'); ?>
