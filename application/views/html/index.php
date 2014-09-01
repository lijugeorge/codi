<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf8">
		<title>Html basic</title>
		<?php echo link_tag('public/css/styles.css');?>
	</head>
	<body>
		<div id="big_wrapper">
			<header id="top_header">
				<h1>Welcome to my page</h1>
			</header>
			
			<nav id="top_menu">
				<ul>
					<li>Home</li>
					<li>Tutorials</li>
					<li>Podcasts</li>
				</ul>
			</nav>
			
			<section id="main_section">
				<article>
					<header>
						<hgroup>
							<h1>Title of article</h1>
							<h2>Subtitles goes here</h2>
						</hgroup>
					</header>
					<p>This is article content </p>
					<footer>
						<p> - writen by Liju </p>
					</footer>
				</article>
				
				<article>
					<header>
						<hgroup>
							<h1>Title of article 2</h1>
							<h2>Subtitles goes here</h2>
						</hgroup>
					</header>
					<p>This is article content </p>
					<footer>
						<p> - writen by Liju </p>
					</footer>
				</article>
			</section>
			<aside id="side_news">
				<h4>Recent</h4>
				Bla bla bla!!!
			</aside>
			<footer id="the_footer">
				Copyright all rights reserved
			</footer>
		</div>
		
		
		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
		
		<div id="player">
        </div>

        <script language="JavaScript"  type="text/javascript">
            (function() {
    function createPlayer(jqe, video, options) {
        var ifr = $('iframe', jqe);
        if (ifr.length === 0) {
            ifr = $('<iframe scrolling="no">');
            ifr.addClass('player');
        }
        var src = 'http://www.youtube.com/embed/' + video.id;
        if (options.playopts) {
            src += '?';
            for (var k in options.playopts) {
                src+= k + '=' + options.playopts[k] + '&';
            }  
            src += '_a=b';
        }
        ifr.attr('src', src);
        jqe.append(ifr);  
    }
    
    function createCarousel(jqe, videos, options) {
        var car = $('div.carousel', jqe);
        if (car.length === 0) {
            car = $('<div>');
            car.addClass('carousel');
            jqe.append(car);
            
        }
        $.each(videos, function(i,video) {
            options.thumbnail(car, video, options); 
        });
    }
    
    function createThumbnail(jqe, video, options) {
        var imgurl = video.thumbnails[0].url;
        var img = $('img[src="' + imgurl + '"]');
        if (img.length !== 0) return;
        img = $('<img>');    
        img.addClass('thumbnail');
        jqe.append(img);
        img.attr('src', imgurl);
        img.attr('title', video.title);
        img.click(function() {
            options.player(options.maindiv, video, $.extend(true,{},options,{playopts:{autoplay:1}}));
        });
    }
    
    var defoptions = {
        autoplay: false,
        user: null,
        carousel: createCarousel,
        player: createPlayer,
        thumbnail: createThumbnail,
        loaded: function() {},
        playopts: {
            autoplay: 0,
            egm: 1,
            autohide: 1,
            fs: 1,
            showinfo: 0
        }
    };
    
    
    $.fn.extend({
        youTubeChannel: function(options) {
            var md = $(this);
            md.addClass('youtube');
            md.addClass('youtube-channel');
            var allopts = $.extend(true, {}, defoptions, options);
            allopts.maindiv = md;
            $.getJSON('http://gdata.youtube.com/feeds/users/' + allopts.user + '/uploads?alt=json-in-script&format=5&callback=?', null, function(data) {
                var feed = data.feed;
                var videos = [];
                $.each(feed.entry, function(i, entry) {
                    var video = {
                        title: entry.title.$t,
                        id: entry.id.$t.match('[^/]*$'),
                        thumbnails: entry.media$group.media$thumbnail
                    };
                    videos.push(video);
                });
                allopts.allvideos = videos;
                allopts.carousel(md, videos, allopts);
                allopts.player(md, videos[0], allopts);
                allopts.loaded(videos, allopts);
            });
        } 
    });
    
})();
        
$(function() {
    $('#player').youTubeChannel({user:'mazhavilmanorama'});
});
        </script>   
	</body>
</html>