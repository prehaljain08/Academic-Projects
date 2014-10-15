            $(document).ready(function() {
                $("#returnLocation").css("display", "none");
                $("#joinbutton").button();
                $("#loginbutton").button();
                $("#loginbtn").button();
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
                $("#joinnow, #joinbutton").click(function(evt) {
                    $("#signupdiv").dialog("open");
                    evt.preventDefault();
                });


                if ($(window).width() <= 480) {
                    $("#notmember, #enterpriseplus").hide();
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
                                name_startsWith: request.term,
                                username: "prehaljain08",
                                country: "US"
                            },
                            success: function(data) {
                                response($.map(data.geonames, function(item) {
                                    return{
                                        value: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName
                                    }
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
                
                $("#signupbutton").click(function(evt){
                    evt.preventDefault();
                    var name = $("#nametxt").val();
                    var password = $("#passwordtxt").val();
                    var email = $("#emailtxt").val();
                    
                    $.post("register.php", {nametxt: name, passwordtxt: password, emailtxt: email}).done(function(data){
                       alert("Congrats"); 
                    });
                });
                
                
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
                
                
            });
            
            function show (a){
                if(a == true){
                    $("#showmeall").hover(function (){
                        $("#carimagesul").css("display", "block");
                    });
                }
            }