<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home Page - Enterprise Cars</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/AfterLogin1200" media="(min-width:1200px)">
        <link rel="stylesheet" href="CSS/AfterLogin1024" media="(min-width:1024px) and (max-width:1200px)">
        <link rel="stylesheet" href="CSS/AfterLogin720" media="(min-width:720px) and (max-width:1024px)">
        <link rel="stylesheet" href="CSS/AfterLogin480" media="(min-width:481px) and (max-width:720px)">
        <link rel="stylesheet" href="CSS/AfterLogin320" media="(min-width:320px) and (max-width:480px)">

        <link href="CSS/custom-theme/jquery-ui-1.10.3.custom.css" rel="stylesheet">
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui-1.10.3.custom.js"></script>

        <script>
            $(document).ready(function() {
                $("#returnLocation").css("display", "none");
                $("#myreservationsbtn").button();
                $("#viewallbtn").button();
                $("#loginbutton").button();
                $("#signupbutton").button();
                $("#submitbutton").button();
                $("#findreserbutton").button();
                $("#printbutton").button();
                $("#learnbutton").button();
                $("#tabs").tabs();
                $("#pickupdatepicker").datepicker({minDate: 0, maxDate: "+6M"});
                $("#returndatepicker").datepicker({minDate: 0, maxDate: "+1Y"});
                if ($(window).width() <= 720) {
                    $("#smallmenu").click(function() {
                        var display = $("#menu").css("display");
                        if (display == 'none') {
                            $("#menu").css("display", "block");
                        }
                        else {
                            $("#menu").css("display", "none");
                        }
                    });
                }
                
                $( document ).tooltip({
			position: {
				my: "center bottom-20",
				at: "center top",
				using: function( position, feedback ) {
					$( this ).css( position );
					$( "<div>" )
						.addClass( "arrow" )
						.addClass( feedback.vertical )
						.addClass( feedback.horizontal )
						.appendTo( this );
				}
			}
		});

                $("#signupdiv").dialog({
                    autoOpen: false,
                    width: 500,
                    modal: true,
                    create: function (){
                        $("#passwordtxt").keyup(function (){
                            $("#strength").css("display", "block");
                            var pwdLength = $(this).val();
                           if(pwdLength.length < 3){
                               $("#strengthtxt").html("Weak");
                               $("#makeimg").css("background-color", "red");
                               $("#makeimg").css("width", "20px");
                           }
                           else if(pwdLength.length < 7){
                               $("#strengthtxt").html("Medium");
                               $("#makeimg").css("background-color", "Yellow");
                               $("#makeimg").css("width", "40px");
                           }
                           else{
                               $("#strengthtxt").html("Strong");
                               $("#makeimg").css("background-color", "green");
                               $("#makeimg").css("width", "60px");
                           }
                        });
                    }
                });
                $("#viewallbtn").click(function(evt) {
                    $("#signupdiv").dialog("open");
                    evt.preventDefault();
                });


                if ($(window).width() <= 480) {
                    $("#notmember").hide();
                }



                $("#checkbox").click(function() {
                    $("#returnLocation").toggle(this.checked);
                });

                function log(message) {
                }

                $("#pickuptext, #droptext").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "http://ws.geonames.org/searchJSON",
                            datatype: "jsonp",
                            data: {
                                featureClass: "P",
                                style: "full",
                                maxRows: 10,
                                name_startsWith: request.term
                            },
                            success: function(data) {
                                response($.map(data.geonames, function(item) {
                                    return{
                                        value: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 2,
                    select: function(event, ui) {
                        log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
                    }
                });


                $("#backtotop").hide();
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 100) {
                        $('#backtotop').fadeIn();
                    } else {
                        $('#backtotop').fadeOut();
                    }
                });
                $('.backtotop').click(function() {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 'slow');
                });
                
                $("#showmeall").click(function (evt){
                    evt.preventDefault();
                });
                
                var showmeall = false; 
                
                $("#carimagesul > li > a").on("click", function (evt){
                   var type = $(this).html();
                    $("#showmeall").html(type);
                    $("#carimagesul").css("display", "none");
                    a = true;
                    show(a);
                    evt.preventDefault();
                });                
                
                
                $("#myreservationsbtn").hover(function (){
                    $.post("history.php").done(function (data){
                        $("#loginfields").html(data);
                    });
                });                
            });
            
            function show (a){
                if(a == true){
                    $("#showmeall").hover(function (){
                        $("#carimagesul").css("display", "block");
                    })
                }
            }
        </script>




    </head>
    <body>
        <div id="pageContainer">
            <header>
                <div id="header">
                    <div id="logoContainer">
                        <img src="images/enterpriseLogo.jpg" alt="Logo" id="logoImage"/>
                    </div>

                    <div id="headerTop">
                        <a href="" class="headertop">Help</a>
                        <span class="headertop">|</span>
                        <a href="" class="headertop" title="Call 24hrs 1-800-261-7331" id="contact">Contact</a>
                        <span class="headertop">|</span>
                        <a href="" class="headertop">About</a>
                        <select class="headertop" id="language">
                            <option>English</option>
                            <option>French</option>
                            <option>Espanol</option>
                            <option>Deutsch</option>
                        </select>
                    </div>

                    <div id="headerBottom">
                        <ul>
                            <li class="right" id="loginbutton"><a href="logout.php">Logout</a></li> 
                            <li class="right" id="myreservationsbtn"><a href="">My Reservations</a>
                                <div id="login-div">
                                        <div id="loginfields">
                                            <table>
                                                    <tr>
                                                        <td>date</td>
                                                        <td>cost</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><input type="submit" name="viewallbtn" value="View All" id="viewallbtn"/></td>
                                                    </tr>                                                
                                            </table>
                                        </div>
                                </div>
                            </li>
                            <li class="right fontsize" id="enterpriseplus">Hello, <?php echo $_SESSION['pname']; ?></li>                            
                        </ul>
                    </div>
                    <div id="signupdiv" title="Join Now">
                        <form>
                            <div id="formfieldsdiv">
                                <input type="text" name="nametxt" id="nametxt" placeholder="Name" required="required" />
                                <div id="passworddiv">
                                <input type="password" name="passwordltxt" id="passwordtxt" placeholder="Password" required="required" />
                                <div id="strength">
                                    <div id="strengthtxt">Weak</div>
                                    <div id="strengthimg">
                                        <div id="makeimg"></div>
                                    </div>
                                </div>
                                </div>
                                <input type="email" name="emailtxt" id="emailtxt" placeholder="Email Id" required="required"/>
                            </div>
                            <div id="checkboxdiv">
                                <input type="checkbox" name="agreecheckbox" id="agreecheckbox" required="required"> 
                                <label for="agreecheckbox">I agree with the Terms and Conditions</label>
                            </div>
                            <div id="signupbtn">
                                <button id="signupbutton"> Register </button> 
                            </div>
                        </form>
                    </div>



                </div>

                <nav>
                    <div id="menu-container">
                        <span id="smallmenu">MENU</span>
                        <ul id="menu">
                            <li class="more720"><a href="">Rent a Car</a>
                                <ul class="innerul">
                                    <li><a href="">Home</a></li>
                                    <li><a href="">Vehicles</a></li>
                                    <li><a href="">Rental Locations</a></li>
                                    <li><a href="">Business Rentals</a></li>
                                    <li><a href="">Print Your Receipt</a></li>
                                    <li><a href="">Modify A Reservation</a></li>
                                    <li><a href="">Cancel A Reservation</a></li>
                                </ul>
                            </li>
                            <li class="more720"><a href="">Business Rentals</a>
                                <ul class="innerul">
                                    <li><a href="">Home</a></li>
                                    <li><a href="">Apply Now</a></li>
                                    <li><a href="">Business Rental Reservations</a></li>
                                    <li><a href="">Print Your Receipt</a></li>
                                </ul>
                            </li>
                            <li class="more720"><a href="">Rent A Truck</a>
                                <ul class="innerul">
                                    <li><a href="">Personal Use</a></li>
                                    <li><a href="">Commercial Use</a></li>
                                    <li><a href="">Used Trucks For Sale</a></li>
                                    <li><a href="">Canada Commercial Trucks</a></li> 
                                </ul>
                            </li>
                            <li class="more720"><a href="">Buy A Car</a>
                                <ul class="innerul">
                                    <li><a href="">Home - Used Cars</a></li>
                                    <li><a href="">Used Car Finder</a></li>
                                    <li><a href="">Used Car Locations</a></li>
                                    <li><a href="">Enterprise Difference</a></li>
                                    <li><a href="">Used Car Search</a></li>
                                    <li><a href="">Satisfied Customers</a></li>
                                </ul>
                            </li>
                            <li class="more1720"><a href="">Manage Your Fleet</a>
                                <ul class="innerul">
                                    <li><a href="">Home</a></li>
                                    <li><a href="">Products And Services</a></li>
                                    <li><a href="">Fleet Locations</a></li>
                                </ul>
                            </li>
                            <li class="less720"><a href="">Discounts</a></li>
                            <li class="less720"><a href="" class="borderright">Careers</a>
                                <ul class="innerul">
                                    <li><a href="">US Careers</a></li>
                                    <li><a href="">Canada Careers</a></li>
                                    <li><a href="">UK Careers</a></li>
                                    <li><a href="">Ireland Careers</a></li>
                                    <li><a href="">Germany Careers</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </nav>
            </header>

            <div id="content">
                <div id="advertise-container">
                    <h2>Weekend Special</h2>
                    <span>Starting from
                        <span id="rate">$9.99</span>
                        per day</span><br />
                    <span>Reserve now and Learn more</span>
                </div>
                <section id="leftSection">
                    <div id="tabs">
                        <ul>
                            <li><a href="#tabs-1">Book Car</a></li>
                            <li><a href="#tabs-2">Modify Reservation</a></li>
                            <li><a href="#tabs-3">Print Receipt</a></li>
                        </ul>
                        <div id="tabs-1">
                            <section>
                                <form method="post" id="bookingForm" name="bookingForm">
                                    <div class="info">
                                        <div class="allthree">
                                            <div class="picklocation">
                                                <img src="images/1.png" alt="number1" class="numberImg"/>
                                                <article>
                                                    <div id="pickupLocation" class="pickupLocation">
                                                        <div>
                                                            <h5>Pickup Location</h5>
                                                            <span>(City, State, Zip-code,Airport or Port of Call) </span>
                                                        </div>
                                                        <div id="pickupinputdiv" class="pickupinputdiv">
                                                            <input type="text" id="pickuptext" name="pickuptext" placeholder="Enter pickup location" required="required"/>
                                                        </div>
                                                        <div id="returntoDiff">
                                                            <input type="checkbox" name="checkbox" id="checkbox" value="returnToDifferent">
                                                            <label for="checkbox">Return the car to a different location </label>
                                                        </div>
                                                        <div id="returnLocation">
                                                            <div>
                                                                <h5>Return Location</h5>
                                                                <span>(City, State, Zip-code,Airport or Port of Call) </span>
                                                            </div>
                                                            <div id="dropinputdiv" class="pickupinputdiv">
                                                                <input type="text" id="droptext" name="droptext" placeholder="Enter return location"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div class="picklocation">
                                                <img src="images/2.png" alt="number2" class="numberImg"/>
                                                <article>
                                                    <div id="pickupdate" class="pickupLocation">
                                                        <div>
                                                            <h5>Pickup Date & Time:</h5>
                                                        </div>
                                                        <div id="pickupdatediv">
                                                            <input type="text" name="pickuptext" id="pickupdatepicker" placeholder="Enter pickup date" required="required"/>
                                                            <select class="timeselector">
                                                                <option value="00:00">12:00 Midnight</option><option value="00:30">12:30 AM</option><option value="01:00">01:00 AM</option><option value="01:30">01:30 AM</option><option value="02:00">02:00 AM</option><option value="02:30">02:30 AM</option><option value="03:00">03:00 AM</option><option value="03:30">03:30 AM</option><option value="04:00">04:00 AM</option><option value="04:30">04:30 AM</option><option value="05:00">05:00 AM</option><option value="05:30">05:30 AM</option><option value="06:00">06:00 AM</option><option value="06:30">06:30 AM</option><option value="07:00">07:00 AM</option><option value="07:30">07:30 AM</option><option value="08:00">08:00 AM</option><option value="08:30">08:30 AM</option><option value="09:00">09:00 AM</option><option value="09:30">09:30 AM</option><option value="10:00">10:00 AM</option><option value="10:30">10:30 AM</option>
                                                                <option value="11:00">11:00 AM</option><option value="11:30">11:30 AM</option><option selected="selected" value="12:00">12:00 Noon</option><option value="12:30">12:30 PM</option><option value="13:00">01:00 PM</option><option value="13:30">01:30 PM</option><option value="14:00">02:00 PM</option><option value="14:30">02:30 PM</option><option value="15:00">03:00 PM</option><option value="15:30">03:30 PM</option><option value="16:00">04:00 PM</option><option value="16:30">04:30 PM</option><option value="17:00">05:00 PM</option><option value="17:30">05:30 PM</option><option value="18:00">06:00 PM</option><option value="18:30">06:30 PM</option><option value="19:00">07:00 PM</option><option value="19:30">07:30 PM</option><option value="20:00">08:00 PM</option><option value="20:30">08:30 PM</option><option value="21:00">09:00 PM</option><option value="21:30">09:30 PM</option>
                                                                <option value="22:00">10:00 PM</option><option value="22:30">10:30 PM</option><option value="23:00">11:00 PM</option><option value="23:30">11:30 PM</option>
                                                            </select>
                                                        </div>
                                                        <div id="returnDate">
                                                            <div>
                                                                <h5>Return Date & Time:</h5>
                                                            </div>
                                                            <div id="returndatediv">
                                                                <input type="text" name="pickuptext" id="returndatepicker" placeholder="Enter pickup date" required="required"/>
                                                                <select>
                                                                    <option value="00:00">12:00 Midnight</option><option value="00:30">12:30 AM</option><option value="01:00">01:00 AM</option><option value="01:30">01:30 AM</option><option value="02:00">02:00 AM</option><option value="02:30">02:30 AM</option><option value="03:00">03:00 AM</option><option value="03:30">03:30 AM</option><option value="04:00">04:00 AM</option><option value="04:30">04:30 AM</option><option value="05:00">05:00 AM</option><option value="05:30">05:30 AM</option><option value="06:00">06:00 AM</option><option value="06:30">06:30 AM</option><option value="07:00">07:00 AM</option><option value="07:30">07:30 AM</option><option value="08:00">08:00 AM</option><option value="08:30">08:30 AM</option><option value="09:00">09:00 AM</option><option value="09:30">09:30 AM</option><option value="10:00">10:00 AM</option><option value="10:30">10:30 AM</option>
                                                                    <option value="11:00">11:00 AM</option><option value="11:30">11:30 AM</option><option selected="selected" value="12:00">12:00 Noon</option><option value="12:30">12:30 PM</option><option value="13:00">01:00 PM</option><option value="13:30">01:30 PM</option><option value="14:00">02:00 PM</option><option value="14:30">02:30 PM</option><option value="15:00">03:00 PM</option><option value="15:30">03:30 PM</option><option value="16:00">04:00 PM</option><option value="16:30">04:30 PM</option><option value="17:00">05:00 PM</option><option value="17:30">05:30 PM</option><option value="18:00">06:00 PM</option><option value="18:30">06:30 PM</option><option value="19:00">07:00 PM</option><option value="19:30">07:30 PM</option><option value="20:00">08:00 PM</option><option value="20:30">08:30 PM</option><option value="21:00">09:00 PM</option><option value="21:30">09:30 PM</option>
                                                                    <option value="22:00">10:00 PM</option><option value="22:30">10:30 PM</option><option value="23:00">11:00 PM</option><option value="23:30">11:30 PM</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div class="picklocation">
                                                <img src="images/3.png" alt="number3" class="numberImg"/>
                                                <article>
                                                    <div id="age" class="pickupLocation">
                                                        <div>
                                                            <h5>Please Select an Age</h5>
                                                        </div>
                                                        <div id="ageselector">
                                                            <select>
                                                                <option>Select an age</option>
                                                                <option value="25">25 and Up</option>
                                                                <option value="24">21 to 24</option>
                                                                <option value="20">18 to 20</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>
                                        <div id="cartype" class="cartype">
                                            <div>
                                                <h5>Vehicle Class Type</h5>
                                            </div>
                                            <div id="cartypeselector">
                                                <ul id="cartypeul">
                                                    <li class="more720"><a href="" id="showmeall">Show Me All</a>
                                                        <ul class="innerul" id="carimagesul">
                                                            <li><a href="">Compact / Midsize</a>
                                                                <div class="compactdiv">
                                                                    <img src="images/compact.png" alt="Logo" id="compactimage:1" class="carimages"/>
                                                                </div>
                                                            </li>
                                                            <li><a href="">SUV / Minivan</a>
                                                                <div class="compactdiv">
                                                                    <img src="images/suv.png" alt="Logo" id="suvimage:2" class="carimages"/>
                                                                </div>
                                                            </li>
                                                            <li><a href="">Dream Cars (R)</a>
                                                                <div class="compactdiv">
                                                                    <img src="images/dream.png" alt="Logo" id="dreamimage:3" class="carimages"/>
                                                                </div>
                                                            </li>
                                                            <li><a href="">Prestige Collection</a>
                                                                <div class="compactdiv">
                                                                    <img src="images/prestige.png" alt="Logo" id="prestigeimage:4" class="carimages"/>
                                                                </div>
                                                            </li>
                                                            <li><a href="">Premium / Luxury</a>
                                                                <div class="compactdiv">
                                                                    <img src="images/luxury.png" alt="Logo" id="luxuryimage:5" class="carimages"/>
                                                                </div>
                                                            </li>
                                                            <li><a href="">Standard / Fullsize</a>
                                                                <div class="compactdiv">
                                                                    <img src="images/fullsize.png" alt="Logo" id="fullsizeimage:6" class="carimages"/>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>                                                 
                                            </div>
                                            <div id="opt">
                                                <h5 id="optional">Optional:</h5>
                                                <span id="span">(Coupon or Corporate Number) </span>
                                            </div>
                                            <div id="couponinput" class="couponinput">
                                                <input type="text" name="coupontext"/>
                                            </div>


                                        </div>  
                                        <div id="submit">
                                            <button id="submitbutton">Book Now</button>
                                        </div>
                                    </div>  
                                </form>
                            </section>
                        </div>

                        <div id="tabs-2">
                            <section>
                                <form method="post" id="modifyform" name="modifyform">
                                    <div class="info">
                                        <div class="allthree">
                                            <div class="picklocation">
                                                <div id="confirmation" class="confirmation">
                                                    <div>
                                                        <h5>Enter Confirmation Number:</h5>
                                                    </div>
                                                    <div id="confirmationinput" class="confirmationinput">
                                                        <input type="text" name="confirmationtext" required="required"/>
                                                    </div>
                                                </div>
                                                <div id="firstname" class="confirmation">
                                                    <div>
                                                        <h5>Enter First Name:</h5>
                                                    </div>
                                                    <div id="firstnameinput" class="confirmationinput">
                                                        <input type="text" name="confirmationtext" required="required"/>
                                                    </div>
                                                </div>
                                                <div id="lastname" class="confirmation">
                                                    <div>
                                                        <h5>Enter Last Name:</h5>
                                                    </div>
                                                    <div id="lastnameinput" class="confirmationinput" >
                                                        <input type="text" name="confirmationtext" required="required"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="findReservation">
                                            <button id="findreserbutton">Find My Reservation</button>
                                        </div>
                                    </div>
                                </form>
                            </section>
                        </div>




                        <div id="tabs-3">
                            <section>
                                <form method="post" id="printform" name="printform">
                                    <div class="info">
                                        <div class="allthree">
                                            <div class="picklocation">
                                                <div id="licenseNumber" class="licenseNumber">
                                                    <div>
                                                        <h5>Enter Driver's License Number:</h5>
                                                    </div>
                                                    <div id="licenseinput" class="licenseinput">
                                                        <input type="text" name="confirmationtext" required="required"/>
                                                    </div>
                                                </div>
                                                <div id="last" class="licenseNumber">
                                                    <div>
                                                        <h5>Enter Last Name:</h5>
                                                    </div>
                                                    <div id="lastinput" class="licenseinput">
                                                        <input type="text" name="confirmationtext" required="required"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="printReceipt">
                                            <button id="printbutton">Print Receipt</button>
                                        </div>
                                    </div>
                                </form>
                            </section>
                        </div>
                    </div>
                </section>
            </div>
            <div id="headerTop1">
                <a href="" class="headertop">Help</a>
                <span class="headertop">|</span>
                <a href="" class="headertop" title="Call 24hrs 1-800-261-7331" id="contact2">Contact</a>
                <span class="headertop">|</span>
                <a href="" class="headertop">About</a>
            </div>
            <div class="backtotop" id="backtotop">
                <a href="javascript:void(0)" class="backtotop">Top</a>
            </div>
        </div>
    </body>
</html>
