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
                        <div class="panel panel-default">
                            <div class="panel-heading" style="border-radius: 0px;padding: 0px">
                                <h3 class="panel-title pull-left" style="padding: 8px">System Group Menu Allocation <small>Menu Allocation</small></h3>
                                <div class="clearfix"></div>
                            </div>
                            <?php
                            $x = array();
                            if (isset($group->menu_ids)) {
                                $x = json_decode($group->menu_ids, true);
                            }
                            ?>
                            <form action="<?= site_url() ?>admin/Group-menu-alloc-save/<?= $id ?>" method="POST">
                                <div class="panel-body">
                                    <div id="jstree_demo_div">
                                        <ul>
                                            <?php foreach ($menus as $m) { ?>
                                                <li>
                                                    <a href="#" class="hvr-bounce-to-right <?php echo in_array($m->name . ":" . $m->id, $x) ? "jstree-clicked" : "" ?>  "><?= $m->name . ":" . $m->id ?></a>
                                                    <?php if (!empty($m->nodes)) { ?>
                                                        <ul>
                                                            <?php foreach ($m->nodes as $n) { ?>
                                                                <li><a href="#" class="hvr-bounce-to-right <?php echo in_array($n->name . ":" . $n->id, $x) ? "jstree-clicked" : "" ?>  "><?= $n->name . ":" . $n->id ?></a></li>
                                                            <?php } ?>
                                                        </ul>
                                                    <?php } ?>
                                                </li>
                                            <?php }
                                            ?>
                                        </ul>
                                    </div>
                                    <input type="hidden" name="menu_ids" id="menu_ids"/>
                                    <input type="hidden" name="group_id" value="<?= $id ?>"/>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                    <a href="<?php print base_url(); ?>admin/Users"><button type="button" class="btn default">Cancel</button></a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#jstree_demo_div').jstree({
            "checkbox": {
                three_state: false,
                two_state: false
            },
            'plugins': ["wholerow", "checkbox"]
        });
        $('#jstree_demo_div')
                // listen for event
                .on('changed.jstree', function (e, data) {
                    var i, j, r = [];
//                    data.rslt.obj.parents("li").each(function () {
//                        r.push($(this).children("a").text());
//                    });
                    for (i = 0, j = data.selected.length; i < j; i++) {
                        r.push(data.instance.get_node(data.selected[i]).text);
                        r.push(data.instance.get_node(data.instance.get_node(data.selected[i]).parent).text);
                    }

                    console.log(r);
                    $('#menu_ids').val(JSON.stringify(r));
                })
                // create the instance
                .jstree({'plugins': ["wholerow", "checkbox"]})
    });


</script>