<script>
    $(document).ready(function () {
        var rows_selected = [];
        oTable = $('#getData').dataTable({
            "aaSorting": [[0, "asc"], [1, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "iDisplayLength": 10,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('admin/Admin_controller/getUserData') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                nRow.id = aData[0];
                nRow.className = "invoice_link";
                return nRow;
            },
            "aoColumns": [{'mRender': checkbox, "bSortable": false}, {"mRender": null},{"mRender": null},{"mRender": null}],
           
            "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
            }
        }).fnSetFilteringDelay().dtFilter([
        ], "footer");
    });
</script>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <!--banner-->	
        <?php $this->load->view('admin/layout/breadcrumb') ?>
        <!--//banner-->
        <!--content-->
        <div class="content-top">
            <div class="col-md-12">
                <div class="content-top-1 ">
                    <div class="table-responsive">
                        <form id="xform" onsubmit="return bulkDelete()">
                            <input type="hidden" name="key" value="UID"/>
                            <input type="hidden" name="tab" value="rs_login_table_1423552512"/>
                            <div class="panel panel-default">
                                <div class="panel-heading" style="border-radius: 0px;padding: 0px">
                                    <h3 class="panel-title pull-left" style="padding: 8px">Key Concepts<small></small></h3>
                                    <span class="pull-right btn-group">
                                        <button type="button" class="btn btn-default" onclick="oTable.fnDraw();" title="Refresh"><i class="fa fa-refresh"></i></button>
                                        
                                    </span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <br>
                                    <table id="getData" class="dataTable table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th style="min-width:10px;text-align: center;">
                                                    <input name="select_all" value="1" type="checkbox" class="select_all"/>
                                                </th>
                                                <th class="col-xs-2" style="width:80px;min-width:50px;">User Name</th>
                                                <th class="col-xs-2" style="width:80px;min-width:30px;text-align: center;">Account Type</th>
                                                <th class="col-xs-2" style="min-width:30px; width: 80px;text-align: center;">Privilage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot class="dtFilter">
                                            <tr class="active">
                                                <th style="min-width:30px; width: 30px; text-align: center;">
                                                    <!--<input name="select_all" value="1" type="checkbox" class="select_all"/>-->
                                                </th>
                                                <th class="col-xs-2" style="width:80px;min-width:30px;"></th>
                                                <th class="col-xs-2" style="min-width:30px; width: 80px; text-align: center;"></th>
                                                <th class="col-xs-2" style="min-width:30px; width: 80px; text-align: center;"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>  
                            </div>  
                        </form>
                    </div>  
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<script>
    function validateAlpha() {
        var textInput = document.getElementById("cname").value;
        textInput = textInput.replace(/[^A-Za-z ]/g, "");
        document.getElementById("cname").value = textInput;
    }
</script>