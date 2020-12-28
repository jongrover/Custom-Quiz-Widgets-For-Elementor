URL=window.URL||window.webkitURL;var gumStream;var rec;var input;var AudioContext=window.AudioContext||window.webkitAudioContext;var audioContext;jQuery(function(){var recordingsList=jQuery('.recordingsList');var recordButton=jQuery('.recordButton');var stopButton=jQuery('.stopButton');var refParent;jQuery(document).on('click','.recordButton',function(event){event.preventDefault();var currentRecordButton=jQuery(this);var currentStopButton=jQuery(this).next();refParent=jQuery(this).parent();console.log('recordButton clicked');var constraints={audio:true,video:false}
currentRecordButton.prop('disabled',true);currentStopButton.prop('disabled',false);navigator.mediaDevices.getUserMedia(constraints).then(function(stream){console.log('getUserMedia() success, stream created, initializing Recorder.js ...');audioContext=new AudioContext();gumStream=stream;input=audioContext.createMediaStreamSource(stream);rec=new Recorder(input,{numChannels:1});rec.record();console.log('Recording started');}).catch(function(err){currentRecordButton.prop('disabled',false);currentStopButton.prop('disabled',true);});});jQuery(document).on('click','.stopButton',function(event){event.preventDefault();var currentStopButton=jQuery(this);var currentRecordButton=jQuery(this).prev();console.log('stopButton clicked');currentStopButton.prop('disabled',true);currentRecordButton.prop('disabled',false);rec.stop();gumStream.getAudioTracks()[0].stop();rec.exportWAV(createDownloadLink);});jQuery('.recordingsList').on('click','a',function(event){event.preventDefault();jQuery(this).parent().remove();});function createDownloadLink(blob){var recordingsList=refParent.find('.recordingsList');var url=URL.createObjectURL(blob);var au=document.createElement('audio');var li=document.createElement('li');var link=document.createElement('a');au.controls=true;au.src=url;link.href='#';link.innerHTML='&times;';li.appendChild(au);li.appendChild(link);recordingsList.append(li);}});