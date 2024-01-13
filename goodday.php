<?php
/**
 * @package Good_Day
 * @version 1.7.2
 */
/*
Plugin Name: Good Day
Plugin URI: http://wordpress.org/plugins/good-day-ice-cube/
Description: This is a song by Ice cube. Shown in the stead of hello dolly. 
Author: Carefreeav
Version: 0.0.1
Author URI: http://ma.tt/
*/

function good_day_get_lyrics() {
	/** These are the lyrics to Ice Cube's famous Today was a good day. */
	$lyrics = "Just wakin' up in the mornin', gotta thank God
    I don't know, but today seems kinda odd
No barkin' from the dog, no smog
And momma cooked a breakfast with no hog (damn!)
I got my grub on, but didn't pig out
Finally, got a call from a girl I wanna dig out (what's up?)
Hooked it up fo' later as I hit the do'
Thinkin', 'Will I live another 24'?'
I gotta go 'cause I got me a drop top
And if I hit the switch, I can make the ass drop
Had to stop at a red light
Lookin' in my mirror, not a jacker in sight
And everything is alright
I got a beep from Kim, and she can fuck all night
Called up the homies, and I'm askin' y'all
Which park, are y'all playin' basketball?
Get me on the court and I'm trouble
Last week fucked around and got a triple-double
Freakin' niggas every way like MJ
I can't believe, today was a good day, shit!";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );
	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function good_day() {
	$chosen = good_day_get_lyrics();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

    
	printf(
		'<p id="good_day"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Quote from Good Day song, by Ice Cube:' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'good_day' );

// We need some CSS to position the paragraph.
function good_day_css() {
	echo "
	<style type='text/css'>
	#good_day {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #good_day {
		float: left;
	}
	.block-editor-page #good_day {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#good_day,
		.rtl #good_day {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'good_day_css' );
