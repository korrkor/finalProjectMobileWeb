<!DOCTYPE html>
<html>

    <head>
        <link href="jquery.mobile-1.4.4/jquery.mobile-1.4.5.min.css" rel="stylesheet" type="text/css"/>
        
        <script src = "jquery.mobile-1.4.4/jquery-1.11.1.min.js"></script>
        
        <script src = "jquery.mobile-1.4.4/jquery.mobile-1.4.5.min.js"></script>
        
        <script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>
        <script src="jquery.mobile-1.4.4/jquery.qrcode.min.js" type="text/javascript"></script>
        <script src="myjs.js" type="text/javascript"></script>
        <meta	name="viewport"	content="width=device-width,	initial-scale=1">
    </head>        
    <body>

        <div data-role="page" id="homepage" data-theme="a">
            <!--            <a href="#myPanel" class="ui-btn ui-btn-inline ui-icon-bars ui-btn-icon-left" data-display="reveal"></a>          
            
                        <div data-role="panel"  data-display="reveal" style = "background-color:rgb(213, 213, 213)" id="myPanel">          
                            <h2>Menu</h2>   
                            <ul data-role="listview">		
                                <li><a href="#register_page"  onclick="">Register to attend a meeting</a></li>
                                <li><a href=""  onclick="secondPage()">Check in at the meeting</a></li>
                                <li><a href="" onclick="redirect(<?php echo $lat ?>,<?php echo $long ?>)">View current location of bus</a></li>
                            </ul>
                        </div>-->
            <div data-role="header">	
                <h1></h1>	
            </div>	 
            <div role="main" class="ui-content" > 
                <ul data-role="listview">  
                    <li data-role = "fieldcontain">
                        <button  onclick="goToRegisterPage()">Register to use this app</button>   
                    </li>
                    <li data-role = "fieldcontain">
                        <button  onclick="goToLoginPage()">Log in </button>   
                    </li>
                </ul>
            </div>	
            <div data-role="footer">	

            </div>	
        </div>

        <div data-role="page" id="register_page" data-theme="a" >
            <!--            <a href="#myPanel2" class="ui-btn ui-btn-inline ui-icon-bars ui-btn-icon-left" data-display="reveal"></a>          
            
                        <div data-role="panel" data-display="reveal" style = "background-color:rgb(213, 213, 213)" id="myPanel2">          
                            <h2>Menu</h2>   
                            <ul data-role="listview">		
                                <li><a href="#register_page"  onclick="">Register to attend a meeting</a></li>
                                <li><a href="#popUp"  onclick="secondPage()">Check in at the meeting</a></li>
                                <li><a href="" onclick="redirect(<?php echo $lat ?>,<?php echo $long ?>)">View current location of bus</a></li>
                            </ul>
                        </div>-->
            <div data-role="header">	
                <h1></h1>	
            </div>	 
            <div role="main" class="ui-content" >      
               	<ul data-role="listview">
                    <li data-role = "fieldcontain">
                        <label for="name">Name:</label>	
                        <input type="text" name="name"	id="name"><br>
                    </li>

                    <li data-role = "fieldcontain">
                        <label	for="email">E-mail Address:</label>	
                        <input	type="text" name="email" id="email"><br>
                    </li>

                    <li data-role = "fieldcontain">
                        <label	for="phone_number">Phone Number</label>	
                        <input	type="text" name="phone_number"	id="phone_number"><br>	 
                    </li>

                    <li data-role = "fieldcontain">
                        <label	for="organisation">Organisation</label>	
                        <input	type="text" name="organisation"	id="organisation"><br>	
                    </li>


                    <li data-role = "fieldcontain">
                        <label	for="username">Username</label>	
                        <input	type="text" name="username" id="username"><br>	
                    </li>

                    <li data-role = "fieldcontain">
                        <label	for="password">Password</label>	
                        <input	type="text" name="password" id="password"><br>	
                    </li>

                    <li data-role = "fieldcontain">
                        <button  onclick="saveRegistration()">Save</button>   
                    </li>


                </ul>

                <!--                <div data-role="popup" id="myPopup" class="ui-content">
                                    <a href="" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a> 
                                    <div class="ui-field-contain">
                                        <h3>To complete your registration please enter your verification code</h3> 
                                        <label for="code">Id Number:</label>	
                                        <input type="text" id="code" name="code" value=""/>	
                                        <br>
                                        <button onclick= "verifyRegstration()" data-inline="true" value="Save my reservation">Verify my registration</button>
                                    </div>    
                                </div> -->
            </div>	
            <div data-role="footer">	

            </div>	
        </div>

        <div data-role="page" id="loginPage" data-theme="a">	
            <div data-role="header">	
                <h1></h1>	
            </div>
            <div role="main" class="ui-content"  >      
               	<ul data-role="listview">
                    <li data-role = "fieldcontain">
                        <label for="usernameLogin">Username:</label>	
                        <input type="text" name="usernameLogin" id="usernameLogin"><br>
                    </li>   

                    <li data-role = "fieldcontain">
                        <label for="passwordLogin">Password:</label>	
                        <input type="text" name="passwordLogin" id="passwordLogin"><br>
                    </li>

                    <li data-role = "fieldcontain">  
                        <button onclick="login_delegate()">Login</button>   
                    </li>
                </ul>
            </div>
            <div data-role="footer">	

            </div>	
        </div>

        <div id="popUp" data-role="page" data-dialog="true">
            <div data-role="header">
                <h2>Confirmation</h2>
            </div>
            <div class="ui-content" role="main">

                <div class="ui-field-contain">
                    <h3>To complete your registration please enter your verification code sent to you by sms</h3> 
                    <label for="code">Code:</label>	
                    <input type="text" id="code" name="code" value=""/>	
                    <br>
                </div>   
                <div class="ui-grid-a">
                    <div class="ui-block-a">
                        <a  id="exit-button" onclick="verifyRegstration()" class="ui-btn ui-btn-b ui-shadow ui-corner-all">Complete</a>
                    </div>
                    <div class="ui-block-b">
                        <a href="#" id="cancel-button" class="ui-btn ui-shadow ui-corner-all">Exit</a>
                    </div> 
                </div>
            </div>
        </div>

        <div data-role="page" id="delegate_view" data-theme="a">

            <div data-role="header">  
                hjhjh
                <!--                <div data-role="navbar">
                                    <ul>
                                        <li><a href="a.html" class="ui-btn-active">One</a></li>
                                        <li><a href="b.html">Two</a></li>
                                    </ul>
                                </div> -->

            </div>  

            <div data-role="main" class="ui-content">
                <div class="content-primary">
                    <div style="float:left">
                        <div id="registeredMeetings" >
                            <H2>These are the meetings you have signed up for</H2>  

                        </div>
                        <div style="float:left">
                            <a href="#myPopup" data-rel="popup" data-position-to="window" class="ui-btn ui-btn-inline">Sign up for a meeting</a>
                            <a onclick="generate()" data-rel="popup" data-position-to="window" class="ui-btn ui-btn-inline">Check into a meeting</a>       

                           
                        </div>
                        <div id="qr">
                            <a href="tel:+233573869143 "></a>
                        </div>

                    </div>
                    

                    <div style="float: right">     
                        <ul data-role="listview" data-theme="b" id="myList"  data-divider-theme="a">  
                        </ul>
                    </div>
                </div><!--/content-primary -->

                <div data-role="popup" id="myPopup" class="ui-content">
                    <a href="" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
                    <!--<form method="get" action="">-->

                    <h3>Reservation detail</h3>   
                    <div class="ui-field-contain">

                        <label>Pick the meeting you want to reserve</label>
                        <select name="day" id="day" data-native-menu="false">

                        </select>
                        <br>
                        <br>
                        <br>
                        <button onclick= "saveSignUp()" data-inline="true" value="Save my reservation">Sign me up</button>
                    </div>


                    <!--</form>-->

                </div> 
            </div>	
            <div data-role="footer">	

            </div>	
        </div>


        <div data-role="page" id="login_admin" data-theme="a">	
            <div data-role="header">	
                <h1></h1>	
            </div>

            <div data-role="main" class="ui-content">

            </div>	
            <div data-role="footer">	

            </div>	
        </div>
    </body>
</html>   