var APIKey = document.currentScript.getAttribute('APIKey');
var currentLog = {};

var timer1 = {};
var timer2 = {};
var timer3 = {};

load('//freegeoip.net/json/',function(data,status){
   try{
       currentLog =  JSON.parse(data);
       currentLog.URL = window.location.href;
       currentLog.APIKey = APIKey;
       LogFirst();
       window.onfocus = function () {
            timer1.resume();
            timer2.resume();
            timer3.resume();
        }; 

        window.onblur = function () {
            timer1.pause();
            timer2.pause();
            timer3.pause();
        };
       LogTenSeconds();
       LogThirtySeconds();
       LogThreeMins();
       
   }
   catch(e){
       console.log(e)
   }
});



function LogFirst(){
    PostLog('http://localhost/SuperArdorAnalytics/index.php/Logger/AddInitiallog/',currentLog,function(data,status){
        currentLog.key = JSON.parse(data);    
  });
}

function LogTenSeconds(){
  timer1 = new Timer(function(){
    PostLog('http://localhost/SuperArdorAnalytics/index.php/Logger/LogTenSeconds/',currentLog,function(data,status){
            
    })
  }, 10000);
}

function LogThirtySeconds(){
  timer2 = new Timer(function(){
    PostLog('http://localhost/SuperArdorAnalytics/index.php/Logger/LogThirtySeconds/',currentLog,function(data,status){
           
    })
  }, 30000);
}

function LogThreeMins(){
  timer3 = new Timer(function(){
    PostLog('http://localhost/SuperArdorAnalytics/index.php/Logger/LogThreeMins/',currentLog,function(data,status){
           
    })
  }, 300000);
}

//helper methods -----------------------------------------------------------
//--------------------------------------------------------------------------
function PostLog(url,data,callback){
    var uploadData = toQueryString(data);
    var xmlhttp = new XMLHttpRequest();   // new HttpRequest instance 
    
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4) {
          //console.log(xhr.response,xhr.readyState); //Outputs a DOMString by default
          callback(xmlhttp.response,xmlhttp.readyState);
        }
    }
    
    xmlhttp.open("POST", url);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(uploadData);
}

function load(url, callback) {
  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      callback(xhr.response,xhr.readyState);
    }
  };
  xhr.open('GET', url, true);
  xhr.send('');
  
}

function toQueryString(obj) {
    var parts = [];
    for (var i in obj) {
        if (obj.hasOwnProperty(i)) {
            parts.push(encodeURIComponent(i) + "=" + encodeURIComponent(obj[i]));
        }
    }
    return parts.join("&");
}

function Timer(callback, delay) {
    var timerId, start, remaining = delay;

    this.pause = function() {
        window.clearTimeout(timerId);
        remaining -= new Date() - start;
        
    };

    this.resume = function() {
        start = new Date();
        window.clearTimeout(timerId);
        timerId = window.setTimeout(callback, remaining);
        
    };

    this.resume();
    
}
