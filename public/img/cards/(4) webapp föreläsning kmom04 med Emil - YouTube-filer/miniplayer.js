(function(g){var window=this;'use strict';var c4=function(a){g.V.call(this,{G:"div",L:"ytp-miniplayer-ui"});this.We=!1;this.player=a;this.T(a,"minimized",this.eh);this.T(a,"onStateChange",this.nJ)},d4=function(a){g.aK.call(this,a);
this.j=new c4(this.player);this.j.hide();g.CJ(this.player,this.j.element,4);a.Bf()&&(this.load(),g.O(a.getRootNode(),"ytp-player-minimized",!0))};
g.w(c4,g.V);g.h=c4.prototype;
g.h.SG=function(){this.tooltip=new g.ZN(this.player,this);g.H(this,this.tooltip);g.CJ(this.player,this.tooltip.element,4);this.tooltip.scale=.6;this.Dc=new g.XK(this.player);g.H(this,this.Dc);this.Hh=new g.V({G:"div",L:"ytp-miniplayer-scrim"});g.H(this,this.Hh);this.Hh.Ba(this.element);this.T(this.Hh.element,"click",this.xC);var a=new g.V({G:"button",Ea:["ytp-miniplayer-close-button","ytp-button"],W:{"aria-label":"St\u00e4ng"},U:[g.cH()]});g.H(this,a);a.Ba(this.Hh.element);this.T(a.element,"click",
this.Gj);a=new g.l_(this.player,this);g.H(this,a);a.Ba(this.Hh.element);this.gr=new g.V({G:"div",L:"ytp-miniplayer-controls"});g.H(this,this.gr);this.gr.Ba(this.Hh.element);this.T(this.gr.element,"click",this.xC);var b=new g.V({G:"div",L:"ytp-miniplayer-button-container"});g.H(this,b);b.Ba(this.gr.element);a=new g.V({G:"div",L:"ytp-miniplayer-play-button-container"});g.H(this,a);a.Ba(this.gr.element);var c=new g.V({G:"div",L:"ytp-miniplayer-button-container"});g.H(this,c);c.Ba(this.gr.element);this.kQ=
new g.xM(this.player,this,!1);g.H(this,this.kQ);this.kQ.Ba(b.element);b=new g.vM(this.player,this);g.H(this,b);b.Ba(a.element);this.nextButton=new g.xM(this.player,this,!0);g.H(this,this.nextButton);this.nextButton.Ba(c.element);this.Kh=new g.LN(this.player,this);g.H(this,this.Kh);this.Kh.Ba(this.Hh.element);this.Mc=new g.HM(this.player,this);g.H(this,this.Mc);g.CJ(this.player,this.Mc.element,4);this.mC=new g.V({G:"div",L:"ytp-miniplayer-buttons"});g.H(this,this.mC);g.CJ(this.player,this.mC.element,
4);a=new g.V({G:"button",Ea:["ytp-miniplayer-close-button","ytp-button"],W:{"aria-label":"St\u00e4ng"},U:[g.cH()]});g.H(this,a);a.Ba(this.mC.element);this.T(a.element,"click",this.Gj);a=new g.V({G:"button",Ea:["ytp-miniplayer-replay-button","ytp-button"],W:{"aria-label":"St\u00e4ng"},U:[g.iH()]});g.H(this,a);a.Ba(this.mC.element);this.T(a.element,"click",this.rZ);this.T(this.player,"presentingplayerstatechange",this.Sc);this.T(this.player,"appresize",this.xb);this.T(this.player,"fullscreentoggled",
this.xb);this.xb()};
g.h.show=function(){this.ze=new g.up(this.gs,null,this);this.ze.start();this.We||(this.SG(),this.We=!0);0!==this.player.getPlayerState()&&g.V.prototype.show.call(this);this.Mc.show();this.player.unloadModule("annotations_module")};
g.h.hide=function(){this.ze&&(this.ze.dispose(),this.ze=void 0);g.V.prototype.hide.call(this);this.player.Bf()||(this.We&&this.Mc.hide(),this.player.loadModule("annotations_module"))};
g.h.qa=function(){this.ze&&(this.ze.dispose(),this.ze=void 0);g.V.prototype.qa.call(this)};
g.h.Gj=function(){this.player.stopVideo();this.player.Oa("onCloseMiniplayer")};
g.h.rZ=function(){this.player.playVideo()};
g.h.xC=function(a){if(a.target===this.Hh.element||a.target===this.gr.element)this.player.V().N("kevlar_miniplayer_play_pause_on_scrim")?g.eG(this.player.yb())?this.player.pauseVideo():this.player.playVideo():this.player.Oa("onExpandMiniplayer")};
g.h.eh=function(){g.O(this.player.getRootNode(),"ytp-player-minimized",this.player.Bf())};
g.h.Wd=function(){this.Mc.Tb();this.Kh.Tb()};
g.h.gs=function(){this.Wd();this.ze&&this.ze.start()};
g.h.Sc=function(a){g.U(a.state,32)&&this.tooltip.hide()};
g.h.xb=function(){g.XM(this.Mc,0,this.player.Ya().getPlayerSize().width,!1);g.KM(this.Mc)};
g.h.nJ=function(a){this.player.Bf()&&(0===a?this.hide():this.show())};
g.h.pc=function(){return this.tooltip};
g.h.Jf=function(){return!1};
g.h.jg=function(){return!1};
g.h.Bj=function(){return!1};
g.h.yz=function(){};
g.h.ap=function(){};
g.h.uu=function(){};
g.h.zp=function(){return null};
g.h.Ux=function(){return null};
g.h.Gk=function(){return new g.Em(0,0,0,0)};
g.h.handleGlobalKeyDown=function(){return!1};
g.h.handleGlobalKeyUp=function(){return!1};
g.h.xs=function(a,b,c,d,e){var f=0,k=d=0,l=g.Sm(a);if(b){c=g.Cp(b,"ytp-prev-button")||g.Cp(b,"ytp-next-button");var m=g.Cp(b,"ytp-play-button"),n=g.Cp(b,"ytp-miniplayer-expand-watch-page-button");c?f=k=12:m?(b=g.Qm(b,this.element),k=b.x,f=b.y-12):n&&(k=g.Cp(b,"ytp-miniplayer-button-top-left"),f=g.Qm(b,this.element),b=g.Sm(b),k?(k=8,f=f.y+40):(k=f.x-l.width+b.width,f=f.y-20))}else k=c-l.width/2,d=25+(e||0);b=this.player.Ya().getPlayerSize().width;e=f+(e||0);l=g.th(k,0,b-l.width);e?(a.style.top=e+"px",
a.style.bottom=""):(a.style.top="",a.style.bottom=d+"px");a.style.left=l+"px"};
g.h.showControls=function(){};
g.h.Hm=function(){};
g.h.Vl=function(){return!1};g.w(d4,g.aK);d4.prototype.create=function(){};
d4.prototype.cj=function(){return!1};
d4.prototype.load=function(){this.player.hideControls();this.j.show()};
d4.prototype.unload=function(){this.player.showControls();this.j.hide()};g.$J("miniplayer",d4);})(_yt_player);
