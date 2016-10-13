function getGraph(subid)
{
    $("#perf_graph").html("<img src='assets/images/hex-loader2.gif' />");
    $.ajax
            ({
                type: "POST",
                url: "app/includes/set.php?getGraph",
                data: "subid=" + subid,
                success: function (result)
                {
                    $("#perf_graph").html("<center><a href=# onclick=changePerfMonth(" + subid + ",'PREVIOUS') >Previous</a>  <a href=# onclick=changePerfMonth(" + subid + ",'NEXT') >Next</a></center>" + result);
                    getRankGraphs(subid);
                    getRankGraphPC(subid);
//			    getRankGraphW(subid);
//			    getRankGraphC(subid);

                }
            });
}

function changePerfMonth(subid, type) {
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?changePerfMonth",
        data: {
            "subid": subid,
            "type": type
        },
        success: function (result) {
            getGraph(subid);
        }
    });
}

function getRankGraphs(subid) {
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?getRankGraph",
        data: "subid=" + subid,
        success: function (result) {
            $("#perf_graph_pw").html("Percentile Weekly" + result);
        }
    });
}

function getRankGraphPC(subid) {
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?getRankGraphPC",
        data: "subid=" + subid,
        success: function (result) {
            $("#perf_graph_pc").html("Percentile Cumulative" + result);
        }
    });
}

function getRankGraphW(subid) {
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?getRankGraphW",
        data: "subid=" + subid,
        success: function (result) {
            $("#perf_graph_w").html("Weekly" + result);
        }
    });
}
function getRankGraphC(subid) {
    $.ajax({
        type: "POST",
        url: "app/includes/set.php?getRankGraphC",
        data: "subid=" + subid,
        success: function (result) {
            $("#perf_graph_c").html("Cumulative" + result);
        }
    });
}