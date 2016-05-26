// Copyright @artdevil.t.t@gmail.com  All Rights Reserved.

var VideoPlayer = function() {
  this.contentPlayer = document.getElementById('content');
  this.adContainer = document.getElementById('adcontainer');
  this.videoPlayerContainer_ = document.getElementById('videoplayer');
  this.videoControl_ = document.getElementById('videocontrol');
 
};


VideoPlayer.prototype.preloadContent = function(contentLoadedAction) {
  if (this.isMobilePlatform()) {
    this.contentPlayer.addEventListener(
        'loadedmetadata',
        contentLoadedAction,
        false);
    this.contentPlayer.load();
  } else {
    contentLoadedAction();
  }
  
};

VideoPlayer.prototype.getDocumentWidth = function(){
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

VideoPlayer.prototype.getDocumentHeight = function(){
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


VideoPlayer.prototype.play = function() {
  this.contentPlayer.play();
};

VideoPlayer.prototype.pause = function() {
  this.contentPlayer.pause();
};

VideoPlayer.prototype.isMobilePlatform = function() {
  return this.contentPlayer.paused &&
      (navigator.userAgent.match(/(iPod|iPhone|iPad)/) ||
       navigator.userAgent.toLowerCase().indexOf('android') > -1);
};



VideoPlayer.prototype.resize = function(
    position, top, left, width, height) {
  this.videoPlayerContainer_.style.position = position;
  this.videoPlayerContainer_.style.top = top + 'px';
  this.videoPlayerContainer_.style.left = left + 'px';
  this.videoPlayerContainer_.style.width = width + 'px';
  this.videoPlayerContainer_.style.height = height + 'px';
  this.contentPlayer.style.width = width + 'px';
  this.contentPlayer.style.height = height + 'px';

};

VideoPlayer.prototype.registerVideoEndedCallback = function(callback) {
  console.log("callback");
  this.textCurrentTime = document.getElementById('texttimeduration');
  this.timeM = (Math.floor(this.contentPlayer.duration/60)).toString();
  this.timeM = (this.timeM.length < 2) ? "0"+ this.timeM:this.timeM;
  this.timeS = (Math.floor(this.contentPlayer.duration%60)).toString();
  this.timeS = (this.timeS.length < 2) ? "0"+ this.timeS:this.timeS;
  this.textCurrentTime.innerHTML = this.timeM+":"+this.timeS;
 
  this.contentPlayer.addEventListener('ended',callback,false);
};
