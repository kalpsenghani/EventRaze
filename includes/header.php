<?php
$ret = "Select  SiteName from tblgenralsettings ";
$querys = $dbh -> prepare($ret);
$querys->execute();
$resultss=$querys->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($querys->rowCount() > 0)
{
foreach($resultss as $rows)
{ ?>
   <div id="home" class="header-slider-area">
                <!--header start-->
                <div class="header-area header-2">
                    <!--logo menu area start-->
                    <div id="sticker" class="logo-menu-area header-area-2">
                        <div class="container hidden-xs">
                            <div class="row align-items-center">
                                <div class="col-md-3 col-sm-3">
                                    <div class="logo">
                                        <a href="index.php">
                                            <img src="img/E1.png" alt="EventRaze Logo" style="max-height: 70px; width: auto;">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <div class="main-menu">
                                        <nav>
                                            <ul id="nav">
                                                <li><a class="smooth-scroll" href="index.php">Home</a></li>
                                                <li><a class="smooth-scroll" href="about-us.php">About Us</a></li>                                           
                                                <li><a class="smooth-scroll" href="all-events.php">Events</a></li>
                                                <li><a class="smooth-scroll" href="news.php">News</a></li>
                                                <li class="search-item">
                                                    <form method="GET" action="search-result.php" class="header-search-form">
                                                        <input type="text" name="search" placeholder="Search events..." class="search-input">
                                                        <button type="submit" class="search-button">
                                                            <i class="zmdi zmdi-search"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                                <?php if(strlen($_SESSION['usrid']==0)){ ?>
                                                    <li><a class="smooth-scroll btn-auth" href="signup.php">Signup</a></li>
                                                    <li><a class="smooth-scroll btn-auth" href="signin.php">Login</a></li>
                                                <?php } else { ?>
                                                    <li><a class="smooth-scroll btn-auth" href="profile.php">My Account</a></li>
                                                <?php } ?>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--logo menu area end-->
                                <!-- mobile-menu-area start -->
                                <div class="mobile-menu-area">
                                    <div class="container">
                                        <div class="logo-02">
                                           <a href="index.php" style="font-size:42px; color:#fff"><?php echo htmlentities($rows->SiteName);?></a>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <nav id="dropdown">
                                                    <ul>
                                            <li><a class="smooth-scroll" href="#home">Home</a></li>
                                                <li><a class="smooth-scroll" href="about-us.php">About Us</a></li>                                           
                                                <li><a class="smooth-scroll" href="all-events.php">Events</a></li>
                                                <li><a class="smooth-scroll" href="news.php">News</a></li>
                                                <li>
                                                    <form method="GET" action="search-result.php" class="header-search-form">
                                                        <input type="text" name="search" placeholder="Search events..." class="search-input">
                                                        <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
                                                    </form>
                                                </li>
                                                <li><a class="smooth-scroll" href="signup.php">Signup</a></li>
                                                 <li><a class="smooth-scroll" href="#contact">Login</a></li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--mobile menu area end-->
                        </div> 
                    </div>
                    <script id="messenger-widget-b" src="https://cdn.botpenguin.com/website-bot.js" defer>67aed623093d842c4822a78b,67aecc479c1ce287ed52bd8e</script>
                          

                          
                    <?php }} ?>