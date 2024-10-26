 var videos = new Array();
    var timeline = new Array( 0 );
    var nowVideoLocation = 0;
    var playerNum = 0;
    var totalTime = 0;
    var currentVideoTime = 0;
    var i = 0;
    var targetTime = 0;
    var targetPlayer = 0;
    var loadNextSource = false;
    var playtime = 0;
    var errid = 0;
    var isiPad = navigator.userAgent.match( /iPad|iPhone|Android|Linux|iPod/i ) != null;
    var vodhtml = '<div class="player"><div class="play"></div><div class="vod"><video class="video"></video><video class="video" style="display:none"></video></div><div class="cmd"><div class="left tvp_button tvp_play"><button type="button" title="[播放暂停]"><span class="tvp_btn_value">[播放]</span></button></div><div class="centent tvp_time_rail"><span class="tvp_time_total"><span class="tvp_time_loaded" style="width:0"></span></span> <span class="tvp_time_panel">[<span class="time1">00:00</span>/<span class="time2">00:00</span>]</span></div><div class="right tvp_button tvp_fullscreen_button"><button type="button" title="[全屏切换]"><span class="tvp_quan">[全屏]</span></button></div><span class="tvp_time_handel_hint" style="display:none"></span></div></div>';
    var ydiskvod = {
      init: function ( urlarr ) {
        if ( urlarr instanceof Array ) {
          videos = urlarr;
        } else {
          videos[ 0 ] = urlarr;
        }
        $( 'document' ).ready( function () {
          initTimeline();
          $( '.tvp_button,.play' ).click( function () {
            if ( $( '.video' )[ playerNum ].paused ) {
              $( '.video' )[ playerNum ].play();
              $( '.play' ).hide();
              $( '.tvp_button' ).removeClass( 'tvp_play' ).addClass( 'tvp_pause' );
            } else {
              $( '.video' )[ playerNum ].pause();
              $( '.play' ).show();
              $( '.tvp_button' ).addClass( 'tvp_play' ).removeClass( 'tvp_pause' );
            }
          } );
          $( '.tvp_time_total' ).click( function () {
            var w = parseFloat( $( this ).css( 'width' ) );
            var l = $( this ).offset().left;
            var e = event || window.event;
            var p = e.pageX;
            var pro = ( p - l ) / w * 100 + '%';
            $( '.tvp_time_loaded' ).css( 'width', pro );
            var time = totalTime * ( p - l ) / w;
            setToTime( time )
          } );
          $( '.tvp_fullscreen_button' ).click( function () {
            $( '.video' )[ playerNum ].webkitEnterFullscreen();
            $( '.video' )[ playerNum ].mozRequestFullScreen();
            return false
          } )
        } )
      }
    };

    function initHandler() {
      timeline[ i ] = $( '.video' )[ 1 ].duration;
      totalTime += timeline[ i ];
      if ( i < videos.length - 1 ) {
        $( '.video' )[ 1 ].src = videos[ ++i ]
      } else {
        $( '.video' )[ 1 ].src = '';
        $( '.video' )[ 1 ].removeEventListener( 'loadedmetadata', initHandler, true )
      }
    }

    function currentTimeHandler() {
      currentVideoTime = $( '.video' )[ playerNum ].currentTime;
      if ( timeline[ nowVideoLocation ] - currentVideoTime < 20 && !loadNextSource ) {
        loadNextVideo( nowVideoLocation + 1 );
        loadNextSource = true
      }
      var currentVideoTime2 = Number( playtime ) + Number( currentVideoTime );
      $( '.time1' ).html( timetostr( currentVideoTime2 ) );
      $( '.time2' ).html( timetostr( totalTime ) );
      var wid = currentVideoTime2 / totalTime * 100 + '%';
      $( '.tvp_time_loaded' ).css( 'width', wid );
      $( '.video' )[ playerNum ].controls = false;
    }

    function initTimeline() {
      $( '.video' )[ 1 ].preload = 'auto';
      $( '.video' )[ 1 ].src = videos[ i ];
      $( '.video' )[ 0 ].src = videos[ i ];
      $( '.video' )[ 1 ].addEventListener( 'loadedmetadata', initHandler, true );
      $( '.video' )[ 0 ].addEventListener( 'timeupdate', currentTimeHandler, true );
      $( '.video' )[ 0 ].addEventListener( 'ended', switchNextVideo, true )
    }

    function loadNextVideo( nextLocation ) {
      var nextPlayer = Number( !playerNum );
      if ( nextLocation < videos.length ) {
        $( '.video' )[ nextPlayer ].preload = 'auto';
        $( '.video' )[ nextPlayer ].src = videos[ nextLocation ]
      }
    }

    function setToTime( time ) {
      var videoChapter;
      var nextPlayer = Number( !playerNum );
      if ( time >= totalTime ) {
        videoChapter = videos.length - 1;
        time = totalTime
      } else {
        for ( videoChapter = 0; videoChapter < videos.length - 1; videoChapter++ ) {
          if ( time - timeline[ videoChapter ] < 0 ) {
            break
          } else {
            time -= timeline[ videoChapter ]
          }
        }
      }
      if ( videoChapter == nowVideoLocation ) {
        $( '.video' )[ playerNum ].currentTime = time
      } else {
        loadNextVideo( videoChapter );
        targetTime = time;
        targetPlayer = nextPlayer;
        $( '.video' )[ targetPlayer ].addEventListener( 'durationchange', jumpToTime, true );
        switchToVideo();
        nowVideoLocation = videoChapter
      }
    }

    function jumpToTime() {
      $( '.video' )[ targetPlayer ].currentTime = targetTime;
      $( '.video' )[ targetPlayer ].removeEventListener( 'durationchange', jumpToTime, true )
    }

    function switchNextVideo() {
      var nextPlayer = Number( !playerNum );
      loadNextSource = false;
      if ( nowVideoLocation < videos.length - 1 ) {
        $( '.video:eq(' + nextPlayer + ')' ).css( 'display', '' );
        $( '.video:eq(' + playerNum + ')' ).css( 'display', 'none' );
        $( '.video' )[ playerNum ].pause();
        $( '.video' )[ playerNum ].removeEventListener( 'timeupdate', currentTimeHandler, true );
        $( '.video' )[ playerNum ].removeEventListener( 'ended', switchNextVideo, true );
        $( '.video' )[ playerNum ].src = '';
        $( '.video' )[ nextPlayer ].addEventListener( 'timeupdate', currentTimeHandler, true );
        $( '.video' )[ nextPlayer ].addEventListener( 'ended', switchNextVideo, true );
        $( '.video' )[ nextPlayer ].play();
        nowVideoLocation++;
        playerNum = nextPlayer;
        playtime = Number( playtime ) + Number( currentVideoTime );
      } else {
        $( '.video' )[ playerNum ].removeEventListener( 'ended', switchNextVideo, true )
      }
    }

    function switchToVideo() {
      var nextPlayer = Number( !playerNum );
      loadNextSource = false;
      $( '.video:eq(' + nextPlayer + ')' ).css( 'display', '' );
      $( '.video:eq(' + playerNum + ')' ).css( 'display', 'none' );
      $( '.video' )[ playerNum ].pause();
      $( '.video' )[ playerNum ].removeEventListener( 'timeupdate', currentTimeHandler, true );
      $( '.video' )[ playerNum ].removeEventListener( 'ended', switchToVideo, true );
      $( '.video' )[ playerNum ].src = '';
      $( '.video' )[ nextPlayer ].addEventListener( 'timeupdate', currentTimeHandler, true );
      $( '.video' )[ nextPlayer ].addEventListener( 'ended', switchToVideo, true );
      $( '.video' )[ nextPlayer ].play();
      playerNum = nextPlayer;
      playtime = Number( playtime ) + Number( currentVideoTime )
    }

    function timetostr( time ) {
      var s = parseInt( time % 60 );
      if ( s < 10 ) {
        s = '0' + s
      }
      var m = parseInt( time / 60 );
      if ( m < 10 ) {
        m = '0' + m
      }
      return m + ':' + s
    }

    function error() {
      if ( isiPad ) {
        if ( $( '.video' )[ playerNum ].error.code == 4 ) {
          play_up()
        }
      } else {
        CKobject.getObjectById( 'ckplayer_a1' ).addListener( 'error', 'play_up' )
      }
    }
    $( document ).ready( function () {
      $('#play_header').click(function () {
        $('.panel').slideToggle();
        $(this).toggleClass("open");
      });
      $('.panel a').click(function(){
        $('.panel').slideToggle();
        $(this).addClass("active").siblings().removeClass("active");
        $("#play_header").removeClass("open");
      });
    } );
    document.oncontextmenu = function () {
      return false;
    }