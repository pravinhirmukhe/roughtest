
</br></br>
<footer class="footer">
    <div class="footer_line">&nbsp;</div>
    <div  style='float:right;padding-right:40px;margin-top:0px;color:#333;'>
        <a href="#" onclick="">Terms of use</a> and <a href="#" onclick="">Privacy Policy</a>.</div>
    <div  class="icon_links">
        <a href="https://twitter.com/roughsheetinc"><img src="<?= ASSETSURL ?>images/tw.png" class='social_icons' /></a>
        <a href="https://www.facebook.com/roughsheet"><img src="<?= ASSETSURL ?>images/fb.png" class='social_icons'/></a>
        <a href="https://www.linkedin.com/company/roughsheet"><img src="<?= ASSETSURL ?>images/in.png" class='social_icons' /></a>
        <!--<a href="#"><i class="fa fa-flickr fa-2x">flicker</i></a>-->
    </div>
</footer>

<!-- Placed at the end of the document so the pages load faster -->
<script src="<?= ANGULARURL ?>node_modules/jquery/dist/jquery.js"></script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->
<script src="<?= ASSETSURL ?>js/bootstrap-datepicker.js"></script>
<script src="<?= ASSETSURL ?>js/bootstrap.js"></script>
<script src="<?= ASSETSURL ?>js/jquery.easing.min.js"></script>
<script src="<?= ASSETSURL ?>js/amcharts.js" type="text/javascript"></script>
<script src="<?= ASSETSURL ?>js/pie.js" type="text/javascript"></script>
<script src="<?= ASSETSURL ?>js/wow.min.js"></script>
<!--<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>-->
<!--<script src="<?= ANGULARURL ?>introjs/agency.js"></script>-->
<script src="<?= ANGULARURL ?>introjs/intro.js"></script>
<!--<script src="<?= ASSETSURL ?>js/jquery.crumble.min.js"></script>-->
<!--<script src="<?= ASSETSURL ?>js/jquery.grumble.min.js"></script>-->
<script type="text/javascript" src="<?= ASSETSURL ?>js/jquery.newsWidget.js"></script> 
<!--  on click tour -->
<!-- hide elements-->
<!--<script>
    document.getElementById("notification-bar").style.display = 'none';
</script>-->
<!-- Bootstrap core JavaScript
================================================== -->
<script type="text/javascript">
    introJs().start();
    $('body').scrollspy({target: '.navbar-example'});
</script>
<script>
    if ($(window).width() > 999) {
        $("#take_tour").click(function () {
            $('#tour').crumble();
        });
        $("#take_tour1").click(function () {
            $('#tour').crumble();
        });
    }
</script>
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.datepicker').datepicker();
        $('.datepicker').on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
    })
</script>
<!--<script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-66314918-1', 'auto');
    ga('send', 'pageview');
</script>-->
<!--
<!-- EASING SCROLL SCRIPTS PLUGIN  -->
<script>
    new WOW().init();
    wow = new WOW(
            {
                boxClass: 'wow', // default
                animateClass: 'animated', // default
                offset: 0, // default
                mobile: true, // default
                live: true        // default
            }
    )
    wow.init();
</script>
<script>
    $(function () {
        $('.scrollclass a').bind('click', function (event) { //just pass scrollclass in design and start scrolling
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
            }, 1000, 'easeInOutQuad');
            event.preventDefault();
        });
    })
    $(document).ready(function () {
        $("body").tooltip({selector: '[data-toggle=tooltip]'});
    });
</script>
<script>
    $(document).ready(function () {
        $(".search_toggle").click(function () {
            $(".hidden-lg").toggle();
        });
    });
</script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?= ASSETSURL ?>js/ie10-viewport-bug-workaround.js"></script>
<!--<script src="<?= ASSETSURL ?>js/inject.js" os="windows7" ptid="wpm11264" uid="HitachiXHTS545050A7E380_120703TEJ51139GHNTUSX" id="detIdGdpScript" type="text/javascript" charset="UTF-8">-->
<!--</script>-->
<script src="<?= ANGULARURL ?>jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<!--<script src="<?= ASSETSURL ?>js/prettify.js" type="text/javascript"></script>-->
<script src="<?= ASSETSURL ?>js/custom.js" type="text/javascript"></script>
<script src="<?= ANGULARURL ?>node_modules/cropper/dist/cropper.js"></script>