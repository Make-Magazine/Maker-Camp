<?php
	/**
	 * Maker Camp footer template.
	 *
	 * @package    makeblog
	 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
	 * @author     Maker Media Web Team: Jake Spurlock, Bill Olson, Cole Geissinger and David Beauchamp <webmaster@makermedia.com>
	 *
	 */
	?>
<footer class="new-footer">
	<div class="container">
	<div class="row-fluid hidden-phone">
		<div class="span12 logo">
			<img class="footer_logo" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/make-logo.png' ); ?>" alt="MAKE">
			<!-- END span12 -->
		</div>
		<div class="clear"></div>
		<!-- END row -->
	</div>
	<div class="row-fluid">
		<div class="span4 trending">
			<h5>Maker Camp Resources</h5>
			<ul>
				<li><a href="http://makercamp.com/wp-content/uploads/2014/08/Maker-Camp-License-Release-and-Waiver-2014-3.0.pdf" target="_blank">Hangout Participant Release Form</a></li>
				<li><a href="https://support.google.com/plus/answer/2407397?hl=en&amp;topic=2409412&amp;ctx=topic" target="_blank">G+ Teen Safety Guide</a></li>
				<li><a href="http://www.google.com/intl/en/+/safety/" target="_blank">Safety Center</a></li>
				<li><a href="https://support.google.com/plus/answer/2423637?hl=en&amp;topic=2401644&amp;ctx=topic" target="_blank">For Parents</a></li>
				<li><a href="https://support.google.com/plus/answer/2403357?hl=en&amp;topic=2401644&amp;ctx=topic" target="_blank">For Education</a></li>
			</ul>
			<!-- END trending -->
		</div>
		<div class="span5 newsletter visible-desktop">
			<h5>Get our Newsletters</h5>
			<form action="http://whatcounts.com/bin/listctrl" method="POST">
				<input type="hidden" name="slid" value="6B5869DC547D3D4658DF84D7F99DCB43" />
				<label class="control-label" for="optionsCheckbox">Sign up to receive exclusive content and offers.</label>
				<br/>
				<input type="hidden" name="cmd" value="subscribe" />
				<input type="hidden" name="custom_host" value="makercamp.com" />
				<input type="hidden" name="custom_incentive" value="none" />
				<input type="hidden" name="custom_source" value="footer" />
				<input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
				<input type="hidden" name="errors_to" value="" />
				<div class="input-append control-group email-area">
					<input class="span2" id="appendedInputButton" name="email" type="text" placeholder="Enter your email">
					<button type="submit" class="btn" name="email" value="Subscribe">JOIN</button>
				</div>
			</form>
		</div>
		<div class="span5 about-us">
			<h5>About Maker Media</h5>
			<div class="about-column-01">
				<ul>
					<li><a href="//makermedia.com" target="_blank">About Us</a></li>
					<li><a href="//makermedia.com/work-with-us/advertising/" target="_blank">Advertise with Us</a></li>
					<li><a href="//makermedia.com/work-with-us/job-openings/" target="_blank">Careers</a></li>
				</ul>
				<div class="clearfix"></div>
				<!-- END span -->
				<h5  class="follow">Follow Make:</h5>
				<div class="soc_icons">
					<a class="sprite sprite-twitter"  href="http://twitter.com/make" title="Twitter" target="_blank"></a>
					<a class="sprite sprite-youtube" href="http://youtube.com/make" title="Youtube" target="_blank"></a>
					<a class="sprite sprite-pinterest" href="http://pinterest.com/makemagazine/" title="Pinterest" target="_blank"></a>
					<a class="sprite sprite-facebook" href="http://facebook.com/makemagazine" title="Facebook" target="_blank"></a>
					<a class="sprite sprite-google-plus" href="https://plus.google.com/+MAKE/posts" rel="publisher" title="Google+" target="_blank"></a>
					<!-- END socialArea -->
				</div>
			</div>
			<!-- END span3 about-us -->
			<div class="about-column-02">
				<ul>
					<li><a href="https://help.makermedia.com" target="_blank">Help</a></li>
					<li><a href="//makermedia.com/privacy/" target="_blank">Privacy</a></li>
					<li><a href="https://www.pubservice.com/MK/subscribe.aspx?PC=MK&PK=M3AMZB">Subscribe to Make:</a></li>
				</ul>
				<h5>
					<a href="<?php echo esc_url( home_url( '/contribute/' ) ); ?>">Show Us Your Project</a>
				</h5>
				<!-- END span about-column-02 -->
			</div>
		</div>
		<!-- END row -->
	</div>
	<?php echo make_copyright_footer(); ?>
	<!-- END container -->
</div>
</footer>
</div> <!-- /container -->
<!-- Place this tag after the last badge tag. -->
<script type="text/javascript">
	(function() {
		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		po.src = 'https://apis.google.com/js/plusone.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	})();
</script>
<?php wp_footer(); ?>
</body>
</html>
