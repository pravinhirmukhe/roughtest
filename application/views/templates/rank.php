<hr>
<?php
if ($_REQUEST['domain'] == 'global') {
    $uid_data = $this->site->getAllUID();
} else {
    $friends_data_arr = $this->site->getFriendsAndRequests();
    $uid_data = json_decode($friends_data_arr['F_UID']);
}
$std_obj_marks = (array) $this->site->getRespectiveMarksArr($_REQUEST['type']);

//new
$type = $_REQUEST['type'];
$subid = $_REQUEST['subid'];
$type = $type . '_marks';

$temp_data = array();
$marks = array();
$temp_data = array();
foreach ($std_obj_marks as $key1 => $val1) {
    $marks = (array) $val1;
    foreach ($marks as $temp_uid => $data) {

    $temp_data[] = (array) json_decode($data);    //cumulative or global
}
}


$data2sort = array();
$temp_uids = array();
$tempInfo = array();
$sort = array();
    foreach ($temp_data as $key => $val) {
        $temp_data = null;
        $temp_data1 = $val;
        foreach($temp_data1 as $uid=>$data){
            $temp_uids[] = $uid;
            $other_data = (array)$data;
            foreach ($other_data as $k=>$v) {
               
                 if($k == $subid){
                    $sort[$subid][$k][] = $v;
                    $tempInfo['subject'][] = $k;
                    if($v != null){
                        $tempInfo['marks'][] = $v;
                    }
                    $tempInfo['uid'][] = $uid;
                    
                 }
            }
           
        }
    }
   array_multisort($sort[$subid][$subid], SORT_DESC, $temp_uids);
    


    //$filtered_uid_arr = $tempInfo['uid'];
   $filtered_uid_arr = $temp_uids;
   $marks_count = count($tempInfo['marks']);
    
    $rank_limit = 10; //ranks to dispaly
    $current_rank = 1; //rank start from 1
    $arr_count = count($filtered_uid_arr);
    $last_marks = -100; //just a start

//

// old
// $marks = array();
//  foreach ($std_obj_marks as $key1 => $val1) {
//    $marks[$key1] = (array) $val1;
//}
//$subid = $_REQUEST['subid'];
//$filtered_uid_arr = array();
//$data2sort = array();
//foreach ($marks as $temp_uid => $data) {
//    $temp_data = null;
//    $temp_data = (array) $data;
//    
//    foreach ($temp_data as $key => $val) {
//        if ($key == $subid) {
//            $data2sort[$temp_uid] = $temp_data[$subid];
//            $filtered_uid_arr[] = $temp_uid; //fileterd for the particular subject
//        }
//    }
//}
//
//
//array_multisort($data2sort, SORT_DESC, $filtered_uid_arr);
//$rank_limit = 10; //ranks to dispaly
//$current_rank = 1; //rank start from 1
//$arr_count = count($filtered_uid_arr);
//$last_marks = -100; //just a start
?>
<table class="table table-bordered">
    <?php
    if ($arr_count != 0 && $marks_count !=0) {
        for ($i = 0; $i < $marks_count; $i++) {
            if ($current_rank > $rank_limit) {
                break;
            } else {
                $current_user = $filtered_uid_arr[$i];
                $f_d_fetch = $this->site->getUserInfo($current_user);
               
                //for the rowspan value we can check in data2sort array that how many of such marks entries are present for that subject 
//                if ($last_marks != $data2sort[$current_user]) {
//                    $last_marks = $data2sort[$current_user];
                    ?>
                    <tr><td>Rank <?php echo $current_rank; ?></td><td>
                            <div class='media col-md-6' style='padding:0px;box-shadow:0 0 15px #e7e7e7;border-radius:50px 0px 0px 50px;'>
                                <div class='media-left'>
                                    <img class='media-object f_pic wow rotateIn' src='<?= IMGURL ?><?php echo $f_d_fetch['UID_Pro_Pic']; ?>' width='84' height='84'>
                                </div>
                                <div class='media-body wow rollIn' style='padding:3px;'>
                                    <a href='#/profile/<?= $f_d_fetch['UID'] ?>'><h4 class='media-heading'><?php echo "$f_d_fetch[UID_FirstName] $f_d_fetch[UID_MiddleName] $f_d_fetch[UID_LastName]"; ?></h4></a>
                                    <div id='button_<?php echo $f_d_fetch['UID']; ?>'>
                                        <button class='btn btn-default' href='#/profile/<?php echo $f_d_fetch['UID']; ?>'>View Profile</button>
                                    </div>
                                </div></div>
                        </td></tr>
                    <?php
                    $current_rank++;

            }
        }
    } else {
        ?>
        <tr><td>Ranks not calculated yet.</td></tr>
        <?php
    }
    ?>
</table>