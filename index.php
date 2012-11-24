<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>IsValid | Quantify the results of A/B tests</title>

		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Libraries -->
		<script src="js/jquery.min.js"></script>
		<script src="js/underscore.min.js"></script>
		<script src="js/handlebars.js"></script>

		<script src="js/isvalid.js"></script>

		<!-- Fonts -->
		<script type="text/javascript" src="//use.typekit.net/ivm8epx.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

		<!-- Bootstrap -->
		<link href="css/bootstrap-compiled.min.css" rel="stylesheet">

		<link href="css/isvalid.css" rel="stylesheet">
	</head>

	<body class="permalink">
		<script id="results-template" type="text/x-handlebars-template">
			<div class="row">
				{{#each results}}
					<div class="result span6">
						<h3>{{title}}</h3>
						<div class="average">{{average}}%</div>
						{{#if high}}
							<div class="range">{{low}} – {{high}}</div>
						{{/if}}
						<img src="{{chart}}" class="chart-image" alt="{{average}}">
					</div>
				{{/each}}
			</div>
		</script>

		<script id="error-template" type="text/x-handlebars-template">
			<div class="row">
				<div class="span4 offset4 alert alert-error"><p>Oops, it looks like something went wrong.</p> <p>{{error.message}}</p></div>
			</div>
		</script>

		<div class="container main">
			<!-- Header -->
			<div class="header">
				<h1>IsValid</h1>
				<canvas id="conconjr" width="250" height="30">CON CON NEVER HAS BUGS. IT IS YOUR BROWSER THAT HAS BUGS.</canvas>
				<hr />
				<p>Quantify experiment results</p>
			</div>

			<form class="horizontal-form">
			<div class="row">
				<div class="span6">
					<h2>Samples</h2>
					<div class="control-group">
						<input class="input-xlarge" type="text" id="control-samples" tabindex="1" placeholder="Original">
					</div>
					<div class="control-group">
						<input class="input-xlarge" type="text" id="experiment-samples" tabindex="3" placeholder="Experiment">
					</div>
				</div>
				<div class="span6">
					<h2>Conversions</h2>
					<div class="control-group">
						<input class="input-xlarge" type="text" id="control-conversions" tabindex="2" placeholder="Original">
					</div>
					<div class="control-group">
						<input class="input-xlarge" type="text" id="experiment-conversions" tabindex="4" placeholder="Experiment">
					</div>
				</div>
			</div>
			</form>
			<div class="row">
				<div class="span4 offset4 alert alert-info" style="display:none;">Results will automatically load when you fill in each field</div>
			</div>
			<div class="results"></div>
		</div> <!-- /container -->
		<div class="container">
			<div class="row footer">
				<div class="span4 offset4">
					<p><a href="https://github.com/evansolomon/IsValid.org">Source code</a> & <a href="https://github.com/evansolomon/IsValid.org/wiki/API">API documentation</a> on&nbsp;Github</p>
					<p><a href="javascript:(function(){(function(){var%20a={init:function(){if(!window.jQuery){var%20b=document.createElement(%22script%22);b.type=%22text/javascript%22;b.src=%22//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js%22;b.onload=b.onreadystatechange=function(){if(!this.readyState||this.readyState==%22loaded%22||this.readyState==%22complete%22){a.ready();}};document.getElementsByTagName(%22head%22)[0].appendChild(b);}else{a.ready();}},ready:function(){a.reset();a.header.create();jQuery(document).click(a.click);jQuery(%22*%22).hover(a.mouseEnter,a.mouseLeave);},click:function(c){var%20d=c.target.innerHTML,b=parseInt(d.replace(%22,%22,%22%22),10);if(!a.selectable(b)){return;}a.selected.push(b);jQuery(c.target).css(%22background-color%22,%22rgba(50,%20200,%2080,%200.7)%22).addClass(%22isvalid-clicked%22);jQuery(%22.isvalid-steps%22).text(a.nextStep());if(4==a.selected.length){window.open(%22http://isvalid.org/%3Fsc=%22+a.selected[0]+%22%26cc=%22+a.selected[1]+%22%26se=%22+a.selected[2]+%22%26ce=%22+a.selected[3]);a.reset();}c.target.style.cursor=%22default%22;a.header.update();return%20false;},mouseLeave:function(c){var%20b=jQuery(this);if(!b.hasClass(%22isvalid-clicked%22)%26%26!b.hasClass(%22isvalid-steps%22)){b.css(%22background-color%22,%22%22);}c.target.style.cursor=%22default%22;},mouseEnter:function(d){var%20b=jQuery(this);if(b.hasClass(%22isvalid-clicked%22)){return;}var%20e=d.target.innerHTML,c=parseInt(e.replace(%22,%22,%22%22),10);if(!a.selectable(c)){return;}d.stopPropagation();b.css(%22background-color%22,%22rgba(50,%20200,%2080,%200.25)%22);d.target.style.cursor=%22pointer%22;},selectable:function(b){return%20!isNaN(parseFloat(b))%26%26isFinite(b);},nextStep:function(){var%20c,b=a.selected.length;if(0===b){c=%22Control%20samples%22;}else{if(1==b){c=%22Control%20conversions%22;}else{if(2==b){c=%22Experiment%20samples%22;}else{if(3==b){c=%22Experiment%20conversions%22;}else{c=%22This%20should%20never%20happen%22;}}}}return%22Select:%20%22+c;},header:{create:function(){var%20b=jQuery(%22%3Cdiv%3E%22);b.css({top:%220px%22,left:%220px%22,%22background-color%22:%22rgba(50,%20200,%2080,%200.8)%22,%22z-index%22:%2210000%22,width:%22100%25%22,height:%2260px%22,position:%22fixed%22,%22text-align%22:%22center%22,%22padding-top%22:%2220px%22,%22font-size%22:%2230px%22});b.addClass(%22isvalid-steps%22);b.prependTo(%22body%22);this.update();},update:function(){jQuery(%22.isvalid-steps%22).text(a.nextStep());}},reset:function(){jQuery(%22.isvalid-clicked%22).removeClass(%22isvalid-clicked%22).css(%22background-color%22,%22%22);jQuery(document).unbind(%22click%22,a.click);jQuery(%22*%22).unbind(%22mouseleave%22,a.mouseLeave).unbind(%22mouseenter%22,a.mouseEnter);jQuery(%22.isvalid-steps%22).remove();a.selected=[];}};a.init();}());})();">Isvalid-ify</a> bookmarklet here & <a href="https://github.com/evansolomon/IsValid.org/wiki/Bookmarklet">instructions</a> on&nbsp;Github</p>
				</div>
			</div>
		</div>

	</body>
</html>