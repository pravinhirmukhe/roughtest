<!--<script src="https://code.jquery.com/jquery-1.12.3.js" type="text/javascript"></script>-->
<script src="<?= ADMINASSETS ?>js/jquery.min.js" type="text/javascript"></script>
<script src="<?= ADMINASSETS ?>js/iCheck/icheck.min.js" type="text/javascript"></script>
<script src="<?= ADMINASSETS ?>js/iCheck/js/custom.min.js" type="text/javascript"></script>
<script>
    $('input').iCheck();</script>
<script src="<?= ADMINASSETS ?>js/jquery.metisMenu.js" type="text/javascript"></script>
<script src="<?= ADMINASSETS ?>js/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="<?= ADMINASSETS ?>js/screenfull.js" type="text/javascript"></script>
<script src="<?= ADMINASSETS ?>js/pie-chart.js" type="text/javascript"></script>
<script src="<?= USERASSETS ?>js/Chart.js"></script>
<script src="<?= ADMINASSETS ?>js/skycons.js" type="text/javascript"></script>
<script src="<?= ADMINASSETS ?>js/jquery.nicescroll.js" type="text/javascript"></script>

<script src="<?= ADMINASSETS ?>js/select2.min.js"></script>

<script src="<?= ADMINASSETS ?>ckeditor/ckeditor.js"></script>
<script src="<?= ADMINASSETS ?>ckeditor/samples/js/sample.js"></script>
<script src="<?= ASSETSURL ?>js/bootstrap-datepicker.js"></script>
<!--<script src="<?= ADMINASSETS ?>js/multiple-select.js" type="text/javascript"></script>-->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
    $(function () {
        $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);
        if (!screenfull.enabled) {
            return false;
        }
        $('#toggle').click(function () {
            screenfull.toggle($('#container')[0]);
        });
    });
    $(document).ready(function () {
        //alert("ok head");

        $('.datepicker').datepicker();
            $('.datepicker').on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });
         $('#demo-pie-1').pieChart({

            barColor: '#3bb2d0',
            trackColor: '#eee',
            lineCap: 'round',
            lineWidth: 8,
            onStep: function (from, to, percent) {
                $(this.element).find('.pie-value').text(Math.round(percent) + '%');
            }
        });
        $('#demo-pie-2').pieChart({
            barColor: '#fbb03b',
            trackColor: '#eee',
            lineCap: 'butt',
            lineWidth: 8,
            onStep: function (from, to, percent) {
                $(this.element).find('.pie-value').text(Math.round(percent) + '%');
            }
        });
        $('#demo-pie-3').pieChart({
            barColor: '#ed6498',
            trackColor: '#eee',
            lineCap: 'square',
            lineWidth: 8,
            onStep: function (from, to, percent) {
                $(this.element).find('.pie-value').text(Math.round(percent) + '%');
            }
        });

        $('select, .select').select2();
    });

</script>
<script>
    payment = function () {
        $(".shortlist").
        var options = {
            "key": "" + pay.key_id,
            "amount": "" + (parseFloat(10) * 100) * 100, // 2000 paise = INR 20
            "name": "" + pay.name,
            "description": "Recruiter Payment",
            "image": site_url + "assets/images/" + pay.image,
            "handler": function (response) {
                payment_id = response.razorpay_payment_id;
                alert(payment_id);
//                    $('#register').submit();
            },
            "prefill": {
                "name": "",
                "email": "",
                "contact": ""
            },
            "notes": {
                "address": ""
            },
            "theme": {
                "color": "#449D44"
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
    }
</script>
<script type="text/javascript">
    var site_url = '<?= site_url() ?>';</script>
<!---->
<!--scrolling js-->
<script src="<?= ADMINASSETS ?>js/jquery.nicescroll.js"></script>
<script src="<?= ADMINASSETS ?>js/scripts.js"></script>
<!--//scrolling js-->
<script src="<?= ADMINASSETS ?>js/bootstrap.min.js"></script>
<!--puja-->
<!--<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>-->
<!--end-->
<script src="<?= ADMINASSETS ?>js/datatables/jquery.dataTables.min.js"></script>

<!--<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>-->
<!--<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>-->
<!--<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>-->
<!--<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>-->

<script src="<?= ADMINASSETS ?>js/datatables/jquery.dataTables.dtFilter.min.js"></script>


<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>-->

<!--<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>-->

<!--<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>-->

<script src="<?= ADMINASSETS ?>js/custom.js" type="text/javascript"></script>
<script src="<?= ADMINASSETS ?>jstree/jstree.min.js"></script>

<script src="<?= ADMINASSETS ?>js/moment.min.js"></script>
<script src="<?= ADMINASSETS ?>js/bootstrap-datetimepicker.min.js"></script>


