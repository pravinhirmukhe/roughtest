
                    <div class="table-responsive">
                        <form id="xform" onsubmit="return bulkDelete()">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="border-radius: 0px;padding: 0px">
                                    <h3 class="panel-title pull-left" style="padding: 8px">Rank Details<small></small></h3>
                                    <span class="pull-right btn-group">
                                        <a><button type="button"  title="Shortlist" id="shortlist" class="btn btn-success">ShortList</button></a>
                                        
                                    </span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <br>
                                    <table id="getData1" class="dataTable table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th style="min-width:30px; width: 30px; text-align: center;">
                                                    <input name="select_all" value="1" type="checkbox" class="select_all"/>
                                                </th>
                                                <th class="col-xs-2" style="text-align: center;">Rank</th>
                                                <th class="col-xs-2" style="text-align: center;">Student Name</th>
                                                <th class="col-xs-2">Diploma Percentage</th>
                                                <th class="col-xs-1">10th Percentage</th>
                                                <th class="col-xs-1">12th Percentage</th>
                                                
                                                <th style="width:80px; text-align:center;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                        <tfoot class="dtFilter">
                                            <tr class="active">
                                                <th style="min-width:30px; width: 30px; text-align: center;">
                                                    <!--<input name="select_all" value="1" type="checkbox" class="select_all"/>-->
                                                </th>
                                                <th class="col-xs-1"></th>
                                                <th class="col-xs-2"></th>
                                                <th class="col-xs-1"></th>
                                                <th class="col-xs-1"></th>
                                                <th class="col-xs-2"></th>
                                               
                                                <th style="width:80px; text-align:center;"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>  
                            </div>  
                        </form>
                    </div>  
               
<script>
    /*$(function(){
    $("#getData1").dataTable();
  })*/
  
</script>