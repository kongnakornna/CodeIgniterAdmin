// Copyright @artdevil.t.t@gmail.com  All Rights Reserved.

var Application = function() {
  rssdata = [];
  this.statusApplication = "ready";
  this.related = document.getElementById('related');
  this.contentPlayer = document.getElementById('content');
  this.videocontrol = document.getElementById('videocontrol');
  this.barbuffer = document.getElementById('barbuffer');

  this.slidebar = document.getElementById('slidebar');
  this.slidebar.setAttribute("style","width:"+(this.getDocumentWidth()-220)+"px");
  
  this.barseek = document.getElementById('barseek');
  this.barseek.addEventListener('click',function(event){
      this.barPlaying = document.getElementById('barplaying');
      this.contentPlayer = document.getElementById('content');
      this.percent = Math.floor(((event.clientX-110)/this.clientWidth)*100);
      this.contentPlayer.currentTime = (this.contentPlayer.duration/100)*this.percent;
  },false);
  
  this.playStart_ = document.getElementById('playstart');
  this.playStart_.addEventListener(
      'click',
      this.bind_(this, this.onClick_),
      false);
  this.playButton_ = document.getElementById('playpause');
  this.playButton_.addEventListener(
      'click',
      this.bind_(this, this.onClick_),
      false);
  this.playSkipad_ = document.getElementById('skipad');
  
  this.fullscreenButton_ = document.getElementById('fullscreen');
  this.fullscreenButton_.addEventListener(
      'click',
      this.bind_(this, this.onFullscreenClick_),
      false);

  this.fullscreenWidth = null;
  this.fullscreenHeight = null;

  var fullScreenEvents = [
      'fullscreenchange',
      'mozfullscreenchange',
      'webkitfullscreenchange'];
  for (key in fullScreenEvents) {
    document.addEventListener(
        fullScreenEvents[key],
        this.bind_(this, this.onFullscreenChange_),
        false);
  }

  this.playing_ = false;
  this.adsActive_ = false;
  this.adsDone_ = false;
  this.fullscreen = false;

  this.videoPlayer_ = new VideoPlayer();
  
  this.ads_ = new Ads(this, this.videoPlayer_);
  this.adTagUrl_ = '';
  this.adTagOverlayUrl_ = "";

  this.videoPlayer_.registerVideoEndedCallback(
      this.bind_(this, this.onContentEnded_));
      
  this.contentPlayer.addEventListener("timeupdate", function(){
      this.textCurrentTime = document.getElementById('texttimecurrent');
      this.timeM = (Math.floor(this.currentTime/60)).toString();
      this.timeM = (this.timeM.length < 2) ? "0"+ this.timeM:this.timeM;
      this.timeS = (Math.floor(this.currentTime%60)).toString();
      this.timeS = (this.timeS.length < 2) ? "0"+ this.timeS:this.timeS;
      this.textCurrentTime.innerHTML = this.timeM+":"+this.timeS;
      
      this.barPlaying = document.getElementById('barplaying');
      this.barPlaying.setAttribute("style","width:"+Math.floor(this.currentTime/this.duration*100)+"%");
  },false);
  
  var thisOnTime = function(){
        this.contentPlayer = document.getElementById('content');
		try{
        	this.barbuffer.setAttribute("style","width:"+Math.floor(this.contentPlayer.buffered.end(0)/this.contentPlayer.duration*100)+"%")
		}catch(err){
			console.log("my error : ",err);
		}
        if(this.contentPlayer.buffered.end(0) < this.contentPlayer.duration){
            window.setTimeout(thisOnTime, 1000);
        }
    }
    window.setTimeout(thisOnTime, 1000);
    this.resize();
};


Application.prototype.log = function(message) {
  console.log("log :"+ message);
};

Application.prototype.resumeAfterAd = function() {
  this.videoPlayer_.play();
  this.adsActive_ = false;
  this.updateChrome_();
  this.statusApplication = "video";
  this.resize();
};

Application.prototype.pauseForAd = function() {
  this.adsActive_ = true;
  this.playing_ = true;
  this.videoPlayer_.pause();
  this.updateChrome_();
};

Application.prototype.adClicked = function() {
  this.updateChrome_();
};

Application.prototype.bind_ = function(thisObj, fn) {
  return function() {
    fn.apply(thisObj, arguments);
  };
};

Application.prototype.resize = function() {
    
    //this.videoPlayer_.width = this.getDocumentWidth();
    //this.videoPlayer_.height = document.body.clientHeight;
    console.log("status : "+this.statusApplication);
    if(this.statusApplication == "ready"){
        this.videoPlayer_.width = this.getDocumentWidth();
        this.videoPlayer_.height = this.getDocumentHeight();
        this.ads_.resize(this.getDocumentWidth(),this.getDocumentHeight());
        
        this.videoPlayer_.resize('relative','','',
            this.getDocumentWidth(),
            this.getDocumentHeight());
            this.videocontrol.setAttribute("style","visibility: hidden");
            this.playStart_.setAttribute("style","left:"+((this.getDocumentWidth()-70)/2)+"px;top:"
                    +((this.getDocumentHeight()-70)/2)+"px; visibility: visible");
            this.playSkipad_.setAttribute("style","visibility: hidden");
            
    }else if(this.statusApplication == "ad"){
        this.videoPlayer_.width = this.getDocumentWidth();
        this.videoPlayer_.height = this.getDocumentHeight();
        this.ads_.resize(this.getDocumentWidth(),this.getDocumentHeight());
        this.videoPlayer_.resize('relative','','',
            this.getDocumentWidth(),
            this.getDocumentHeight());
            this.videocontrol.setAttribute("style","visibility: hidden");
            this.playStart_.setAttribute("style","visibility: hidden");

    }else{
        this.videoPlayer_.width = this.getDocumentWidth();
        this.videoPlayer_.height = this.getDocumentHeight()- this.videocontrol.clientHeight;
        this.ads_.resize(this.getDocumentWidth(),this.getDocumentHeight()- this.videocontrol.clientHeight);
        this.videoPlayer_.resize('relative','','',
            this.getDocumentWidth(),
            this.getDocumentHeight() - this.videocontrol.clientHeight);
            this.videocontrol.setAttribute("style","visibility: visible");
            this.playStart_.setAttribute("style","visibility: hidden");
            this.playSkipad_.setAttribute("style","visibility: hidden");
        
    }
    
    this.slidebar.setAttribute("style","width:"+(this.getDocumentWidth()-220)+"px");
    
};


Application.prototype.getDocumentWidth = function(){
  var myWidth = 0, myHeight = 0;
  if( typeof( window.innerWidth ) == 'number' ) {
    myWidth = window.innerWidth;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    myWidth = document.documentElement.clientWidth;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    myWidth = document.body.clientWidth;
  }
  return myWidth;
};

Application.prototype.getDocumentHeight = function(){
  var myWidth = 0, myHeight = 0;
  if( typeof( window.innerWidth ) == 'number' ) {
    myHeight = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    myHeight = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    myHeight = document.body.clientHeight;
  }
  return myHeight;
};


Application.prototype.onClick_ = function() {
  this.related.setAttribute("style","visibility: hidden");
  this.contentPlayer.setAttribute("style","visibility: visible");	
  if (!this.adsDone_) {
    this.ads_.initialUserAction();
    this.videoPlayer_.preloadContent(this.bind_(this, this.loadAds_));
    this.adsDone_ = true;
    return;
  }

  if (this.adsActive_) {
    if (this.playing_) {
      this.ads_.pause();
    } else {
      this.ads_.resume();
    }
  } else {
    if (this.playing_) {
      this.ads_.requestAdsOverlay(this.adTagOverlayUrl_);
      this.videoPlayer_.pause();
    } else {
      this.videoPlayer_.play();
    }
  }
  this.playing_ = !this.playing_;
  this.updateChrome_();
};

Application.prototype.onSkipAd_ = function() {
    this.ads_.skip();
};

Application.prototype.onFullscreenClick_ = function() {
  if (this.fullscreen) {
    // The video is currently in fullscreen mode
    var cancelFullscreen = document.exitFullscreen ||
        document.exitFullScreen ||
        document.webkitCancelFullScreen ||
        document.mozCancelFullScreen;
    if (cancelFullscreen) {
      cancelFullscreen.call(document);
    } else {
      this.onFullscreenChange_();
    }
  } else {
    // Try to enter fullscreen mode in the browser
    var requestFullscreen = document.documentElement.requestFullscreen ||
        document.documentElement.webkitRequestFullscreen ||
        document.documentElement.mozRequestFullscreen ||
        document.documentElement.requestFullScreen ||
        document.documentElement.webkitRequestFullScreen ||
        document.documentElement.mozRequestFullScreen;
    if (requestFullscreen) {
      this.fullscreenWidth = window.screen.width;
      this.fullscreenHeight = window.screen.height;
      requestFullscreen.call(document.documentElement);
    } else {
      this.fullscreenWidth = window.innerWidth;
      this.fullscreenHeight = window.innerHeight;
      this.onFullscreenChange_();
    }
  }
  requestFullscreen.call(document.documentElement);
};

Application.prototype.updateChrome_ = function() {
  if (this.playing_) {
    this.playButton_.textContent = 'II';
  } else {
    // Unicode play symbol.
    this.playButton_.textContent = String.fromCharCode(9654);
  }
};

Application.prototype.loadAds_ = function() {
  this.ads_.requestAds(this.adTagUrl_);
};

Application.prototype.onFullscreenChange_ = function() {
  if (this.fullscreen) {
    this.ads_.resize(this.videoPlayer_.width,this.videoPlayer_.height);
    //this.videoPlayer_.resize('relative','','',this.videoPlayer_.width,this.videoPlayer_.height);
    this.resize();
    this.fullscreen = false;
  } else {
    var width = this.fullscreenWidth;
    var height = this.fullscreenHeight;
    this.makeAdsFullscreen_();
    //this.videoPlayer_.resize('absolute', 0, 0, width, height);
    this.resize();
    this.fullscreen = true;
  }
};

Application.prototype.makeAdsFullscreen_ = function() {
  this.ads_.resize(
      this.fullscreenWidth,
      this.fullscreenHeight);
};

Application.prototype.onContentEnded_ = function() {
  this.ads_.contentEnded();
  this.playing_ = false;
  this.adsActive_ = false;
  this.adsDone_ = false;
  this.fullscreen = false;
  
  if(rssdata.length > 0){
	this.related.setAttribute("style","visibility: visible");	
	this.contentPlayer.setAttribute("style","visibility: hidden");	
  }else{
  	v = this.contentPlayer.currentSrc;
  	this.contentPlayer.src = "";
  	this.contentPlayer.src = v;
	
  }
  this.playStart_.innerHTML = "&#8634;";
  this.playStart_.setAttribute("style","visibility: visible");
  this.statusApplication = "ready";
  this.resize();
  this.ads_.contentCompleteCalled_ = false;
};

Application.prototype.countdownAd = function(myApplication){
    var remaining = 7;
    this.playSkipad_.setAttribute("style","visibility:visible;font-size:12px;");
    this.playSkipad_.removeEventListener('click',myApplication.bind_(myApplication, myApplication.onSkipAd_),false);
    var countTimeAd = function(){
        console.log("countdown");
        this.playSkipad_ = document.getElementById('skipad');
        this.playSkipad_.innerHTML = "You can skip to video in "+ remaining;
        //remaining = remaining-1;
        if(remaining  > 0){
            window.setTimeout(countTimeAd, 1000);
        }else{
            this.playSkipad_.setAttribute("style","visibility:visible;font-size:18px;");
            this.playSkipad_.innerHTML = "Skip Ad >>";
            this.playSkipad_.addEventListener('click',myApplication.bind_(myApplication, myApplication.onSkipAd_),false);
        
        }
        remaining = remaining-1;
    }
    countTimeAd();
    
};

Application.prototype.relatedAPI = function(myURL){
	
	if (window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
    }else{
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.open("GET",myURL,false);
    xmlhttp.send();
    
	if (window.DOMParser){
		console.log("parser string");
        parser=new DOMParser();
		xmlDoc = parser.parseFromString(xmlhttp.responseText,"text/xml");
    }else{
		console.log("parser Microsoft.XMLDOM");
        xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
		xmlDoc.async = false;
		xmlDoc.loadXML(xmlhttp.responseText);
    }

	var arrayXMLDoc = xmlDoc.getElementsByTagName("item");
   	for(i=0;i< arrayXMLDoc.length;i++){
		var thisxml = arrayXMLDoc[i];
		var thisdata  = [];
		thisdata['thumb'] =  $(thisxml).find("media\\:thumbnail, thumbnail").attr("url");
		thisdata['linkurl'] = thisxml.getElementsByTagName("link")[0].childNodes[0].nodeValue;
		thisdata['title'] = thisxml.getElementsByTagName("title")[0].childNodes[0].nodeValue;
		rssdata.push(thisdata);
	}
    createRelated();
} 

function createRelated(){
	var htmlrelated = '<div id="relatedbackground"></div>';
	htmlrelated = htmlrelated + '<div id="relatedarea" align="center">';
	for(i=0;i<rssdata.length;i++){
		htmlrelated = htmlrelated + '<a href="'+rssdata[i]['linkurl']+'" target="_blank"> ';
		htmlrelated = htmlrelated + '<img id="relatedimage" src="'+rssdata[i]['thumb']+'" alt="'+rssdata[i]['title']+'"> ';
		htmlrelated = htmlrelated + '</a> ';
	}
	htmlrelated = htmlrelated + '</div>';
	this.related.innerHTML = htmlrelated;
	console.log("related : ",rssdata);	
}