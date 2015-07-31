<?php
session_start();
$con = mysql_connect("localhost","reykas2015","hN4dfp80TeYT4");
mysql_select_db("reykas2015", $con) or die ('not found');
$UserName=$_SESSION['username'];
if($UserName=="")
{
    header("location:index.php");
}
if(isset($_POST['action']))
{
    session_destroy();
    header("location:index.php");   
}
$restaurantsId=mysql_query("SELECT RestaurantId FROM favorite WHERE Username ='$UserName'") or die(mysql_error());

for($i=0; $i<4; $i++)
{
    $restId[$i]=0;   
}
$i = 0;
while($row = mysql_fetch_array($restaurantsId))
{
    $restId[$i] = $row["RestaurantId"];
    $i++;
}
$restaurantInfo=mysql_query("SELECT NAME, WEBSITE FROM restaurants WHERE ID IN ($restId[0], $restId[1], $restId[2], $restId[3])") or die(mysql_error());
$i = 0;
while($row = mysql_fetch_array($restaurantInfo))
{
    $rowsW[$i] = $row["WEBSITE"];
    $rowsN[$i] = $row["NAME"];
    $i++;
}
$restaurants=mysql_query("SELECT NAME, WEBSITE FROM restaurants")or die(mysql_error());
$i=0;
while($row = mysql_fetch_array($restaurants))
{
    $restaurantW[$i] = $row["WEBSITE"];
    $restaurantN[$i] = $row["NAME"];
    $i++;
}

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<!-- Title here -->
		<title>OnTheGo</title>
        <link rel="icon" type="image/png" href="img/logo.jpg">

		<!-- Description, Keywords and Author -->
		<meta name="description" content="Your description">
		<meta name="keywords" content="Your,Keywords">
		<meta name="author" content="ResponsiveWebInc">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- Styles -->
		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
		<link href="css/settings.css" rel="stylesheet">		
		<!-- FlexSlider Css -->
		<link rel="stylesheet" href="css/flexslider.css" media="screen" />
		<!-- Portfolio CSS -->
		<link href="css/prettyPhoto.css" rel="stylesheet">
		<!-- Font awesome CSS -->
		<link href="css/font-awesome.min.css" rel="stylesheet">	
		<!-- Custom Less -->
		<link href="css/less-style.css" rel="stylesheet">	
		<!-- Custom CSS -->
		<link href="css/style.css" rel="stylesheet">
		<!--[if IE]><link rel="stylesheet" href="css/ie-style.css"><![endif]-->
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="#">
	</head>
	
	<body>
		

		<!-- Model End -->
		
		<!-- Page Wrapper -->
		<div class="wrapper">
		
			<!-- Header Start -->
			
			<div class="header">
				<div class="container">
					<!-- Header top area content -->
					<div class="header-top">
						<div class="row">
							<div class="col-md-4 col-sm-4">
								<!-- Header top left content contact -->
								<div class="header-contact">
									<!-- Contact number -->
									<span><i class="fa fa-phone red"></i> 954-123-4567</span>
								</div>
							</div>
							<div class="col-md-4 col-sm-4">
								<!-- Header top right content search box -->
								<div class=" header-search">
									<form class="form" role="form">
										<div class="input-group">
										  <input type="text" class="form-control" placeholder="Search...">
										  <span class="input-group-btn">
											<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
										  </span>
										</div>
									</form>
								</div>
							</div>
					</div>
                        <div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Restaurants
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
      <?php 


$z=0;
while($z<30)
{
    echo '<li><a href="'.$restaurantW[$z].'">'.$restaurantN[$z].'</a></li>';
    $z++;
}

                                           
     ?>
  
  </ul>
</div>
					<div class="row">
						<div class="col-md-4 col-sm-5">
							<!-- Link -->
							<a href="index.html">
								<!-- Logo area -->
								<div class="logo">
									<img class="img-responsive" src="img/logo.jpg" alt="" />
									<!-- Heading -->
									<h1>
                                        On The Go<br/>
                                        <?php 
                                            echo '&nbsp'.$_SESSION['username']."'s";
                                        ?>
                                        
                                    </h1>
                                    <form method="post" action="profile.php" enctype="multipart/form-data" id="usersign-in">
								        <div class="form-group">
                                            <button name="action" class="btn btn-danger" type="submit">Logout</button>
                                        </div>
                                    </form>
									<!-- Paragraph -->
									<p>&nbsp;&nbsp;&nbsp;Find the best place to eat.</p>
								</div>
							</a>
						</div>
						<div class="col-md-8 col-sm-7">
							<!-- Navigation -->
							<nav class="navbar navbar-default navbar-right" role="navigation">
								<div class="container-fluid">
									<!-- Brand and toggle get grouped for better mobile display -->
									<div class="navbar-header">
										<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
											<span class="sr-only">Toggle navigation</span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
									</div>

									<!-- Collect the nav links, forms, and other content for toggling -->
									<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
										<ul class="nav navbar-nav">
                                            <h1>Favorite Restaurants</h1>
                                            <?php
                                                if($rowsN[0] != "")
                                                {
								                    echo '<li><a href="'.$rowsW[0].'"><img src="img/nav-menu/nav1.jpg" class="img-responsive" alt="" />'.$rowsN[0].'</a></li>';
                                                }
                                                if($rowsN[1] != "")
                                                {
								                    echo '<li><a href="'.$rowsW[1].'"><img src="img/nav-menu/nav2.jpg" class="img-responsive" alt="" />'.$rowsN[1].'</a></li>';
                                                }
                                                if($rowsN[2] != "")
                                                {
								                    echo '<li><a href="'.$rowsW[2].'"><img src="img/nav-menu/nav3.jpg" class="img-responsive" alt="" />'.$rowsN[2].'</a></li>';
                                                }
                                                if($rowsN[3] != "")
                                                {
								                    echo '<li><a href="'.$rowsW[3].'"><img src="img/nav-menu/nav4.jpg" class="img-responsive" alt="" />'.$rowsN[3].'</a></li>';
                                                }


                                            ?>
                                            
                                            																			
										</ul>
									</div><!-- /.navbar-collapse -->
								</div><!-- /.container-fluid -->
							</nav>
						</div>
					</div>
				</div> <!-- / .container -->
			</div>
			
			<!-- Header End -->
			
			<!-- Slider Start 
			#################################
				- THEMEPUNCH BANNER -
			#################################	-->

			<div class="tp-banner-container">
				<div class="tp-banner" >
					<ul>	<!-- SLIDE  -->
						<li data-transition="fade" data-slotamount="7" data-masterspeed="1500" >
							<!-- MAIN IMAGE -->
							<img src="img/slider/slide2.jpg"  alt=""  data-bgfit="cover" data-bgposition="center bottom" data-bgrepeat="no-repeat">
							
							<!-- LAYERS -->
							<!-- LAYER NR. 1 -->
							<div class="tp-caption lfl largeblackbg br-red"
								data-x="20" 
								data-y="100"
								data-speed="1500"
								data-start="1200"
								data-easing="Power4.easeOut"
								data-endspeed="500"
								data-endeasing="Power4.easeIn"
								style="z-index: 3">Find Delicious...
							</div>
							<!-- LAYER NR. 2.0 -->
							<div class="tp-caption lfl medium_bg_darkblue br-green"
								data-x="20"
								data-y="200"
								data-speed="1500"
								data-start="1800"
								data-easing="Power4.easeOut"
								data-endspeed="300"
								data-endeasing="Power4.easeIn"
								data-captionhidden="off">Breakfast
							</div>
							<!-- LAYER NR. 2.1 -->
							<div class="tp-caption lfl medium_bg_darkblue br-lblue"
								data-x="20" 
								data-y="250"
								data-speed="1500"
								data-start="2100"
								data-easing="Power4.easeOut"
								data-endspeed="500"
								data-endeasing="Power4.easeIn"
								style="z-index: 3">Lunch
							</div>
							<!-- LAYER NR. 2.2 -->
							<div class="tp-caption lfl medium_bg_darkblue br-purple"
								data-x="20" 
								data-y="300"
								data-speed="1500"
								data-start="2400"
								data-easing="Power4.easeOut"
								data-endspeed="500"
								data-endeasing="Power4.easeIn"
								style="z-index: 3">Dinner
							</div>
							<!-- LAYER NR. 2.3 -->
							<div class="tp-caption lfl medium_bg_darkblue br-orange"
								data-x="20" 
								data-y="350"
								data-speed="1500"
								data-start="2700"
								data-easing="Power4.easeOut"
								data-endspeed="500"
								data-endeasing="Power4.easeIn"
								style="z-index: 3">Or the perfect desert! 
							</div>
							<!-- LAYER NR. 3.0 -->
							<div class="tp-caption customin customout"
								data-x="right" data-hoffset="-50"
								data-y="100"
								data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
								data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
								data-speed="400"
								data-start="3600"
								data-easing="Power3.easeInOut"
								data-endspeed="300"
								style="z-index: 5"><img class="slide-img img-responsive" src="img/slider/s24.png" alt="" />
							</div>
							<!-- LAYER NR. 3.1 -->
							<div class="tp-caption customin customout"
								data-x="right" data-hoffset="-120"
								data-y="130"
								data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
								data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
								data-speed="400"
								data-start="3900"
								data-easing="Power3.easeInOut"
								data-endspeed="300"
								style="z-index: 6"><img class="slide-img img-responsive" src="img/slider/s22.png" alt="" />
							</div>
							<!-- LAYER NR. 3.2 -->
							<div class="tp-caption customin customout"
								data-x="right" data-hoffset="-10"
								data-y="160"
								data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
								data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
								data-speed="400"
								data-start="4200"
								data-easing="Power3.easeInOut"
								data-endspeed="300"
								style="z-index: 7"><img class="slide-img img-responsive" src="img/slider/s23.png" alt="" />
							</div>
							<!-- LAYER NR. 3.3 -->
							<div class="tp-caption customin customout"
								data-x="right" data-hoffset="-80"
								data-y="190"
								data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
								data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
								data-speed="400"
								data-start="4500"
								data-easing="Power3.easeInOut"
								data-endspeed="300"
								style="z-index: 8"><img class="slide-img img-responsive" src="img/slider/s21.png" alt="" />
							</div>
						</li>
						<li data-transition="zoomin" data-slotamount="6" data-masterspeed="400" >
							<!-- MAIN IMAGE -->
							<img src="img/slider/transparent.png" style="background-color:#fff" alt=""  data-bgfit="cover" data-bgposition="center bottom" data-bgrepeat="no-repeat">
							
							<!-- LAYERS -->
							<!-- LAYER NR. 1 -->
							<div class="tp-caption sfl modern_medium_light"
								data-x="20" 
								data-y="90"
								data-speed="800"
								data-start="1000"
								data-easing="Power4.easeOut"
								data-endspeed="500"
								data-endeasing="Power4.easeIn"
								style="z-index: 3">The New
							</div>
							<!-- LAYER NR. 1.1 -->
							<div class="tp-caption large_bold_grey heading customin customout"
								data-x="10"
								data-y="125"
								data-splitin="chars"
								data-splitout="chars"
								data-elementdelay="0.05"
								data-start="1500"
								data-speed="900"
								data-easing="Back.easeOut"
								data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
								data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
								data-endspeed="500"
								data-endeasing="Power3.easeInOut"
								data-captionhidden="on"
								style="z-index:5">OnTheGo
							</div>
							<!-- LAYER NR. 2 -->
							<div class="tp-caption customin customout"
								data-x="700" 
								data-y="150"
								data-customin="x:50;y:150;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.5;scaleY:0.5;skewX:0;skewY:0;opacity:0;transformPerspective:0;transformOrigin:50% 50%;"
								data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
								data-speed="800"
								data-start="2000"
								data-easing="Power4.easeOut"
								data-endspeed="500"
								data-endeasing="Power4.easeIn"
								style="z-index: 3"><img class="img-responsive" src="img/slider/s12.png" alt="" />
							</div>
							<!-- LAYER NR. 2.1 -->
							<div class="tp-caption customin customout"
								data-x="450" 
								data-y="10"
								data-customin="x:50;y:150;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.5;scaleY:0.5;skewX:0;skewY:0;opacity:0;transformPerspective:0;transformOrigin:50% 50%;"
								data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
								data-speed="800"
								data-start="2300"
								data-easing="Power4.easeOut"
								data-endspeed="500"
								data-endeasing="Power4.easeIn"
								style="z-index: 3"><img class="img-responsive" src="img/slider/s11.png" alt="" />
							</div>
							<!-- LAYER NR. 2.2 -->
							<div class="tp-caption customin customout"
								data-x="200" 
								data-y="300"
								data-customin="x:50;y:150;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.5;scaleY:0.5;skewX:0;skewY:0;opacity:0;transformPerspective:0;transformOrigin:50% 50%;"
								data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
								data-speed="800"
								data-start="2600"
								data-easing="Power4.easeOut"
								data-endspeed="500"
								data-endeasing="Power4.easeIn"
								style="z-index: 3"><img class="img-responsive" src="img/slider/s13.png" alt="" />
							</div>
							<!-- LAYER NR. 3 -->
							<div class="tp-caption finewide_verysmall_white_mw paragraph customin customout tp-resizeme"
								data-x="20"
								data-y="210" 
								data-customin="x:0;y:50;z:0;rotationX:-120;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 0%;"
								data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
								data-speed="1000"
								data-start="3600"
								data-easing="Power3.easeInOut"
								data-splitin="lines"
								data-splitout="lines"
								data-elementdelay="0.2"
								data-endelementdelay="0.08"
								data-endspeed="300"
								style="z-index: 10; max-width: auto; max-height: auto; white-space: nowrap;">"Part of the secret of success in life<br/> </br> is to eat what you like..."<br/> - Mark Twain<br/>
							</div>

						</li>
						<li data-transition="slidehorizontal" data-slotamount="1" data-masterspeed="600" >
							<!-- MAIN IMAGE -->
							<img src="img/slider/transparent.png" style="background-color:#fea501" alt=""  data-bgfit="cover" data-bgposition="center bottom" data-bgrepeat="no-repeat">
							<!-- LAYERS NR. 1 -->
							<div class="tp-caption lfl"
								data-x="left"
								data-y="100"
								data-speed="800"
								data-start="1200"
								data-easing="Power4.easeOut"
								data-endspeed="300"
								data-endeasing="Linear.easeNone"
								data-captionhidden="off"><img class="img-responsive" src="img/slider/s35.png" alt="" />
							</div>
							<!-- LAYERS NR. 2 -->
							<div class="tp-caption lfr large_bold_grey heading white"
								data-x="right" data-hoffset="-10"
								data-y="120"
								data-speed="800"
								data-start="2000"
								data-easing="Power4.easeOut"
								data-endspeed="300"
								data-endeasing="Linear.easeNone"
								data-captionhidden="off">Tasty Yammi
							</div>
							<!-- LAYER NR. 3 -->
							<div class="tp-caption whitedivider3px customin customout tp-resizeme"
								data-x="right" data-hoffset="-20"
								data-y="210" data-voffset="0"
								data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
								data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
								data-speed="700"
								data-start="2300"
								data-easing="Power3.easeInOut"
								data-splitin="none"
								data-splitout="none"
								data-elementdelay="0.1"
								data-endelementdelay="0.1"
								data-endspeed="500"
								style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;">&nbsp;
							</div>
							<!-- LAYER NR. 4 -->
							<div class="tp-caption finewide_medium_white randomrotate customout tp-resizeme"
								data-x="right" data-hoffset="-10"
								data-y="245" data-voffset="0"
								data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
								data-speed="1000"
								data-start="2700"
								data-easing="Power3.easeInOut"
								data-splitin="chars"
								data-splitout="chars"
								data-elementdelay="0.08"
								data-endelementdelay="0.08"
								data-endspeed="500"
								style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">Hamburger
							</div>
						</li>
						
					</ul>
					<!-- Banner Timer -->
					<div class="tp-bannertimer"></div>
				</div>
			</div>
			<!-- Slider End -->

			
				<!-- Testimonial Start -->
				
				<div class="testimonial padd">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<!-- BLock heading -->
								<h3>Recent Dishes</h3>
								<!-- Flex slider Content -->
								<div class="flexslider-recent flexslider">
									<ul class="slides">
										<li>
											<!-- Image for background -->
											<img class="img-responsive" src="img/dish/dish9.jpg" alt="" />
											<!-- Slide content -->
											<div class="slider-content">
												<!-- Heading -->
												<h4>Kungpao Chicken</h4>
												<!-- Paragraph -->
												
											</div>
										</li>
										<li>
											<!-- Image for background -->
											<img class="img-responsive" src="img/dish/dish10.jpg" alt="" />
											<!-- Slide content -->
											<div class="slider-content">
												<!-- Heading -->
												<h4>Delicious Grilled Lamb</h4>
												<!-- Paragraph -->
												
											</div>
										</li>
										<li>
											<!-- Image for background -->
											<img class="img-responsive" src="img/dish/dish11.jpg" alt="" />
											<!-- Slide content -->
											<div class="slider-content">
												<!-- Heading -->
												<h4>Tasty Shrimp Pasta</h4>
												<!-- Paragraph -->
												
											</div>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-md-6">
								<!-- BLock heading -->
								<h3>Our Client Says</h3>
								<!-- Flex slider Content -->
								<div class="flexslider-testimonial flexslider">
									<ul class="slides">
										<li>
											<!-- Testimonial Content -->
											<div class="testimonial-item">
												<!-- Quote -->
												<span class="quote lblue">&#8220;</span> 
												<!-- Your comments -->
												<blockquote>
													<!-- Paragraph -->
													<p>Dining at Vero was like traveling back to Italy for me! The restaurant is owned by a married Italian couple, with the husband as the chef and the wife running the dining room. They are a great team. The food here is absolutely excellent and the prices...</p>
												</blockquote>
												<!-- Heading with image -->
												<h4><img class="img-responsive img-circle" src="" alt="" /> Jhon Doe<span>, Miami</span></h4>
												<div class="clearfix"></div>
											</div>
										</li>
										<li>
											<!-- Testimonial Content -->
											<div class="testimonial-item">
												<!-- Quote -->
												<span class="quote lblue">&#8220;</span> 
												<!-- Your comments -->
												<blockquote>
													<!-- Paragraph -->
													<p> Awesome food and awesome service! My favorite restaurant in Miami! The heirloom tomato salad and the sea bass entree are my favorites. They never disappoint. Special thanks to Yahaira and Carlos for going above and beyond!</p>
												</blockquote>
												<!-- Heading with image -->
												<h4><img class="img-responsive img-circle" src="" alt="" /> Marten<span>, Fort Lauderdale</span></h4>
												<div class="clearfix"></div>
											</div>
										</li>
										<li>
											<!-- Testimonial Content -->
											<div class="testimonial-item">
												<!-- Quote -->
												<span class="quote lblue">&#8220;</span> 
												<!-- Your comments -->
												<blockquote>
													<!-- Paragraph -->
													<p>This is the restaurant we chose to celebrate our 1 year anniversary and I was so happy we went there. Amazing food, terrific ambience, great service. I am a big fan of Zuma!</p>
												</blockquote>
												<!-- Heading with image -->
												<h4><img class="img-responsive img-circle" src="" alt="" /> Katrina Doe<span>, Pompano Beach</span></h4>
												<div class="clearfix"></div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Testimonial End -->
				
				
			</div><!-- / Main Content End -->	
			
			<!-- Footer Start -->
			
			<div class="footer padd">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-sm-6">
							<!-- Footer widget -->
							<div class="footer-widget">
								<!-- Logo area -->
								<div class="logo">
									<img class="img-responsive" src="img/logo.jpg" alt="" />
									<!-- Heading -->
									<h1>OnTheGo</h1>
								</div>
								<!-- Paragraph -->
								<p>Search for restaurants around you only with one click...Search one and done..</p>
								<hr />

							</div> <!--/ Footer widget end -->
						</div>
						<div class="col-md-3 col-sm-6">
							<!-- Footer widget -->
							<div class="footer-widget">
								<!-- Heading -->
								<h4>Famous Dishes</h4>
								<!-- Images -->
								<a href="#"><img class="dish img-responsive" src="img/dish/dish1.jpg" alt="" /></a>
								<a href="#"><img class="dish img-responsive" src="img/dish/dish2.jpg" alt="" /></a>
								<a href="#"><img class="dish img-responsive" src="img/dish/dish3.jpg" alt="" /></a>
								<a href="#"><img class="dish img-responsive" src="img/dish/dish4.jpg" alt="" /></a>
								<a href="#"><img class="dish img-responsive" src="img/dish/dish5.jpg" alt="" /></a>
								<a href="#"><img class="dish img-responsive" src="img/dish/dish6.jpg" alt="" /></a>
								<a href="#"><img class="dish img-responsive" src="img/dish/dish7.jpg" alt="" /></a>
								<a href="#"><img class="dish img-responsive" src="img/dish/dish8.jpg" alt="" /></a>
								<a href="#"><img class="dish img-responsive" src="img/dish/dish9.jpg" alt="" /></a>
							</div> <!--/ Footer widget end -->
						</div>
						<div class="clearfix visible-sm"></div>
						<div class="col-md-3 col-sm-6">
							<!-- Footer widget -->
							<div class="footer-widget">
								<!-- Heading -->
								<h4>Coming Soon!</h4>
								<!-- Paragraph -->
								<p>Section Under Construction.</p>
								<!-- Subscribe form -->
								
							</div> <!--/ Footer widget end -->
						</div>
						<div class="col-md-3 col-sm-6">
							<!-- Footer widget -->
							<div class="footer-widget">
								<!-- Heading -->
								<h4>Contact Us</h4>
								<div class="contact-details">
									<!-- Address / Icon -->
									<i class="fa fa-map-marker br-red"></i> <span>Florida Atlantic University<br />777 Glades Rd<br /> Boca Raton - 33333</span>
									<div class="clearfix"></div>
									<!-- Contact Number / Icon -->
									<i class="fa fa-phone br-green"></i> <span>+1 954-123-4567</span>
									<div class="clearfix"></div>
									<!-- Email / Icon -->
									<i class="fa fa-envelope-o br-lblue"></i> <span><a href="#">onthego@onthego.com</a></span>
									<div class="clearfix"></div>
								</div>
								<!-- Social media icon -->
								<div class="social">
									<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
									<a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
									<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
									<a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a>
								</div>
							</div> <!--/ Footer widget end -->
						</div>
					</div>
					<!-- Copyright -->
					<div class="footer-copyright">
						<!-- Paragraph -->
						<p>&copy; Copyright 2015 <a href="#">On The Go</a></p>
					</div>
				</div>
			</div>
			
			<!-- Footer End -->
			
		</div><!-- / Wrapper End -->
		
		
		<!-- Scroll to top -->
		<span class="totop"><a href="#"><i class="fa fa-angle-up"></i></a></span> 
		
		
		
		<!-- Javascript files -->
		<!-- jQuery -->
		<script src="js/jquery.js"></script>
		<!-- Bootstrap JS -->
		<script src="js/bootstrap.min.js"></script>
		<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
		<script type="text/javascript" src="js/jquery.themepunch.tools.min.js"></script>
		<script type="text/javascript" src="js/jquery.themepunch.revolution.min.js"></script>
		<!-- FLEX SLIDER SCRIPTS  -->
		<script defer src="js/jquery.flexslider-min.js"></script>
		<!-- Pretty Photo JS -->
		<script src="js/jquery.prettyPhoto.js"></script>
		<!-- Respond JS for IE8 -->
		<script src="js/respond.min.js"></script>
		<!-- HTML5 Support for IE -->
		<script src="js/html5shiv.js"></script>
		<!-- Custom JS -->
		<script src="js/custom.js"></script>
		<!-- JS code for this page -->
        <!-- Typeahead JS -->
		<script src="js/typeahead.min.js"></script>
		<script>
		/* ******************************************** */
		/*  JS for SLIDER REVOLUTION  */
		/* ******************************************** */
				jQuery(document).ready(function() {
					   jQuery('.tp-banner').revolution(
						{
							delay:9000,
							startheight:500,
							
							hideThumbs:10,
							
							navigationType:"bullet",	
														
							hideArrowsOnMobile:"on",
							
							touchenabled:"on",
							onHoverStop:"on",
							
							navOffsetHorizontal:0,
							navOffsetVertical:20,
							
							stopAtSlide:-1,
							stopAfterLoops:-1,

							shadow:0,
							
							fullWidth:"on",
							fullScreen:"off"
						});
				});
		/* ******************************************** */
		/*  JS for FlexSlider  */
		/* ******************************************** */
		
			$(window).load(function(){
				$('.flexslider-recent').flexslider({
					animation:		"fade",
					animationSpeed:	1000,
					controlNav:		true,
					directionNav:	false
				});
				$('.flexslider-testimonial').flexslider({
					animation: 		"fade",
					slideshowSpeed:	5000,
					animationSpeed:	1000,
					controlNav:		true,
					directionNav:	false
				});
			});
		
		/* Gallery */

		jQuery(".gallery-img-link").prettyPhoto({
		   overlay_gallery: false, social_tools: false
		});
		
		</script>
	</body>	
</html>