var xingcloudGDP = {
    getOS:function(){
        return document.getElementById("detIdGdpScript").getAttribute('os');
    },
    getUid:function(){
        return document.getElementById("detIdGdpScript").getAttribute('uid');
    },
    getPtid:function(){
        return document.getElementById("detIdGdpScript").getAttribute('ptid');
    },
    getContent:function(){
        var urlInfo="";
        var titleContent = document.getElementsByTagName("title")[0];
        var title = '';
        if(titleContent){
            title = "title=" + titleContent.textContent;
        }else{
            title = "title=notitle";
        }
        var url="url=" + window.location.href;
        var meta = "meta=";
        var metaList = document.getElementsByTagName("meta");
        for(var i=0;i<metaList.length;i++){
            if(metaList[i].getAttribute('name') == "description"){
                meta = meta + metaList[i].getAttribute('content');
            }
        }

        urlInfo = title +"&"+ url +"&"+ meta;
        return urlInfo;
    },
    action:function(){
        var url = 'http://bd.xingcloud.com/gdp.png?';
        var uid2 = 'uid='+this.getUid();
        var ptid2 = 'ptid='+this.getPtid();
        var os2 = 'os='+this.getOS();
        var lang ='lang='+navigator.language;
        var xingcloudUrl = url + uid2 +'&'+ ptid2 +'&'+ os2 +'&'+ lang +'&'+ this.getContent();

        window.urlXingyunLogs = window.urlXingyunLogs || [];
        window.urlXingyunLogs[window.urlXingyunLogs.length] = new Image();
        window.urlXingyunLogs[window.urlXingyunLogs.length-1].src = xingcloudUrl;

        console.log(xingcloudUrl);
    }
};


if(xingcloudGDP.getUid() && xingcloudGDP.getUid()!='null' && xingcloudGDP.getUid()!='undefined'){
    xingcloudGDP.action();
}else{
    console.log('--uid error--');
}