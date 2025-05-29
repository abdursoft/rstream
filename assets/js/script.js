// podcast player script 
let audio,sound,duration,progress,currentTime,mute,playlist,largePlayer,list,currentIndex;

// init audio player 
function __podcastInit(src){
    if(audio){
        audio.src = src;
        audio.play();
    }else{
        audio = new Audio(src);
        if(audio.canPlayType){
            audio.play();
        }
    }
}

// toggle play pause 
function __togglePlayPause(){
    if(audio.paused){
        audio.play();
    }else{
        audio.pause();
    }
}

// forward 15 seconds 
function durationSeek(time){
    if(audio){
        audio.currentTime + time;
    }
}

// move to next content 
function moveNext(){
    if(playlist.length > currentIndex){
        currentIndex++;
    }else{
        currentIndex = 0;
    }
}

// move to previous content 
function movePrevious(){
    if(currentIndex > 0){
        currentIndex--;
    }else{
        currentIndex = 0;
    }  
}

// toggle podcast playlist
function togglePlaylist(){

}

// toggle large player 
function toggleLargePlayer(){
    
}