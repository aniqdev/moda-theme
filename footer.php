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
<?php if(1 || !IS_FRONT_PAGE): // отключили блокировку для главной ?>
	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="inlineUp col-xs-12 col-sm-2">
					<a href="#" class="up" id="go-top">Up</a>
				</div>
				<div class="inlineCopy col-xs-12 col-sm-6">
					<div class="copy">&copy; 2019 - Köln Webstudio - Ihre Webagentur für Webdesign, Webentwicklung, SEO und vieles mehr</div>
				</div>
				<div class="inlineImp clerfix col-xs-12 col-sm-4">
					<div class="impressum-btn close" data-toggle="modal" data-target="#datenschutz">datenschutz |&nbsp;</div>
					<div class="impressum-btn close" data-toggle="modal" data-target="#impressum">impressum</div>
				</div>
			</div>
		</div>	
	</footer>
<?php endif; ?>
</div><!-- #page -->

<!--impressum-->
<div class="impressum modal fade bs-example-modal-lg" id="impressum" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Impressum</h4>
      </div>
      <div class="modal-body">

<p>Angaben gemäß § 5 TMG:</p>

<p>koeln-webstudio.de<br>
Inhaber: Konstantin Falke<br>
Bergerstr. 179<br>
51145 Köln</p>

<p>Kontakte:</p>

<p>
Telefon: +49 157 88453267<br>
E-Mail: info@koeln-webstudio.de<br>
ICQ: 169900<br>
Skype: g.i.g-group</p>

<p>Steuernummer:<br>
216/2566/2981</p>

<p>Die Europäische Kommission bietet eine Onlineplattform für Streitbeilegung an, die Sie hier finden:<br>
<a href="http://ec.europa.eu/consumers/odr/" target="_blank">http://ec.europa.eu/consumers/odr/</a></p><p>
Unter diesem Link finden Sie die Kontaktdaten der offiziellen Streitbeilegungsstellen:<br>
<a href="https://webgate.ec.europa.eu/odr/main/index.cfm?event=main.adr.show" target="_blank">https://webgate.ec.europa.eu/odr/main/index.cfm?event=main.adr.show</a></p>

<p>Zur Teilnahme an einem Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle sind wir nicht verpflichtet und nicht bereit.</p>

<p>Haftung für Inhalte:</p>

<p>Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.</p>

<p>Haftung für Links:</p>

<p>Unser Angebot enthält Links zu externen Webseiten Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße überprüft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links umgehend entfernen.</p>

<p>Urheberrecht:</p>

<p>Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.</p>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </div>
  </div>
</div><!--/impressum-->

<!--datenschutz-->
<div class="impressum modal fade bs-example-modal-lg" id="datenschutz" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Datenschutz</h4>
      </div>
      <div class="modal-body">

<p>Informationen über Cookies</p>

<p>Zur Optimierung unseres Internetauftritts setzen wir Cookies ein. Es handelt sich dabei um kleine Textdateien, die im Arbeitsspeicher Ihres Computers gespeichert werden. Diese Cookies werden nach dem Schließen des Browsers wieder gelöscht. Andere Cookies verbleiben auf Ihrem Rechner (Langzeit-Cookies) und erkennen ihn beim nächsten Besuch wieder. Dadurch können wir Ihnen einen besseren Zugang auf unsere Seite ermöglichen.</p>

<p>Das Speichern von Cookies können Sie verhindern, indem Sie in Ihren Browser-Einstellungen „Cookies blockieren” wählen. Dies kann aber eine Funktionseinschränkung unserer Angebote zur Folge haben.</p>

<p>Datenschutzerklärung für die Nutzung von Google Analytics</p>

<p>Diese Website benutzt Google Analytics, einen Webanalysedienst der Google Inc. („Google”). Google Analytics verwendet sog. „Cookies”, Textdateien, die auf Ihrem Computer gespeichert werden und die eine Analyse der Benutzung der Website durch Sie ermöglichen. Die durch den Cookie erzeugten Informationen über Ihre Benutzung dieser Website werden in der Regel an einen Server von Google in den USA übertragen und dort gespeichert. Im Falle der Aktivierung der IP-Anonymisierung auf dieser Webseite wird Ihre IP-Adresse von Google jedoch innerhalb von Mitgliedstaaten der Europäischen Union oder in anderen Vertragsstaaten des Abkommens über den Europäischen Wirtschaftsraum zuvor gekürzt.</p>

<p>Nur in Ausnahmefällen wird die volle IP-Adresse an einen Server von Google in den USA übertragen und dort gekürzt. Im Auftrag des Betreibers dieser Website wird Google diese Informationen benutzen, um Ihre Nutzung der Website auszuwerten, um Reports über die Websiteaktivitäten zusammenzustellen und um weitere mit der Websitenutzung und der Internetnutzung verbundene Dienstleistungen gegenüber dem Websitebetreiber zu erbringen. Die im Rahmen von Google Analytics von Ihrem Browser übermittelte IP-Adresse wird nicht mit anderen Daten von Google zusammengeführt.</p>

<p>Sie können die Speicherung der Cookies durch eine entsprechende Einstellung Ihrer Browser-Software verhindern; wir weisen Sie jedoch darauf hin, dass Sie in diesem Fall gegebenenfalls nicht sämtliche Funktionen dieser Website vollumfänglich werden nutzen können. Sie können darüber hinaus die Erfassung der durch das Cookie erzeugten und auf Ihre Nutzung der Website bezogenen Daten (inkl. Ihrer IP-Adresse) an Google sowie die Verarbeitung dieser Daten durch Google verhindern, indem sie das unter dem folgenden Link verfügbare Browser-Plugin herunterladen und installieren: http://tools.google.com/dlpage/gaoptout?hl=de.</p>

<p>Auskunft, Löschung, Sperrung</p>

<p>Sie haben jederzeit das Recht auf unentgeltliche Auskunft über Ihre gespeicherten personenbezogenen Daten, deren Herkunft und Empfänger und den Zweck der Datenverarbeitung sowie ein Recht auf Berichtigung, Sperrung oder Löschung dieser Daten. Hierzu sowie zu weiteren Fragen zum Thema personenbezogene Daten können Sie sich jederzeit über die im Impressum angegeben Adresse des Webseitenbetreibers an uns wenden.</p>

 

<p>Quellenangabe: eRecht24, eRecht24 Datenschutzerklärung für Facebook, Datenschutzerklärung für Google Analytics, eRecht24 Datenschutzerklärung Google Adsense, Google +1 Bedingungen</p>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </div>
  </div>
</div><!--/datenschutz-->

<?php wp_footer(); ?>
</body>
</html>
