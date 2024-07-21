// Javascriptcontrolling collapsible panels
cStart = "a";
cFinish = "z";
nStart = "0";
nFinish = 100;  // reserve 90-100 for special use
function expandDiv(curobj,which){trig=document.getElementById(which).style.display;if(trig=="block"){trig="none";}else if(trig=="" || trig=="none"){trig="block";}  document.getElementById(which).style.display=trig;}
function DivExists(id){if(!!document.getElementById(id)) return 1;  return 0;}
function ChangeShowEach(id, displayType){if(DivExists(id)==1) document.getElementById(id).style.display = displayType;}
function ChangeShowAll(displayType){for(i=cStart.charCodeAt(0); i<= cFinish.charCodeAt(0);i++){c = String.fromCharCode(i);for(j=nStart; j<=nFinish;j++){id = `${c}${j}`;ChangeShowEach(id, displayType)}}}
function DoShow(){ChangeShowAll("block");}
function DoHide(){ChangeShowAll("none");}
function ChangeShow(onAr){DoHide(); for(i=0;i<onAr.length;i++) ChangeShowEach(onAr[i], "block");}
