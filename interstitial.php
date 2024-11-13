<?php
if (get_field('show_interstitial_ad')){

$active = false;
if( have_rows('interstitial_ad','option') ){
	while( have_rows('interstitial_ad','option') ) { the_row();
		if ($active != true) {
		$activefield = get_sub_field('active');
		if ($activefield) {
			$active = true;
			$heading = get_sub_field('heading');
			$image = get_sub_field('image');
			$bg_image = get_sub_field('bg_image');
			$button = get_sub_field('button');
			$bg_image['url'] = '/wp-content/uploads/2024/08/interstitial_bg.png';

	echo '<a href="' . $button['url'] . '"><div class="interstitial-ad" style="background-image: url(' . $bg_image['url'] . ');">';
	echo '<div class="interstitial-ad-inner">';
	echo '<div class="interstitial-ad-close"><img src="/wp-content/uploads/2024/08/close.png"></div>';
	echo '<div class="interstitial-image"><img src="' . $image['url'] . '"></div>';
	echo '<div class="interstitial-text">';
	echo '<h2>' . $heading . '</h2>';
	if ($button) {
		echo '<div class="button">' . $button['title'] . ' <svg xmlns="http://www.w3.org/2000/svg" width="12.35" height="20"><path d="M2.35 0 0 2.35 7.633 10 0 17.65 2.35 20l10-10Z" fill="#fff"></path></svg></div>';
	}
	
	echo '</div></div></div></a>';
	
?>
<style>
.interstitial-ad {
	width: 540px;
	height: 333px;
	background-position: center center;
	background-repeat: no-repeat;
	background-size: cover;
	background-color: #116496;
	padding: 5px;
	position: fixed;
	//right: 0;
	z-index: 1000;
	//top: 40%;
	//top: 35%;
	top: calc(50% - 80px);
	right: -550px;
	//transition: right 1.2s;
	animation-name: interstitial-animate;
	animation-duration: 1.5s;
	animation-delay: 0.5s;
	animation-fill-mode: forwards;
	max-width: 100%;
	border: 5px solid #F1F0F0;
	border-right: 0;
	filter: drop-shadow(-8px 0px 10px rgba(0, 0, 0, 0.8));
}

.hide-corner-popup .interstitial-ad {
	display: none;
}

@keyframes interstitial-animate {
  from {right: -550px;}
  to {right: 0;}
}

.interstitial-ad.loaded {
	//right: 0;
}

.interstitial-ad .interstitial-ad-inner {
	//border: 3px solid #F1F0F0;
	//border-radius: 2px;
	//padding: 20px 0px 0px 15px;
	//height: 100%;
}

.interstitial-ad h2 {
	color: white;
	text-shadow: 3px 3px 0px #01172f;
	font-family: "Francois One";
	font-weight: normal;
	//font-size: 36px;
	font-size: 48px;
	font-weight: 600;
	//text-transform: uppercase;
	text-transform: none;
	line-height: 1;
	margin: 0;
	margin-bottom: 20px;
}

.interstitial-ad .button {
	font-size: 33px !important; 
	font-family: "Francois One";
	font-weight: 600;
	//text-transform: uppercase;
	background-color: #002c5c;
	line-height: 1;
	color: #fff;
	padding: 12px 24px;
	display: inline-block;
	transition: all .3s;
	text-decoration: none;
	height: 77px;
}

.interstitial-ad .button:hover {
	background-color: #F8AE4A !important;
}

.interstitial-ad .interstitial-ad-close {
	cursor: pointer;
	position: absolute;
	left: -14px;
	top: -14px;
	//border: 1px solid;
	//border-radius: 100%;
	//font-size: 26px;
	//background: white;
	//line-height: 1;
	//padding: 4px;
	width: 40px;
	height: 40px;
	text-align: center;
}

.interstitial-ad .interstitial-image {
	display: block;
	//position: absolute;
	//right: 0;
	//bottom: 0;
}

.interstitial-ad .interstitial-image img {
	display: block;
	//margin-left: auto;
	//width: 85%;
	margin-top: -65px;
	//max-width: 497px;
	max-width: 95%;
}

.interstitial-ad .button svg {
	//margin-left: 8px;
	margin-left: 1em;
}

.interstitial-ad .interstitial-text {
	display: flex;
	justify-content: center;
	gap: 2em;
	align-items: center;
}

@media screen and (max-width: 700px){
	.interstitial-ad {
		height: auto;
		max-width: 90%;
		text-align: center;
	}
	
	.interstitial-ad h2 {
		font-size: 30px;
		margin-top: 15px;
	}
	
	.interstitial-ad .interstitial-image {
		display: none;
		//position: static;
		//margin-top: 20px;
	}
	
	.interstitial-ad .button {
		margin-bottom: 10px;
		height: auto;
	}
}
</style>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
<script>
jQuery(document).ready(function( $ ) {

var expires = 7;
if(Cookies.get('hideCornerPopup')) {
	var hideCornerPopup = Cookies.get('hideCornerPopup');
	if (hideCornerPopup >= 3) {
		$('body').addClass('hide-corner-popup');
	}
	else {
	hideCornerPopup++;
	Cookies.set('hideCornerPopup', hideCornerPopup, {expires: expires});			
	}
}
else {
	Cookies.set('hideCornerPopup', 1, {expires: expires});
}

$('.interstitial-ad .interstitial-ad-close').on("click touch", function () {
	//$('body').addClass('hide-corner-popup');
	$('.interstitial-ad').hide();
	Cookies.set('hideCornerPopup', 4, {expires: expires});
});

});
</script>
<?php
}
}
}
} }
?>