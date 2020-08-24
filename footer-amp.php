<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kumle
 */


?>
		</div><!-- .inner-wrapper -->
    	<?php  if( !is_page_template('elementor_header_footer') ){ ?>
        </div><!-- .container -->
    	<?php } ?>
    </div><!-- #content -->

	<?php get_template_part( 'template-parts/footer-widgets' ); ?>

<!-- 	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="site-footer-wrap">
				<?php 

				$copyright_text = kumle_get_option( 'copyright_text' ); 

				if ( ! empty( $copyright_text ) ) : ?>

					<div class="copyright">

						<?php echo wp_kses_data( $copyright_text ); ?>

					</div>

					<?php 

				endif; 
				?>
			</div>
		</div>
	</footer> --><!-- #colophon -->
<?php if(!IS_FRONT_PAGE): ?>
	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="inlineUp col-xs-12 col-sm-2">
					<a href="#" class="up" id="go-top">Up</a>
				</div>
				<div class="inlineCopy col-xs-12 col-sm-6">
					<div class="copy">&copy; <?= date('Y') ?> - <a href="https://koeln-webstudio.de/" target="_blank">Köln Webstudio</a> - erfolgreiche Webprojekte</div>
				</div>
				<div class="inlineImp clerfix col-xs-12 col-sm-4">
					<div class="impressum-btn close" data-toggle="modal" data-target="#datenschutz">datenschutz |&nbsp;</div>
					<div class="impressum-btn close" data-toggle="modal" data-target="#impressum">impressum</div>
				</div>
			</div>
			<div style="margin: -10px 0 10px; line-height: 14px;">
				<small style="font-size: 67%;">* Alle Preisangaben in Euro inkl. MwSt und ggf. zzgl. Versand und weiterer Preisbestandteile.  Zwischenzeitliche Änderung der Preise, Rangfolge, Lieferkosten und -zeiten möglich</small>
			</div>
		</div>	
	</footer>
<?php endif; ?>
</div><!-- #page -->

</body>
</html>
