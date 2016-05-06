<?php

$email = array('j.reinisch@primus-romulus.net');
// subject
$subject = 'Primus Romulus';
// message
$message = '
<html xmlns:v="urn:schemas-microsoft-com:vml"><head>

  <!-- Define Charset -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <!-- Responsive Meta Tag -->
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
  
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet" type="text/css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script><style type="text/css"></style>
  <script src="http://pickedmail.com/mira/demo/js/jquery-ui.min.js"></script>
  <script src="../js/main.js"></script>
  
    <title>Mira - Responsive Email Template</title><!-- Responsive Styles and Valid Styles -->

    <style type="text/css">
    
      body{
            width: 100%; 
            background-color: #ffffff; 
            margin:0; 
            padding:0; 
            -webkit-font-smoothing: antialiased;
            mso-margin-top-alt:0px; mso-margin-bottom-alt:0px; mso-padding-alt: 0px 0px 0px 0px;
        }
        
        p,h1,h2,h3,h4{
          margin-top:0;
      margin-bottom:0;
      padding-top:0;
      padding-bottom:0;
        }
        
        span.preheader{display: none; font-size: 1px;}
        
        html{
            width: 100%; 
        }
        
        table{
            font-size: 14px;
            border: 0;
            transition: all .5s;
        }
    
    table td{
      transition: all .5s;
    }
    
    .action-btn{
          width: 30px;
          position: absolute;
          left: 10px;
          top: 35%;
          z-index: 2000;
        }
        a{
          transition: all .5s;
        }
               
        #promail{
          list-style: none;
          margin: 0;
          padding: 0;
        }
        #promail li{
          position: relative;
          cursor: n-resize;
        }
               
    .test{
      width: 100%;
      position: relative;
    }
    
    .test .icon {
      position: absolute;
      top: 2px;
      right: 2px;
    }
        
    #promail .test .icon img{width: 35px !important; height: 27px !important;}
    
    
     /* ----------- responsivity ----------- */
    @media only screen and (max-width: 800px){ 
      body[yahoo] .container800{width: 100% !important;}  
    }
    
    
        @media only screen and (max-width: 640px){
      /*------ top header ------ */ 
            body[yahoo] .main-header{font-size: 22px !important;}
            body[yahoo] .main-section-header{font-size: 38px !important;}
            body[yahoo] .show{display: block !important;}
            body[yahoo] .hide{display: none !important;}
            body[yahoo] .align-center{text-align: center !important;}
            
            /*----- main image -------*/
      body[yahoo] .main-image img{width: 440px !important; height: auto !important;}
       
      /* ====== divider ====== */
      body[yahoo] .divider img{width: 440px !important;}
      
      /*--------- banner ----------*/
      body[yahoo] .banner img{width: 440px !important; height: auto !important;}
      /*-------- container --------*/
      body[yahoo] .container800{width: 100% !important;}
      body[yahoo] .container590{width: 440px !important;}
      body[yahoo] .container580{width: 400px !important;}
      body[yahoo] .half-container{width: 380px !important;}
           
      /*-------- secions ----------*/
      body[yahoo] .section-item{width: 440px !important;}
            body[yahoo] .section-img img{width: 440px !important; height: auto !important;}
            body[yahoo] .gallery-img img{width: 320px !important; height: auto !important;}        
        }

    @media only screen and (max-width: 479px){
      /*------ top header ------ */
            body[yahoo] .main-header{font-size: 20px !important;}
            body[yahoo] .main-section-header{font-size: 30px !important;}
            /*----- main image -------*/
      body[yahoo] .main-image img{width: 280px !important; height: auto !important;}
       
      /* ====== divider ====== */
      body[yahoo] .divider img{width: 280px !important;}
      body[yahoo] .align-center{text-align: center !important;}
      
      /*--------- banner ----------*/
      body[yahoo] .banner img{width: 280px !important; height: auto !important;}
      /*-------- container --------*/
      body[yahoo] .container800{width: 100% !important;}
      body[yahoo] .container590{width: 280px !important;}
      body[yahoo] .container580{width: 260px !important;}
      body[yahoo] .wide-iphone{width: 210px !important;}
      body[yahoo] .half-container{width: 210px !important;}
           
      /*-------- secions ----------*/
      body[yahoo] .section-item{width: 280px !important;}
      body[yahoo] .section-item-iphone{width: 280px !important;}
            body[yahoo] .section-img img{width: 280px !important; height: auto !important;}  
            body[yahoo] .section-iphone-img img{width: 280px !important; height: auto !important;}
            
            /*------- CTA -------------*/
            
      body[yahoo] .cta-btn img{width: 260px !important; height: auto !important;}
    }
    
</style>
</head>

<body yahoo="fix" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  
  <!-- ======= main section ======= -->
  <ul id="promail" class="ui-sortable">
  <li>
    <div class="action-btn" style="display: block;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="8a5a8d">
    
    <tbody><tr>
      <td>
        <table border="0" align="center" width="800" cellpadding="0" cellspacing="0" class="container800">
          <tbody><tr>
            <td align="center" style="background-image: url(http://pickedmail.com/mira/img/main-bg.png); background-size: 100% 100%; background-position: top center; background-repeat: repeat;" background="http://pickedmail.com/mira/img/main-bg.png" class="main-bg">
            
              <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                
                <tbody><tr><td height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
                
                <tr>
                  <td>
                    <table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                      <tbody><tr>
                        <td align="center">
                          <table border="0" cellpadding="0" cellspacing="0" align="center">
                            <tbody><tr><td height="5" style="font-size: 5px; line-height: 5px;">&nbsp;</td></tr>
                            <tr>
                              
                              <!-- ======= logo ======= -->
                              
                              <td align="center">
                                <a href="" style="display: block; border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="logo" width="76" border="0" style="display: block; width: 76px;" src="http://pickedmail.com/mira/img/logo.png" alt="logo"></a>
                              </td>     
                            </tr>
                          </tbody></table>    
                        </td>
                      </tr>
                    </tbody></table>
                    
                            <table border="0" align="left" width="5" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                              <tbody><tr><td height="20" width="5" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                            </tbody></table>
                            
                            <table border="0" align="right" cellpadding="0" width="300" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                      <tbody><tr><td height="5" style="font-size: 5px; line-height: 5px;">&nbsp;</td></tr>
                      <tr>
                        <td>
                          <table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
            
                                    <tbody><tr>
                                      <td align="center">
                                        <table align="center" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                                          
                                          <tbody><tr><td height="5" style="font-size: 5px; line-height: 5px;">&nbsp;</td></tr>
                                          
                                          <tr>
                                            
                                            <td align="center" mc:edit="navigation" style="color: #ffffff; font-size: 12px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 28px;">
                                              <div class="editable_text" style=" line-height: 28px;">
                                                <span class="text_container">
                                                <multiline>
                                                  <a href="" style="color: #ffffff; text-decoration: none;" class="white_color">Shop</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" style="color: #ffffff; text-decoration: none;" class="white_color">Work</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" style="color: #ffffff; text-decoration: none;" class="white_color">Contact</a>
                                                </multiline>
                                                </span>
                                              </div>  
                                            </td>
                                          </tr>
                                        </tbody></table>
                                      </td>
                                    </tr>
                                    
                                  </tbody></table>
                                  
                                  <table border="0" align="left" width="5" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                    <tbody><tr><td height="20" width="5" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                                  </tbody></table>
                                  
                          <table border="0" cellpadding="0" cellspacing="0" align="right" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                            <tbody><tr>
                              <td align="center">
                                <table border="0" align="center" width="97" cellpadding="0" cellspacing="0" class="main_color" style="border: solid 1px rgba(255, 255, 255, .4); border-radius: 5px;">
                      
                                  <tbody><tr><td height="5" style="font-size: 5px; line-height: 5px;">&nbsp;</td></tr>
                                  
                                  <tr>
                                            <td align="center" style="color: #ffffff; font-size: 12px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 24px;" mc:edit="view-button">
                                              <!-- ======= main section button ======= -->
                                              
                                                <div class="editable_text" style="line-height: 24px;">
                                                  <span class="text_container">
                                                  <a href="" style="color: #ffffff; text-decoration: none;" class="white_color"><singleline>View online</singleline></a>
                                                  </span>
                                                </div>
                                              </td>
                                            </tr>
                                  
                                  <tr><td height="5" style="font-size: 5px; line-height: 5px;">&nbsp;</td></tr>
                                
                                </tbody></table>
                              </td>
                            </tr>
                                    </tbody></table>
                        </td>
                      </tr> 
                    </tbody></table>
                    
                  </td>
                </tr>
                
                <tr class="hide"><td height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
                <tr><td height="60" style="font-size: 60px; line-height: 60px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center" height="42" mc:edit="main-header" style="color: #ffffff; font-size: 39px; font-family: Arial, Calibri, sans-serif; mso-line-height-rule: exactly; line-height: 42px;" class="white_color main-section-header">
                    
                    <!-- ======= section header ======= -->
                    
                    <div class="editable_text" style="line-height: 42px;">
                      <span class="text_container">
                          <multiline>
                            Hello Dear Customer
                          </multiline>
                      </span>
                    </div>
                      </td>
                </tr>
                
                <tr><td height="35" style="font-size: 35px; line-height: 35px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center">
                    <table border="0" width="520" align="center" cellpadding="0" cellspacing="0" class="container590">
                      <tbody><tr>
                        
                        <td align="center" mc:edit="main-text" style="color: #ffffff; font-size: 15px; font-family: Arial, Calibri, sans-serif; mso-line-height-rule: exactly; line-height: 26px;" class="white_color">
                          
                          <div class="editable_text" style="line-height: 26px">
                            <!-- ======= section text ======= -->
                            <span class="text_container">
                                <multiline>
                                  Lorem ipsum dolor sit amet, consectetur adipiscing elit orbi quis sodales min in risus id sem lobortis ullamcorper etiam accumsan urna eros aliquet and pulvinar urna pretium. 
                                </multiline>
                            </span>
                          </div>
                            </td> 
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
                
                <tr><td height="50" style="font-size: 50px; line-height: 50px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center">
                    
                    <table border="0" align="center" width="156" cellpadding="0" cellspacing="0" bgcolor="1eb9d0" class="button_color" style="border-radius: 5px;">
                      
                      <tbody><tr>
                                <td align="center" style="color: #ffffff; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 30px;" mc:edit="main-button">
                                  <!-- ======= main section button ======= -->
                                  
                                    <div class="editable_text" style="line-height: 30px;">
                                      <span class="text_container">
                                        <a href="" style="color: #ffffff; text-decoration: none;"><singleline>Read more</singleline></a>
                                      </span>
                                    </div>
                                  </td>
                                  <td>
                                    <img width="2" height="42" style="width: 2px; height: 42px;" src="http://pickedmail.com/mira/img/border.png">
                                  </td>
                                  <td width="40" align="center" valign="middle">
                                    <img width="6" height="9" style="width: 6px; height: 9px;" src="http://pickedmail.com/mira/img/white-arrow.png">
                                  </td>
                                </tr>
                      
                    </tbody></table>
                  </td>
                </tr>
                
                <tr class="hide"><td height="55" style="font-size: 55px; line-height: 55px;">&nbsp;</td></tr>
                <tr><td height="60" style="font-size: 60px; line-height: 60px;">&nbsp;</td></tr>
                
              </tbody></table>
            </td>
          </tr>
        </tbody></table>
      </td>
    </tr>
    
  </tbody></table>
  </li>
  <!-- ======= end main section ======= -->
  
  
  
  <!-- ======= features ====== -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color"> 
    
    <tbody><tr><td height="50" style="font-size: 50px; line-height: 50px;">&nbsp;</td></tr>
    
    <tr>
      <td align="center">
        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
          
          <tbody><tr>
            <td>
              <table border="0" width="260" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                
                
                <tbody><tr>                 
                  <!-- ======= icon ====== -->
            
                  <td align="left" valign="top" width="50">
                    <span class="editable_img"><img editable="true" mc:edit="feature-icon1" src="http://pickedmail.com/mira/img/feature-icon1.png" style="display: block; width: 37px;" width="37" border="0" alt=""></span>
                  </td>
                  
                  <td>
                    <table border="0" cellpadding="0" align="left" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">           
                      <tbody><tr>
                        <td align="left" mc:edit="feature-title1" style="color: #2f2f2f; font-size: 17px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                          <!-- ======= section text ====== -->
                          
                          <div class="editable_text" style="line-height: 22px">
                            <span class="text_container">
                                <multiline>
                                  Raise your convetions
                                </multiline>
                            </span>
                          </div>
                            </td> 
                      </tr>
                      
                      <tr><td height="7" style="font-size: 7px; line-height: 7px;">&nbsp;</td></tr>
                      
                      <tr>
                        <td align="left" mc:edit="feature-text1" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 24px;" class="text_color">
                          <!-- ======= section subtitle ====== -->
                          
                          <div class="editable_text" style="line-height: 24px;">
                            <span class="text_container">
                                <multiline>
                                  Lorem ipsum dolor sit amet consec tetur adipiscing elit orbi quis sodales min in 
                                </multiline>
                            </span>
                          </div>
                            </td>
                      </tr>
                        
                    </tbody></table>
                  </td>
                </tr>
                            
              </tbody></table>
  
              <table border="0" width="5" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr><td width="5" height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
              </tbody></table>
              
              <table border="0" width="260" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                
                
                <tbody><tr>                 
                  <!-- ======= icon ====== -->
            
                  <td align="left" valign="top" width="50">
                    <span class="editable_img"><img editable="true" mc:edit="feature-icon2" src="http://pickedmail.com/mira/img/feature-icon2.png" style="display: block; width: 37px;" width="37" border="0" alt=""></span>
                  </td>
                  
                  <td>
                    <table border="0" cellpadding="0" align="left" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">           
                      <tbody><tr>
                        <td align="left" mc:edit="feature-title2" style="color: #2f2f2f; font-size: 17px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                          <!-- ======= section text ====== -->
                          
                          <div class="editable_text" style="line-height: 22px">
                            <span class="text_container">
                                <multiline>
                                  Online Editor
                                </multiline>
                            </span>
                          </div>
                            </td> 
                      </tr>
                      
                      <tr><td height="7" style="font-size: 7px; line-height: 7px;">&nbsp;</td></tr>
                      
                      <tr>
                        <td align="left" mc:edit="feature-text2" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 24px;" class="text_color">
                          <!-- ======= section subtitle ====== -->
                          
                          <div class="editable_text" style="line-height: 24px;">
                            <span class="text_container">
                                <multiline>
                                  Lorem ipsum dolor sit amet consec tetur adipiscing elit orbi quis sodales min in 
                                </multiline>
                            </span>
                          </div>
                            </td>
                      </tr>
                        
                    </tbody></table>
                  </td>
                </tr>
                            
              </tbody></table>
              
            </td>
          </tr>
          
          <tr><td height="50" style="font-size: 50px; line-height: 50px;">&nbsp;</td></tr>
          
          <tr>
            <td>
              <table border="0" width="260" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                
                
                <tbody><tr>                 
                  <!-- ======= icon ====== -->
            
                  <td align="left" valign="top" width="50">
                    <span class="editable_img"><img editable="true" mc:edit="feature-icon3" src="http://pickedmail.com/mira/img/feature-icon3.png" style="display: block; width: 37px;" width="37" border="0" alt=""></span>
                  </td>
                  
                  <td>
                    <table border="0" cellpadding="0" align="left" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">           
                      <tbody><tr>
                        <td align="left" mc:edit="feature-title3" style="color: #2f2f2f; font-size: 17px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                          <!-- ======= section text ====== -->
                          
                          <div class="editable_text" style="line-height: 22px"> 
                            <span class="text_container">
                                <multiline>
                                  Perfect email
                                </multiline>
                            </span>
                          </div>
                            </td> 
                      </tr>
                      
                      <tr><td height="7" style="font-size: 7px; line-height: 7px;">&nbsp;</td></tr>
                      
                      <tr>
                        <td align="left" mc:edit="feature-text3" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 24px;" class="text_color">
                          <!-- ======= section subtitle ====== -->
                          
                          <div class="editable_text" style="line-height: 24px;">
                            <span class="text_container">
                                <multiline>
                                  Lorem ipsum dolor sit amet consec tetur adipiscing elit orbi quis sodales min in 
                                </multiline>
                            </span>
                          </div>
                            </td>
                      </tr>
                        
                    </tbody></table>
                  </td>
                </tr>
                            
              </tbody></table>
  
              <table border="0" width="5" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr><td width="5" height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
              </tbody></table>
              
              <table border="0" width="260" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                
                
                <tbody><tr>                 
                  <!-- ======= icon ====== -->
            
                  <td align="left" valign="top" width="50">
                    <span class="editable_img"><img editable="true" mc:edit="feature-icon4" src="http://pickedmail.com/mira/img/feature-icon4.png" style="display: block; width: 37px;" width="37" border="0" alt=""></span>
                  </td>
                  
                  <td>
                    <table border="0" cellpadding="0" align="left" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">           
                      <tbody><tr>
                        <td align="left" mc:edit="feature-title4" style="color: #2f2f2f; font-size: 17px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                          <!-- ======= section text ====== -->
                          
                          <div class="editable_text" style="line-height: 22px">
                            <span class="text_container">
                                <multiline>
                                  Raise your convetions
                                </multiline>
                            </span>
                          </div>
                            </td> 
                      </tr>
                      
                      <tr><td height="7" style="font-size: 7px; line-height: 7px;">&nbsp;</td></tr>
                      
                      <tr>
                        <td align="left" mc:edit="feature-text4" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 24px;" class="text_color">
                          <!-- ======= section subtitle ====== -->
                          
                          <div class="editable_text" style="line-height: 24px;">
                            <span class="text_container">
                                <multiline>
                                  Lorem ipsum dolor sit amet consec tetur adipiscing elit orbi quis sodales min in 
                                </multiline>
                            </span>
                          </div>
                            </td>
                      </tr>
                        
                    </tbody></table>
                  </td>
                </tr>
                            
              </tbody></table>
              
            </td>
          </tr>
          
        </tbody></table>
      </td>
    </tr>
    
    <tr><td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td></tr>
    
  </tbody></table>
  </li>
  <!-- ======= end features ====== -->


  <!-- ======= 1/2 image 1/2 text ======= -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="eeeeee" class="bg2_color">
    
    <tbody><tr><td height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td></tr>
    
    <tr>
      <td align="center">
        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
          
          <tbody><tr>
            <td>  
              <table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                
                <!-- ======= section image ====== -->
                <tbody><tr>
                  <td align="center">
                    <a href="" style=" border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="img1" src="http://pickedmail.com/mira/img/img1.png" style="display: block; width: 223px;" width="223" border="0" alt="section image"></a>
                  </td>
                </tr>
              </tbody></table>
              
              
              <table border="0" width="5" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr><td width="5" height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
              </tbody></table>
              
              
              <table border="0" width="330" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                
                <tbody><tr><td height="15" style="font-size: 15px; line-height: 15px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="left" mc:edit="title1" style="color: #2f2f2f; font-size: 17px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                    <!-- ======= section text ====== -->
                    
                    <div class="editable_text" style="line-height: 22px">
                      <span class="text_container">
                          <multiline>
                            What we are doing ?
                          </multiline>
                      </span>
                    </div>
                      </td> 
                </tr>
                
                <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="left" mc:edit="text1" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                    <!-- ======= section subtitle ====== -->
                    
                    <div class="editable_text" style="line-height: 26px;">
                      <span class="text_container">
                          <multiline>
                            Lorem ipsum dolor sit amet love port amet coro consectetur adipiscing elitare quis sodales min risus identi ras obortis fola ullamcorper orolaero claver orbi quis  elegant
                          </multiline>
                      </span>
                    </div>
                      </td>
                </tr>
                
              </tbody></table>
                        
            </td>
          </tr>
        </tbody></table>
      </td>
    </tr>
    
    <tr><td height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td></tr>
    
  </tbody></table>
  </li>
  <!-- ======= end section ======= -->
  
  
  
  <!-- ======= gallery ======= -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="1eb9d0" class="blue_bg" style="border-top: solid 1px #f0f0f0; border-bottom: solid 1px #f0f0f0;">
        
    <tbody><tr><td height="55" style="font-size: 55px; line-height: 55px;">&nbsp;</td></tr>
    
    <tr>
      <td align="center">
        
        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
          
          <tbody><tr>
            <td align="center" mc:edit="gallery-header" style="color: #ffffff; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 700; mso-line-height-rule: exactly; line-height: 24px;" class="main-header white_color">
              
              <!-- ======= main header ======= -->
              
              <div class="editable_text" style="line-height: 24px;">
                <span class="text_container">
                    <multiline>
                      CHECK OUR GALLERY
                    </multiline>
                </span>
              </div>
              
                </td> 
          </tr>
          
          <tr><td height="12" style="font-size: 12px; line-height: 12px;">&nbsp;</td></tr>
          
          <tr>
            <td align="center">
              <table align="center" width="73" border="0" cellpadding="0" cellspacing="0" bgcolor="ffffff">
                <tbody><tr><td height="1" style="font-size: 1px; line-height: 1px;"></td></tr>
              </tbody></table>
            </td>
          </tr>
          
          <tr><td height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td></tr>
                
          <tr>
            <td>
              <table border="0" width="385" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr>
                  <td>
                    <table border="0" width="180" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                      
                      <tbody><tr>
                      
                        <!-- ======= image 180px / any height ======= -->
                        
                        <td align="center" class="gallery-img">
                          <a href="" style=" border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="galery-img1" src="http://pickedmail.com/mira/img/gallery-img1.png" style="display: block; width: 180px;" width="180" border="0" alt="gallery image"></a>
                        </td>
                      </tr>
                      
                    </tbody></table>
                    
                    <table border="0" width="2" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                      <tbody><tr><td width="2" height="30" style="font-size: 30px; line-height: 30px;"></td></tr>
                    </tbody></table>
                    
                    <table border="0" width="180" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                      
                      <tbody><tr>
                      
                        <!-- ======= image 180px / any height ======= -->
                        
                        <td align="center" class="gallery-img">
                          <a href="" style=" border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="galery-img2" src="http://pickedmail.com/mira/img/gallery-img2.png" style="display: block; width: 180px;" width="180" border="0" alt="gallery image"></a>
                        </td>
                      </tr>
                                                
                    </tbody></table>
                  </td>
                </tr>
              </tbody></table>
              
              
              <table border="0" width="2" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr><td width="2" height="30" style="font-size: 30px; line-height: 30px;"></td></tr>
              </tbody></table>
              
              
              <table border="0" width="180" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                      
                <tbody><tr>
                
                  <!-- ======= image 180px / any height ======= -->
                  
                  <td align="center" class="gallery-img">
                    <a href="" style=" border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="galery-img3" src="http://pickedmail.com/mira/img/gallery-img3.png" style="display: block; width: 180px;" width="180" border="0" alt="gallery image"></a>
                  </td>
                </tr>
                
              </tbody></table>
                
            </td>
          </tr>
        </tbody></table>
      </td>
    </tr>
    
    <tr><td height="60" style="font-size: 60px; line-height: 60px;">&nbsp;</td></tr>
    
  </tbody></table>
  </li>
  <!-- ======= end section ======= -->


  
  <!-- ======= 1/2 text 1/2 image ======= -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
    
    <tbody><tr><td height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td></tr>
    
    <tr>
      <td align="center">
        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
          
          <tbody><tr>
            <td>
              
              <table border="0" width="330" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                
                <tbody><tr><td height="15" style="font-size: 15px; line-height: 15px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="left" mc:edit="title2" style="color: #2f2f2f; font-size: 17px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                    <!-- ======= section text ====== -->
                    
                    <div class="editable_text" style="line-height: 22px">
                      <span class="text_container">
                          <multiline>
                            Amazing email template
                          </multiline>
                      </span>
                    </div>
                      </td> 
                </tr>
                
                <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="left" mc:edit="text2" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                    <!-- ======= section subtitle ====== -->
                    
                    <div class="editable_text" style="line-height: 26px;">
                      <span class="text_container">
                          <multiline>
                            Lorem ipsum dolor sit amet love port amet coro consectetur adipiscing elitare quis sodales min risus identi ras obortis fola ullamcorper orolaero claver orbi quis  elegant
                          </multiline>
                      </span>
                    </div>
                      </td>
                </tr>
                
              </tbody></table>
              
              <table border="0" width="5" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr><td width="5" height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
              </tbody></table>
                
              <table border="0" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                
                <!-- ======= section image ====== -->
                <tbody><tr>
                  <td align="center">
                    <a href="" style=" border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="img2" src="http://pickedmail.com/mira/img/img2.png" style="display: block; width: 223px;" width="223" border="0" alt="section image"></a>
                  </td>
                </tr>
              </tbody></table>
                                    
            </td>
          </tr>
        </tbody></table>
      </td>
    </tr>
    
    <tr><td height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td></tr>
    
  </tbody></table>
  </li>
  <!-- ======= end section ======= -->

  
  
  
  <!-- ======= 2 columns headline and text ======= -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="eeeeee" class="bg2_color">
    <tbody><tr>
      <td align="center">
        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
          
          <tbody><tr><td height="50" style="font-size: 50px; line-height: 50px;">&nbsp;</td></tr>
          
          <tr>
            <td>  
              <table border="0" width="260" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                
                <tbody><tr>
                  <td align="left" mc:edit="2col-title1" style="color: #2f2f2f; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                    <!-- ======= section text ====== -->
                    
                    <div class="editable_text" style="line-height: 22px">
                      <span class="text_container">
                          <multiline>
                            What we are doing ?
                          </multiline>
                      </span>
                    </div>
                      </td> 
                </tr>
                
                <tr><td height="17" style="font-size: 17px; line-height: 17px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="left">
                    <table align="left" width="73" border="0" cellpadding="0" cellspacing="0" bgcolor="2f2f2f" style="background-color: rgba(47,47,47,.34);">
                      <tbody><tr><td height="1" style="font-size: 1px; line-height: 1px;"></td></tr>
                    </tbody></table>
                  </td>
                </tr>
                
                <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="left" mc:edit="2col-text1" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                    <!-- ======= section subtitle ====== -->
                    
                    <div class="editable_text" style="line-height: 26px;">
                      <span class="text_container">
                      <multiline>
                            Lorem ipsum dolor sit amet love port amet consectetur adipiscing elitare quis sodales min in risus identi raslobortis fola ullamcorper orolaero claver orbi quis  elegant
                      </multiline>
                      </span>
                    </div>
                      </td>
                </tr>
                                      
              </tbody></table>
              
              <table border="0" width="2" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr><td width="2" height="30" style="font-size: 30px; line-height: 30px;"></td></tr>
              </tbody></table>
                      
                      <table border="0" width="260" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                
                <tbody><tr>
                  <td align="left" mc:edit="2col-title2" style="color: #2f2f2f; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                    <!-- ======= section text ====== -->
                    
                    <div class="editable_text" style="line-height: 22px">
                      <span class="text_container">
                          <multiline>
                            Who we are ?
                          </multiline>
                      </span>
                    </div>
                      </td> 
                </tr>
                
                <tr><td height="17" style="font-size: 17px; line-height: 17px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="left">
                    <table align="left" width="73" border="0" cellpadding="0" cellspacing="0" bgcolor="2f2f2f" style="background-color: rgba(47,47,47,.34);">
                      <tbody><tr><td height="1" style="font-size: 1px; line-height: 1px;"></td></tr>
                    </tbody></table>
                  </td>
                </tr>
                
                <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="left" mc:edit="2col-text2" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                    <!-- ======= section subtitle ====== -->
                    
                    <div class="editable_text" style="line-height: 26px;">
                      <span class="text_container">
                      <multiline>
                            Lorem ipsum dolor sit amet love port amet consectetur adipiscing elitare quis sodales min in risus identi raslobortis fola ullamcorper orolaero claver orbi quis  elegant
                      </multiline>
                      </span>
                    </div>
                      </td>
                </tr>
                                      
              </tbody></table>
            </td>
          </tr>
        </tbody></table>
      </td>
    </tr>
    
    <tr><td height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td></tr>
    
  </tbody></table>
  </li>
  <!-- ======= end section ======= -->


  <!-- ======= features section ======= -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
    
    <tbody><tr><td height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td></tr>
          
    <tr>
      <td align="center">
        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
          
          <tbody><tr>
            <td align="center" mc:edit="feature-header" style="color: #2f2f2f; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 700; mso-line-height-rule: exactly; line-height: 24px;" class="title_color">
              
              <!-- ======= main header ======= -->
              
              <div class="editable_text" style="line-height: 24px;">
                <span class="text_container">
                    <multiline>
                      SOME FEATURES
                    </multiline>
                </span>
              </div>
              
                </td> 
          </tr>
          
          <tr><td height="12" style="font-size: 12px; line-height: 12px;">&nbsp;</td></tr>
          
          <tr>
            <td align="center">
              <table align="center" width="73" border="0" cellpadding="0" cellspacing="0" bgcolor="dddddd">
                <tbody><tr><td height="1" style="font-size: 1px; line-height: 1px;"></td></tr>
              </tbody></table>
            </td>
          </tr>
          
          <tr><td height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td></tr>
          
          <tr>
            <td>
              <table border="0" width="380" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="section-item">
                <tbody><tr>
                  <td>
                    <table border="0" width="170" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                      <tbody><tr>
                        
                        <!-- ======= feature image 51px width ======= -->
                        
                        <td align="center">
                          <a href="" style=" border-style: none !important; display: block; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="feature-image1" src="http://pickedmail.com/mira/img/feature-img1.png" style="display: block; width: 116px;" width="116" border="0" alt="feature image"></a>
                        </td>
                      </tr>
                      
                      <tr><td height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
                      
                      <tr>
                        <td align="center" mc:edit="feature-title5" style="color: #2f2f2f; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                          <!-- ======= section text ====== -->
                          
                          <div class="editable_text" style="line-height: 22px">
                            <span class="text_container">
                                <multiline>
                                  Support
                                </multiline>
                            </span>
                          </div>
                            </td> 
                      </tr>
                      
                      <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                      
                      <tr>
                        <td align="center" mc:edit="feature-text5" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                          <!-- ======= section subtitle ====== -->
                          
                          <div class="editable_text" style="line-height: 26px;">
                            <span class="text_container">
                            <multiline>
                                  Lorem ipsum dolor sit amet love port amet consectetur adipi
                            </multiline>
                            </span>
                          </div>
                            </td>
                      </tr>
                                            
                    </tbody></table>
                    
                    <table border="0" width="2" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                      <tbody><tr><td width="2" height="30" style="font-size: 30px; line-height: 30px;"></td></tr>
                    </tbody></table>
                            
                            <table border="0" width="170" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                      <tbody><tr>
                        
                        <!-- ======= feature image 51px width ======= -->
                        
                        <td align="center">
                          <a href="" style=" border-style: none !important; display: block; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="feature-image2" src="http://pickedmail.com/mira/img/feature-img2.png" style="display: block; width: 116px;" width="116" border="0" alt="feature image"></a>
                        </td>
                      </tr>
                      
                      <tr><td height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
                      
                      <tr>
                        <td align="center" mc:edit="feature-title6" style="color: #2f2f2f; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                          <!-- ======= section text ====== -->
                          
                          <div class="editable_text" style="line-height: 22px">
                            <span class="text_container">
                                <multiline>
                                  Compatible
                                </multiline>
                            </span>
                          </div>
                            </td> 
                      </tr>
                      
                      <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                      
                      <tr>
                        <td align="center" mc:edit="feature-text6" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                          <!-- ======= section subtitle ====== -->
                          
                          <div class="editable_text" style="line-height: 26px;">
                            <span class="text_container">
                            <multiline>
                                  Lorem ipsum dolor sit amet love port amet consectetur adipi
                            </multiline>
                            </span>
                          </div>
                            </td>
                      </tr>
                                            
                    </tbody></table>

                  </td>
                </tr>
              </tbody></table>
              
              <table border="0" width="2" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr><td width="2" height="30" style="font-size: 30px; line-height: 30px;"></td></tr>
              </tbody></table>
                      
                      <table border="0" width="170" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr>
                  
                  <!-- ======= feature image 51px width ======= -->
                  
                  <td align="center">
                    <a href="" style=" border-style: none !important; display: block; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="feature-image3" src="http://pickedmail.com/mira/img/feature-img3.png" style="display: block; width: 116px;" width="116" border="0" alt="feature image"></a>
                  </td>
                </tr>
                
                <tr><td height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center" mc:edit="feature-title7" style="color: #2f2f2f; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                    <!-- ======= section text ====== -->
                    
                    <div class="editable_text" style="line-height: 22px">
                      <span class="text_container">
                          <multiline>
                            Bonus
                          </multiline>
                      </span>
                    </div>
                      </td> 
                </tr>
                
                <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center" mc:edit="feature-text7" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                    <!-- ======= section subtitle ====== -->
                    
                    <div class="editable_text" style="line-height: 26px;">
                      <span class="text_container">
                      <multiline>
                            Lorem ipsum dolor sit amet love port amet consectetur adipi
                      </multiline>
                      </span>
                    </div>
                      </td>
                </tr>
                                      
              </tbody></table>
            </td>
          </tr>
          
        </tbody></table>
        
      </td>
    </tr>
    
    <tr><td height="50" style="font-size: 50px; line-height: 50px;">&nbsp;</td></tr>
    
  </tbody></table>
  </li>
  <!-- ======= end section ======= -->


  
  <!-- ======= 2 columns image and text ======= -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="f3f3f3" class="bg2_color">
    <tbody><tr>
      <td align="center">
        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
          
          <tbody><tr><td height="60" style="font-size: 60px; line-height: 60px;">&nbsp;</td></tr>
          
          <tr>
            <td>
              <table border="0" width="284" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" bgcolor="ffffff" class="container590 bg_color">
                
                <tbody><tr>
                  <!-- ======= image 265px width ======= -->
                  
                  <td align="center" class="section-img">
                    <a href="" style=" border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="img3" src="http://pickedmail.com/mira/img/img3.png" style="display: block; width: 284px;" width="284" border="0" alt="section image"></a>
                  </td>
                </tr>
                
                <tr><td height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center" mc:edit="title3" style="color: #2f2f2f; font-size: 18px; font-family: Arial, Calibri sans-serif; font-weight: 600; line-height: 25px;" class="title_color">
                    <!-- ======= section text ====== -->
                    
                    <div class="editable_text" style="line-height: 25px">
                      <span class="text_container">
                          <multiline>
                            Drag and drop everything
                          </multiline>
                      </span>
                    </div>
                      </td> 
                </tr>
                
                <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center">
                    <table align="center" width="240" border="0" cellpadding="0" cellspacing="0" class="container580">
                      <tbody><tr>
                      
                        <td align="center" mc:edit="text3" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                          <!-- ======= section subtitle ====== -->
                          
                          <div class="editable_text" style="line-height: 26px;">
                            <span class="text_container">
                                <multiline>
                                  Lorem ipsum dolor sit amet love port amet consectetur adipiscing elitare quis sodales min in risus
                                </multiline>
                            </span>
                          </div>
                            </td>
                      </tr>
                      
                    </tbody></table>
                  </td>
                </tr>
                
                <tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
                
              </tbody></table>
              
              <table border="0" width="2" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr><td width="2" height="30" style="font-size: 30px; line-height: 30px;"></td></tr>
              </tbody></table>
              
              <table border="0" width="284" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" bgcolor="ffffff" class="container590 bg_color">
                
                <tbody><tr>
                  <!-- ======= image 265px width ======= -->
                  
                  <td align="center" class="section-img">
                    <a href="" style=" border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="img4" src="http://pickedmail.com/mira/img/img4.png" style="display: block; width: 284px;" width="284" border="0" alt="section image"></a>
                  </td>
                </tr>
                
                <tr><td height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center" mc:edit="title4" style="color: #2f2f2f; font-size: 18px; font-family: Arial, Calibri sans-serif; font-weight: 600; line-height: 25px;" class="title_color">
                    <!-- ======= section text ====== -->
                    
                    <div class="editable_text" style="line-height: 25px">
                      <span class="text_container">
                          <multiline>
                            Bonus included
                          </multiline>
                      </span>
                    </div>
                      </td> 
                </tr>
                
                <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center">
                    <table align="center" width="240" border="0" cellpadding="0" cellspacing="0" class="container580">
                      <tbody><tr>
                      
                        <td align="center" mc:edit="text4" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                          <!-- ======= section subtitle ====== -->
                          
                          <div class="editable_text" style="line-height: 26px;">
                            <span class="text_container">
                                <multiline>
                                  Lorem ipsum dolor sit amet love port amet consectetur adipiscing elitare quis sodales min in risus
                                </multiline>
                            </span>
                          </div>
                            </td>
                      </tr>
                      
                    </tbody></table>
                  </td>
                </tr>
                
                <tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
                
              </tbody></table>
              
            </td>
          </tr>
        
        </tbody></table>
        
      </td>
    </tr>
    
    <tr><td height="60" style="font-size: 60px; line-height: 60px;">&nbsp;</td></tr>
    
  </tbody></table>
  </li>
  <!-- ======= end section ======= -->
  
  

  <!-- ======= 1/2 skills 1/2 text and image ======= -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
    
    <tbody><tr><td height="55" style="font-size: 55px; line-height: 55px;">&nbsp;</td></tr>
    
    <tr>
      <td align="center">
        <table border="0" align="center" width="600" cellpadding="0" cellspacing="0" class="container590">
          
          <tbody><tr>
            <td align="center" mc:edit="skills-header" style="color: #2f2f2f; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 700; mso-line-height-rule: exactly; line-height: 24px;" class="title_color">
              
              <!-- ======= main header ======= -->
              
              <div class="editable_text" style="line-height: 24px;">
                <span class="text_container">
                    <multiline>
                      OUR SKILLS
                    </multiline>
                </span>
              </div>
              
                </td> 
          </tr>
          
          <tr><td height="12" style="font-size: 12px; line-height: 12px;">&nbsp;</td></tr>
          
          <tr>
            <td align="center">
              <table align="center" width="73" border="0" cellpadding="0" cellspacing="0" bgcolor="dddddd">
                <tbody><tr><td height="1" style="font-size: 1px; line-height: 1px;"></td></tr>
              </tbody></table>
            </td>
          </tr>
          
          <tr><td height="55" style="font-size: 55px; line-height: 55px;">&nbsp;</td></tr>
          
          <tr>
            <td>  
              <table border="0" width="290" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                
                <tbody><tr>
                  <td align="left" mc:edit="skills-subtitle" style="color: #343434; font-size: 16px; font-family: Arial, Calibri, sans-serif; line-height: 23px;" class="title_color">
                    <!-- ======= section subtitle ====== -->
                    
                    <div class="editable_text" style="line-height: 23px;">
                      <span class="text_container">
                          <multiline>
                            Check our skills now :
                          </multiline>
                      </span>
                    </div>
                      </td>
                </tr>
                
                <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="left" mc:edit="skills-text" style="color: #777b80; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                    <!-- ======= section subtitle ====== -->
                    
                    <div class="editable_text" style="line-height: 26px;">
                      <span class="text_container">
                          <multiline>
                            Lorem ipsum dolor sit amet love port amet consectetur <a href="" style="color: #1eb9d0; text-decoration: none;" class="link_color">adipiscing</a> elitare quissa lodales estra. 
                          </multiline>
                      </span>
                    </div>
                      </td>
                </tr>
                
                <tr><td height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center">
                    <table border="0" width="280" align="center" cellpadding="0" cellspacing="0" class="container580">
                      <tbody><tr>
                        <td align="left" mc:edit="skill-item1" style="color: #404040; font-size: 14px; font-family: Arial, Calibri, sans-serif; line-height: 23px;" class="title_color">
                          <!-- ======= section subtitle ====== -->
                          
                          <div class="editable_text" style="line-height: 23px;">
                            <span class="text_container">
                                <multiline>
                                  Web design
                                </multiline>
                            </span>
                          </div>
                            </td>
                            
                            <td align="right" mc:edit="skill-number1" style="color: #1eb9d0; font-size: 14px; font-family: Arial, Calibri, sans-serif; line-height: 23px;" class="link_color">
                          <!-- ======= section subtitle ====== -->
                          
                          <div class="editable_text" style="line-height: 23px;">
                            <span class="text_container">
                                <multiline>
                                  80%
                                </multiline>
                            </span>
                          </div>
                            </td>
                            
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
                
                <tr><td height="5" style="font-size: 5px; line-height: 5px;">&nbsp;</td></tr>
                
                <tr>
                  <td>
                    <table border="0" width="280" align="left" cellpadding="0" cellspacing="0" bgcolor="f7f7f8" class="section-item" style="border-radius: 10px;">
                      <tbody><tr>
                        <td height="14">
                          <table border="0" width="80%" align="left" cellpadding="0" cellspacing="0" bgcolor="1eb9d0" style="border-radius: 10px;" class="blue_bg">
                            <tbody><tr><td height="14" style="font-size: 14px; line-height: 14px;">&nbsp;</td></tr>
                          </tbody></table>  
                        </td>
                      </tr>
                    </tbody></table>
                  </td>   
                </tr>
                
                <tr><td height="15" style="font-size: 15px; line-height: 15px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center">
                    <table border="0" width="280" align="center" cellpadding="0" cellspacing="0">
                      <tbody><tr>
                        <td align="left" mc:edit="skill-item2" style="color: #404040; font-size: 14px; font-family: Arial, Calibri, sans-serif; line-height: 23px;" class="title_color">
                          <!-- ======= section subtitle ====== -->
                          
                          <div class="editable_text" style="line-height: 23px;">
                            <span class="text_container">
                                <multiline>
                                  Html and CSS 
                                </multiline>
                            </span>
                          </div>
                            </td>
                            
                            <td align="right" mc:edit="skill-number2" style="color: #1eb9d0; font-size: 14px; font-family: Arial, Calibri, sans-serif; line-height: 23px;" class="link_color">
                          <!-- ======= section subtitle ====== -->
                          
                          <div class="editable_text" style="line-height: 23px;">
                            <span class="text_container">
                                <multiline>
                                  60%
                                </multiline>
                            </span>
                          </div>
                            </td>
                            
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
                
                <tr><td height="5" style="font-size: 5px; line-height: 5px;">&nbsp;</td></tr>
                
                <tr>
                  <td>
                    <table border="0" width="280" align="left" cellpadding="0" cellspacing="0" bgcolor="f7f7f8" class="section-item" style="border-radius: 10px;">
                      <tbody><tr>
                        <td height="14">
                          <table border="0" width="60%" align="left" cellpadding="0" cellspacing="0" bgcolor="1eb9d0" style="border-radius: 10px;" class="blue_bg">
                            <tbody><tr><td height="14" style="font-size: 14px; line-height: 14px;">&nbsp;</td></tr>
                          </tbody></table>  
                        </td>
                      </tr>
                    </tbody></table>
                  </td>   
                </tr>
                
                <tr><td height="15" style="font-size: 15px; line-height: 15px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center">
                    <table border="0" width="280" align="center" cellpadding="0" cellspacing="0">
                      <tbody><tr>
                        <td align="left" mc:edit="skill-item3" style="color: #404040; font-size: 14px; font-family: Arial, Calibri, sans-serif; line-height: 23px;" class="title_color">
                          <!-- ======= section subtitle ====== -->
                          
                          <div class="editable_text" style="line-height: 23px;">
                            <span class="text_container">
                                <multiline>
                                  Support
                                </multiline>
                            </span>
                          </div>
                            </td>
                            
                            <td align="right" mc:edit="skill-number3" style="color: #1eb9d0; font-size: 14px; font-family: Arial, Calibri, sans-serif; line-height: 23px;" class="link_color">
                          <!-- ======= section subtitle ====== -->
                          
                          <div class="editable_text" style="line-height: 23px;">
                            <span class="text_container">
                                <multiline>
                                  100%
                                </multiline>
                            </span>
                          </div>
                            </td>
                            
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
                
                <tr><td height="5" style="font-size: 5px; line-height: 5px;">&nbsp;</td></tr>
                
                <tr>
                  <td>
                    <table border="0" width="280" align="left" cellpadding="0" cellspacing="0" bgcolor="f7f7f8" class="section-item" style="border-radius: 10px;">
                      <tbody><tr>
                        <td height="14">
                          <table border="0" width="100%" align="left" cellpadding="0" cellspacing="0" bgcolor="1eb9d0" style="border-radius: 10px;" class="blue_bg">
                            <tbody><tr><td height="14" style="font-size: 14px; line-height: 14px;">&nbsp;</td></tr>
                          </tbody></table>  
                        </td>
                      </tr>
                    </tbody></table>
                  </td>   
                </tr>
                
              </tbody></table>
              
              
              <table border="0" width="5" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr><td width="5" height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td></tr>
              </tbody></table>
              
              
              <table border="0" width="230" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                
                <tbody><tr>
                  <!-- ======= section image ====== -->
                  <td align="center">
                    <a href="" style=" border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="skills-img" src="http://pickedmail.com/mira/img/img5.png" style="display: block; width: 224px;" width="224" border="0" alt="section image"></a>
                  </td>
                </tr>
                
                <tr><td height="35" style="font-size: 35px; line-height: 35px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="left" mc:edit="skills-main-text" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                    <!-- ======= section subtitle ====== -->
                    
                    <div class="editable_text" style="line-height: 26px;">
                      <span class="text_container">
                          <multiline>
                            Lorem ipsum dolor sit amet love port amet consectetur adipiscing elitare quis sodales 
                          </multiline>
                      </span>
                    </div>
                      </td>
                </tr>
                
              </tbody></table>
                        
            </td>
          </tr>
        </tbody></table>
      </td>
    </tr>
    
    <tr><td height="55" style="font-size: 55px; line-height: 55px;">&nbsp;</td></tr>
    
  </tbody></table>
  </li>
  <!-- ======= end section ======= -->
  

  <!-- ======= 2 columns testimonials ======= -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="8a5a8d" class="purple_bg">
    
    <tbody><tr><td height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td></tr>
          
    <tr>
      <td align="center">
        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
          
          <tbody><tr>
            <td align="center" mc:edit="testi-header" style="color: #ffffff; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 700; mso-line-height-rule: exactly; line-height: 24px;" class="white_color">
              
              <!-- ======= main header ======= -->
              
              <div class="editable_text" style="line-height: 24px;">
                <span class="text_container">
                    <multiline>
                      TESTIMONIALS
                    </multiline>
                </span>
              </div>
              
                </td> 
          </tr>
          
          <tr><td height="12" style="font-size: 12px; line-height: 12px;">&nbsp;</td></tr>
          
          <tr>
            <td align="center">
              <table align="center" width="73" border="0" cellpadding="0" cellspacing="0" bgcolor="ffffff">
                <tbody><tr><td height="1" style="font-size: 1px; line-height: 1px;"></td></tr>
              </tbody></table>
            </td>
          </tr>
          
          <tr><td height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td></tr>
          
          <tr>
            <td>
              
              <table border="0" width="260" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr>
                  
                  <!-- ======= feature image 51px width ======= -->
                  
                  <td align="center">
                    <a href="" style=" border-style: none !important; display: block; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="testi-image1" src="http://pickedmail.com/mira/img/testi-img1.png" style="display: block; width: 81px;" width="81" border="0" alt="feature image"></a>
                  </td>
                </tr>
                
                <tr><td height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center" mc:edit="testi-title1" style="color: #ffffff; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="white_color">
                    <!-- ======= section text ====== -->
                    
                    <div class="editable_text" style="line-height: 22px">
                      <span class="text_container">
                          <multiline>
                            Andrea Lona
                          </multiline>
                      </span>
                    </div>
                      </td> 
                </tr>
                
                <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center" mc:edit="testi-text1" style="color: #dad6da; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="white_color">
                    <!-- ======= section subtitle ====== -->
                    
                    <div class="editable_text" style="line-height: 26px;">
                      <span class="text_container">
                      <multiline>
                            Lorem ipsum dolor sit amet love port amet consectetur adipiscing elitare quis sodales min in risus identi raslobortis fola ullamcorper orolaero claver orbi quis  elegant
                      </multiline>
                      </span>
                    </div>
                      </td>
                </tr>
                
                <tr><td height="23" style="font-size: 23px; line-height: 23px;">&nbsp;</td></tr>
                
                <tr>
                  
                  <!-- ======= icon ======= -->
                  
                  <td align="center">
                    <img src="http://pickedmail.com/mira/img/testi-icon.png" style="display: block; width: 28px;" width="28" height="21" border="0" alt="">
                  </td>
                </tr>
                                      
              </tbody></table>
              
              <table border="0" width="2" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr><td width="2" height="30" style="font-size: 30px; line-height: 30px;"></td></tr>
              </tbody></table>
                      
                      <table border="0" width="260" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr>
                  
                  <!-- ======= feature image 51px width ======= -->
                  
                  <td align="center">
                    <a href="" style=" border-style: none !important; display: block; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="testi-image2" src="http://pickedmail.com/mira/img/testi-img2.png" style="display: block; width: 81px;" width="81" border="0" alt="feature image"></a>
                  </td>
                </tr>
                
                <tr><td height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center" mc:edit="testi-title2" style="color: #ffffff; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="white_color">
                    <!-- ======= section text ====== -->
                    
                    <div class="editable_text" style="line-height: 22px"> 
                      <span class="text_container">
                          <multiline>
                            James Doe
                          </multiline>
                      </span>
                    </div>
                      </td> 
                </tr>
                
                <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center" mc:edit="testi-text2" style="color: #dad6da; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="white_color">
                    <!-- ======= section subtitle ====== -->
                    
                    <div class="editable_text" style="line-height: 26px;">
                      <span class="text_container">
                      <multiline>
                            Lorem ipsum dolor sit amet love port amet consectetur adipiscing elitare quis sodales min in risus identi raslobortis fola ullamcorper orolaero claver orbi quis  elegant
                      </multiline>
                      </span>
                    </div>
                      </td>
                </tr>
                
                <tr><td height="23" style="font-size: 23px; line-height: 23px;">&nbsp;</td></tr>
                
                <tr>
                  
                  <!-- ======= icon ======= -->
                  
                  <td align="center">
                    <img src="http://pickedmail.com/mira/img/testi-icon.png" style="display: block; width: 28px;" width="28" height="21" border="0" alt="">
                  </td>
                </tr>
                                      
              </tbody></table>

            </td>
          </tr>
          
        </tbody></table>
        
      </td>
    </tr>
    
    <tr><td height="50" style="font-size: 50px; line-height: 50px;">&nbsp;</td></tr>
    
  </tbody></table>
  </li>
  <!-- ======= end section ======= -->

  
  <!-- ======= 1/2 image 1/2 text ======= -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
    
    <tbody><tr><td height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
    
    <tr>
      <td align="center">
        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
          <tbody><tr>
            <td align="center" mc:edit="shop-header" style="color: #2f2f2f; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 700; mso-line-height-rule: exactly; line-height: 24px;" class="title_color">
              
              <!-- ======= main header ======= -->
              
              <div class="editable_text" style="line-height: 24px;">
                <span class="text_container">
                    <multiline>
                      OUR SHOP
                    </multiline>
                </span>
              </div>
              
                </td> 
          </tr>
          
          <tr><td height="12" style="font-size: 12px; line-height: 12px;">&nbsp;</td></tr>
          
          <tr>
            <td align="center">
              <table align="center" width="73" border="0" cellpadding="0" cellspacing="0" bgcolor="dddddd">
                <tbody><tr><td height="1" style="font-size: 1px; line-height: 1px;"></td></tr>
              </tbody></table>
            </td>
          </tr>
          
          <tr><td height="55" style="font-size: 55px; line-height: 55px;">&nbsp;</td></tr>
          
          <tr>
            <td>  
              <table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                
                <!-- ======= section image 251 X any ====== -->
                
                <tbody><tr>
                  <td align="center" class="gallery-img">
                    <a href="" style=" border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="shop-img1" src="http://pickedmail.com/mira/img/img6.png" style="display: block; width: 202px;" width="202" border="0" alt="section image"></a>
                  </td>
                </tr>
              </tbody></table>
              
              
              <table border="0" width="5" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr><td width="5" height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
              </tbody></table>
              
              
              <table border="0" width="340" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                
                <tbody><tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="left" mc:edit="shop-title1" style="color: #2f2f2f; font-size: 18px; font-family: Arial, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                    <!-- ======= section text ====== -->
                    
                    <div class="editable_text" style="line-height: 22px">
                      <span class="text_container">
                          <multiline>
                            Discover it now
                          </multiline>
                      </span>
                    </div>
                      </td> 
                </tr>
                
                <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="left" mc:edit="shop-text1" style="color: #777777; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                    <!-- ======= section subtitle ====== -->
                    
                    <div class="editable_text" style="line-height: 26px;">
                      <span class="text_container">
                          <multiline>
                            Lorem ipsum dolor sit amet love port amet consectetur adipiscing elitare  ...
                          </multiline>
                      </span>
                    </div>
                      </td>
                </tr>
                
                <tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
                
                <tr>
                  <td>
                    
                    <table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                      <tbody><tr>
                        <td align="left">
                          
                          <table border="0" align="left" width="120" cellpadding="0" cellspacing="0" bgcolor="1eb9d0" style="border-radius: 4px;" class="button_color">
                            
                            <tbody><tr><td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td></tr>
                            
                            <tr>
                                    
                                      <td align="center" style="color: #ffffff; font-size: 14px; font-family:Arial, Calibri, sans-serif; font-weight: 600;" mc:edit="shop-button1"> 
                                        <!-- ======= main section button ======= -->
                                        
                                          <div class="editable_text" style="line-height: 22px;">
                                            <span class="text_container">
                                            <a href="" style="color: #ffffff; text-decoration: none;"><singleline>Add to cart</singleline></a> 
                                            </span>
                                          </div>
                                        </td>
                            </tr>
                            
                            <tr><td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td></tr>
                          
                          </tbody></table>
                        </td>
                      </tr>
                    </tbody></table>
                    
                    <table border="0" width="5" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                      <tbody><tr><td width="5" height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
                    </tbody></table>
                    
                    <table border="0" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                      <tbody><tr><td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td></tr>
                      
                      <tr>
                        <td align="left" mc:edit="shop-price1" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 700; line-height: 21px;" class="text_color">
                          <!-- ======= section text ====== -->
                          
                          <div class="editable_text" style="line-height: 21px">
                            <span class="text_container">
                                <multiline>
                                  Price : $90 - $34
                                </multiline>
                            </span>
                          </div>
                            </td> 
                      </tr>
                    </tbody></table>
                    
                  </td>
                </tr>
                    
              </tbody></table>
                        
            </td>
          </tr>
        </tbody></table>
      </td>
    </tr>
    
    <tr><td height="35" style="font-size: 35px; line-height: 35px;">&nbsp;</td></tr>
    
  </tbody></table>
  </li>
  <!-- ======= end section ======= -->
  

  <!-- ======= product section 1/2 image 1/2 text ======= -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
    
    <tbody><tr><td height="35" style="font-size: 35px; line-height: 35px;">&nbsp;</td></tr>
    
    <tr>
      <td align="center">
        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
            
          <tbody><tr>
            <td>  
              <table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="section-item">
                
                <!-- ======= section image 251 X any ====== -->
                
                <tbody><tr>
                  <td align="center" class="gallery-img">
                    <a href="" style=" border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="shop-img2" src="http://pickedmail.com/mira/img/img7.png" style="display: block; width: 202px;" width="202" border="0" alt="section image"></a>
                  </td>
                </tr>
              </tbody></table>
              
              
              <table border="0" width="5" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr><td width="5" height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
              </tbody></table>
              
              
              <table border="0" width="340" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                
                <tbody><tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="left" mc:edit="shop-title2" style="color: #2f2f2f; font-size: 18px; font-family: Arial, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                    <!-- ======= section text ====== -->
                    
                    <div class="editable_text" style="line-height: 22px">
                      <span class="text_container">
                          <multiline>
                            Magazine for you
                          </multiline>
                      </span>
                    </div>
                      </td> 
                </tr>
                
                <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="left" mc:edit="shop-text2" style="color: #777777; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                    <!-- ======= section subtitle ====== -->
                    
                    <div class="editable_text" style="line-height: 26px;">
                      <span class="text_container">
                          <multiline>
                            Lorem ipsum dolor sit amet love port amet consectetur adipiscing elitare  ...
                          </multiline>
                      </span>
                    </div>
                      </td>
                </tr>
                
                <tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
                
                <tr>
                  <td>
                    
                    <table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                      <tbody><tr>
                        <td align="left">
                          
                          <table border="0" align="left" width="120" cellpadding="0" cellspacing="0" bgcolor="1eb9d0" style="border-radius: 4px;" class="button_color">
                            
                            <tbody><tr><td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td></tr>
                            
                            <tr>
                                    
                                      <td align="center" style="color: #ffffff; font-size: 14px; font-family:Arial, Calibri, sans-serif; font-weight: 600;" mc:edit="shop-button">  
                                        <!-- ======= main section button ======= -->
                                        
                                          <div class="editable_text" style="line-height: 22px;">
                                            <span class="text_container">
                                            <a href="" style="color: #ffffff; text-decoration: none;"><singleline>Add to cart</singleline></a> 
                                            </span>
                                          </div>
                                        </td>
                            </tr>
                            
                            <tr><td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td></tr>
                          
                          </tbody></table>
                        </td>
                      </tr>
                    </tbody></table>
                    
                    <table border="0" width="5" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                      <tbody><tr><td width="5" height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
                    </tbody></table>
                    
                    <table border="0" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                      <tbody><tr><td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td></tr>
                      
                      <tr>
                        <td align="left" mc:edit="shop-price2" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 700; line-height: 21px;" class="text_color">
                          <!-- ======= section text ====== -->
                          
                          <div class="editable_text" style="line-height: 21px">
                            <span class="text_container">
                                <multiline>
                                  Price : $90 - $34
                                </multiline>
                            </span>
                          </div>
                            </td> 
                      </tr>
                    </tbody></table>
                    
                  </td>
                </tr>
                    
              </tbody></table>
                        
            </td>
          </tr>
        </tbody></table>
      </td>
    </tr>
    
    <tr><td height="60" style="font-size: 60px; line-height: 60px;">&nbsp;</td></tr>
    
  </tbody></table>
  </li>
  <!-- ======= end section ======= -->
  
  
  <!-- ======= section 1/2 text 1/2 image ====== -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="eeeeee" class="bg2_color">
    
    <tbody><tr><td height="70" style="font-size: 70px; line-height: 70px;">&nbsp;</td></tr>
      
    <tr>
      <td align="center">
        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
          
          <tbody><tr>
            <td>
              
              <table border="0" width="280" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                
                <tbody><tr><td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="left" mc:edit="title5" style="color: #2f2f2f; font-size: 17px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                    <!-- ======= section text ====== -->
                    
                    <div class="editable_text" style="line-height: 22px">
                      <span class="text_container">
                          <multiline>
                            What we are doing ?
                          </multiline>
                      </span>
                    </div>
                      </td> 
                </tr>
                
                <tr><td height="17" style="font-size: 17px; line-height: 17px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="left">
                    <table align="left" width="73" border="0" cellpadding="0" cellspacing="0" bgcolor="2f2f2f" style="background-color: rgba(47,47,47,.34);">
                      <tbody><tr><td height="1" style="font-size: 1px; line-height: 1px;"></td></tr>
                    </tbody></table>
                  </td>
                </tr>
                
                <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="left" mc:edit="text5" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                    <!-- ======= section subtitle ====== -->
                    
                    <div class="editable_text" style="line-height: 26px;">
                      <span class="text_container">
                          <multiline>
                            Lorem ipsum dolor sit amet love port amet consectetur adipiscing elitare  quis sodales min in risus identi ras obortis fola ullamcorper orola 
                          </multiline>
                      </span>
                    </div>
                      </td>
                </tr>
                                
                <tr><td height="28" style="font-size: 28px; line-height: 28px;">&nbsp;</td></tr>
                
                <tr>
                  <td>
                    <table border="0" cellpadding="0" cellspacing="0" align="left">
                      <tbody><tr>
                        <td width="22" align="left">
                          <img src="http://pickedmail.com/mira/img/list-icon.png" align="middle" style="display: block; width: 14px; height: 14px;" width="14" height="14" border="0" alt="">
                        </td>
                        <td align="left" mc:edit="list-item1" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; mso-line-height-rule: exactly; line-height: 22px;" class="text_color">
                                
                          <!-- ======= list item ======= -->
                          
                          <div class="editable_text" style="line-height: 22px;">
                            <span class="text_container">
                                <multiline>
                                  amet love port amet 
                                </multiline>
                            </span>
                          </div>
                          
                            </td>
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
                
                <tr><td height="17" style="font-size: 17px; line-height: 17px;">&nbsp;</td></tr>
                
                <tr>
                  <td>
                    <table border="0" cellpadding="0" cellspacing="0" align="left">
                      <tbody><tr>
                        <td width="20" align="left">
                          <img src="http://pickedmail.com/mira/img/list-icon.png" align="middle" style="display: block; width: 14px; height: 14px;" width="14" height="14" border="0" alt="">
                        </td>
                        <td align="left" mc:edit="list-item2" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; mso-line-height-rule: exactly; line-height: 22px;" class="text_color">
                                
                          <!-- ======= list item ======= -->
                          
                          <div class="editable_text" style="line-height: 22px;">
                            <span class="text_container">
                                <multiline>
                                  adipiscing elitare quis
                                </multiline>
                            </span>
                          </div>
                          
                            </td>
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
                
                <tr><td height="17" style="font-size: 17px; line-height: 17px;">&nbsp;</td></tr>
                
                <tr>
                  <td>
                    <table border="0" cellpadding="0" cellspacing="0" align="left">
                      <tbody><tr>
                        <td width="20" align="left">
                          <img src="http://pickedmail.com/mira/img/list-icon.png" align="middle" style="display: block; width: 14px; height: 14px;" width="14" height="14" border="0" alt="">
                        </td>
                        <td align="left" mc:edit="list-item3" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; mso-line-height-rule: exactly; line-height: 22px;" class="text_color">
                                
                          <!-- ======= list item ======= -->
                          
                          <div class="editable_text" style="line-height: 22px;">
                            <span class="text_container">
                                <multiline>
                                  dolor sit amet love
                                </multiline>
                            </span>
                          </div>
                          
                            </td>
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
                
              </tbody></table>
                            
              <table border="0" width="5" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr><td width="5" height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
              </tbody></table>
              
              <table border="0" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <!-- ======= section image 250 X 170 ====== -->
                
                <tbody><tr>
                  <td align="center" class="section-img">
                    <a href="" style=" border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="img5" src="http://pickedmail.com/mira/img/iphone.png" style="display: block; width: 294px;" width="294" border="0" alt="section image"></a>
                  </td>
                </tr>
              </tbody></table>
              
            </td>
          </tr>
                        
        </tbody></table>
      </td>
    </tr>
    
  </tbody></table>
  </li>
  <!-- ======= end section ======= -->
  
  
  <!-- ======= 2 columns image and text ======= -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
    
    <tbody><tr><td height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td></tr>
          
    <tr>
      <td align="center">
        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
          
          <tbody><tr>
            <td align="center" mc:edit="main-header2" style="color: #2f2f2f; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 700; mso-line-height-rule: exactly; line-height: 24px;" class="title_color">
              
              <!-- ======= main header ======= -->
              
              <div class="editable_text" style="line-height: 24px;">
                <span class="text_container">
                    <multiline>
                      MORE SECTIONS
                    </multiline>
                </span>
              </div>
              
                </td> 
          </tr>
          
          <tr><td height="12" style="font-size: 12px; line-height: 12px;">&nbsp;</td></tr>
          
          <tr>
            <td align="center">
              <table align="center" width="73" border="0" cellpadding="0" cellspacing="0" bgcolor="dddddd">
                <tbody><tr><td height="1" style="font-size: 1px; line-height: 1px;"></td></tr>
              </tbody></table>
            </td>
          </tr>
          
          <tr><td height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td></tr>
          
          <tr>
            <td>
              
              <table border="0" width="260" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr>
                  
                  <!-- ======= feature image 51px width ======= -->
                  
                  <td align="center">
                    <a href="" style=" border-style: none !important; display: block; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="img6" src="http://pickedmail.com/mira/img/img8.png" style="display: block; width: 179px;" width="179" border="0" alt="feature image"></a>
                  </td>
                </tr>
                
                <tr><td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center" mc:edit="title6" style="color: #2f2f2f; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                    <!-- ======= section text ====== -->
                    
                    <div class="editable_text" style="line-height: 22px">
                      <span class="text_container">
                          <multiline>
                            More sections
                          </multiline>
                      </span>
                    </div>
                      </td> 
                </tr>
                
                <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center" mc:edit="text6" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                    <!-- ======= section subtitle ====== -->
                    
                    <div class="editable_text" style="line-height: 26px;">
                      <span class="text_container">
                      <multiline>
                            Lorem ipsum dolor sit amet love port amet consectetur adipiscing elitare  quis sodales min in risus identi ras obortis fola ullamcorper orola 
                      </multiline>
                      </span>
                    </div>
                      </td>
                </tr>
                
                <tr><td height="13" style="font-size: 13px; line-height: 13px;">&nbsp;</td></tr>
                
                <tr>    
                          <td align="center" style="color: #1eb9d0; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 24px;" mc:edit="link6">
                            <div class="editable_text" style=" line-height: 24px;">
                              <span class="text_container">
                              <multiline>
                                <a href="" style="color: #1eb9d0; text-decoration: none;" class="link_color">Read more</a>
                              </multiline>
                              </span>
                            </div>  
                          </td>
                    </tr>
                                      
              </tbody></table>
              
              <table border="0" width="2" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr><td width="2" height="30" style="font-size: 30px; line-height: 30px;"></td></tr>
              </tbody></table>
                      
                      <table border="0" width="260" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr>
                  
                  <!-- ======= feature image 51px width ======= -->
                  
                  <td align="center">
                    <a href="" style=" border-style: none !important; display: block; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="img7" src="http://pickedmail.com/mira/img/img9.png" style="display: block; width: 179px;" width="179" border="0" alt="feature image"></a>
                  </td>
                </tr>
                
                <tr><td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center" mc:edit="title7" style="color: #2f2f2f; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                    <!-- ======= section text ====== -->
                    
                    <div class="editable_text" style="line-height: 22px">
                      <span class="text_container">
                          <multiline>
                            Handle everything
                          </multiline>
                      </span>
                    </div>
                      </td> 
                </tr>
                
                <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                
                <tr>
                  <td align="center" mc:edit="text7" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                    <!-- ======= section subtitle ====== -->
                    
                    <div class="editable_text" style="line-height: 26px;">
                      <span class="text_container">
                      <multiline>
                            Lorem ipsum dolor sit amet love port amet consectetur adipiscing elitare  quis sodales min in risus identi ras obortis fola ullamcorper orola 
                      </multiline>
                      </span>
                    </div>
                      </td>
                </tr>
                
                <tr><td height="13" style="font-size: 13px; line-height: 13px;">&nbsp;</td></tr>
                
                <tr>    
                          <td align="center" style="color: #1eb9d0; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 24px;" mc:edit="link7">
                            <div class="editable_text" style=" line-height: 24px;">
                              <span class="text_container">
                              <multiline>
                                <a href="" style="color: #1eb9d0; text-decoration: none;" class="link_color">Read more</a>
                              </multiline>
                              </span>
                            </div>  
                          </td>
                    </tr>
                                      
              </tbody></table>
            </td>
          </tr>
          
        </tbody></table>
        
      </td>
    </tr>
    
    <tr><td height="50" style="font-size: 50px; line-height: 50px;">&nbsp;</td></tr>
    
  </tbody></table>
  </li>
  <!-- ======= end section ======= -->



  <!-- ======= 3 columns image and text ======= -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="1eb9d0" class="blue_bg">
    
    <tbody><tr><td height="55" style="font-size: 55px; line-height: 55px;">&nbsp;</td></tr>
    
    <tr>
      <td align="center">
        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
          
          <tbody><tr>
            <td align="center" mc:edit="post-header" style="color: #ffffff; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 700; mso-line-height-rule: exactly; line-height: 24px;" class="white_color">
              
              <!-- ======= main header ======= -->
              
              <div class="editable_text" style="line-height: 24px;">
                <span class="text_container">
                    <multiline>
                      CHECK OUR POSTS
                    </multiline>
                </span>
              </div>
              
                </td> 
          </tr>
          
          <tr><td height="12" style="font-size: 12px; line-height: 12px;">&nbsp;</td></tr>
          
          <tr>
            <td align="center">
              <table align="center" width="73" border="0" cellpadding="0" cellspacing="0" bgcolor="ffffff">
                <tbody><tr><td height="1" style="font-size: 1px; line-height: 1px;"></td></tr>
              </tbody></table>
            </td>
          </tr>
          
          <tr><td height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td></tr>
                        
          <tr>
            <td>
              <table border="0" width="390" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr>
                  <td>
                    <table border="0" width="190" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" bgcolor="ffffff" class="container590 bg_color">
                      
                      <tbody><tr>                             
                        <!-- ======= feature image 51px width ======= -->
                        
                        <td align="center" class="section-img">
                          <a href="" style=" border-style: none !important; display: block; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="post-img1" src="http://pickedmail.com/mira/img/img10.png" style="display: block; width: 190px;" width="190" border="0" alt="gallery img"></a>
                        </td>
                      </tr>
                      
                      <tr><td height="24" style="font-size: 24px; line-height: 24px;">&nbsp;</td></tr>
                            
                      <tr>
                        <td align="center">
                          <table border="0" width="170" align="center" cellpadding="0" cellspacing="0" class="container580">
                            <tbody><tr>
                              <td align="center" mc:edit="post-title1" style="color: #2c3b43; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                                <!-- ======= section text ====== -->
                                
                                <div class="editable_text" style="line-height: 22px">
                                  <span class="text_container">
                                      <multiline>
                                        Beautiful
                                      </multiline>
                                  </span>
                                </div>
                                  </td> 
                            </tr>
                            
                            <tr><td height="13" style="font-size: 13px; line-height: 13px;">&nbsp;</td></tr>
                            
                            <tr>
                              <td align="center" mc:edit="post-text1" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                                <!-- ======= section text ====== -->
                                
                                <div class="editable_text" style="line-height: 26px">
                                  <span class="text_container">
                                      <multiline>
                                        Lorem ipsum dolor sito ame consectetur adercing elit hendrerit  
                                      </multiline>
                                  </span>
                                </div>
                                  </td> 
                            </tr>
                            
                            <tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
                            
                          </tbody></table>
                        </td>
                      </tr>                   
                    </tbody></table>
                    
                    <table border="0" width="2" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                      <tbody><tr><td width="2" height="30" style="font-size: 30px; line-height: 30px;"></td></tr>
                    </tbody></table>
                            
                            <table border="0" width="190" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" bgcolor="ffffff" class="container590 white_color">
                      
                      <tbody><tr>                             
                        <!-- ======= feature image 51px width ======= -->
                        
                        <td align="center" class="section-img">
                          <a href="" style=" border-style: none !important; display: block; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="post-img2" src="http://pickedmail.com/mira/img/img11.png" style="display: block; width: 190px;" width="190" border="0" alt="gallery img"></a>
                        </td>
                      </tr>
                      
                      <tr><td height="24" style="font-size: 24px; line-height: 24px;">&nbsp;</td></tr>
                            
                      <tr>
                        <td align="center">
                          <table border="0" width="170" align="center" cellpadding="0" cellspacing="0" class="container580">
                            <tbody><tr>
                              <td align="center" mc:edit="post-title2" style="color: #2c3b43; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                                <!-- ======= section text ====== -->
                                
                                <div class="editable_text" style="line-height: 22px"> 
                                  <span class="text_container">
                                      <multiline>
                                        Beautiful
                                      </multiline>
                                  </span>
                                </div>
                                  </td> 
                            </tr>
                            
                            <tr><td height="13" style="font-size: 13px; line-height: 13px;">&nbsp;</td></tr>
                            
                            <tr>
                              <td align="center" mc:edit="post-text2" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                                <!-- ======= section text ====== -->
                                
                                <div class="editable_text" style="line-height: 26px">
                                  <span class="text_container">
                                      <multiline>
                                        Lorem ipsum dolor sito ame consectetur adercing elit hendrerit  
                                      </multiline>
                                  </span>
                                </div>
                                  </td> 
                            </tr>
                            
                            <tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
                            
                          </tbody></table>
                        </td>
                      </tr>                   
                    </tbody></table>
                  </td>
                </tr>
              </tbody></table>
              
              <table border="0" width="2" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr><td width="2" height="30" style="font-size: 30px; line-height: 30px;"></td></tr>
              </tbody></table>
                      
                      <table border="0" width="190" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" bgcolor="ffffff" class="container590 white_color">
                      
                <tbody><tr>                             
                  <!-- ======= feature image 51px width ======= -->
                  
                  <td align="center" class="section-img">
                    <a href="" style=" border-style: none !important; display: block; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="post-img3" src="http://pickedmail.com/mira/img/img12.png" style="display: block; width: 190px;" width="190" border="0" alt="gallery img"></a>
                  </td>
                </tr>
                
                <tr><td height="24" style="font-size: 24px; line-height: 24px;">&nbsp;</td></tr>
                      
                <tr>
                  <td align="center">
                    <table border="0" width="170" align="center" cellpadding="0" cellspacing="0" class="container580">
                      <tbody><tr>
                        <td align="center" mc:edit="post-title3" style="color: #2c3b43; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                          <!-- ======= section text ====== -->
                          
                          <div class="editable_text" style="line-height: 22px">
                            <span class="text_container">
                                <multiline>
                                  Beautiful
                                </multiline>
                            </span>
                          </div>
                            </td> 
                      </tr>
                      
                      <tr><td height="13" style="font-size: 13px; line-height: 13px;">&nbsp;</td></tr>
                      
                      <tr>
                        <td align="center" mc:edit="post-text3" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 26px;" class="text_color">
                          <!-- ======= section text ====== -->
                          
                          <div class="editable_text" style="line-height: 26px">
                            <span class="text_container">
                                <multiline>
                                  Lorem ipsum dolor sito ame consectetur adercing elit hendrerit  
                                </multiline>
                            </span>
                          </div>
                            </td> 
                      </tr>
                      
                      <tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
                      
                    </tbody></table>
                  </td>
                </tr>                   
              </tbody></table>              
            </td>
          </tr>
          
        </tbody></table>
        
      </td>
    </tr>
    
    <tr><td height="55" style="font-size: 55px; line-height: 55px;">&nbsp;</td></tr>
    
  </tbody></table>
  </li>
  <!-- ======= end section ======= -->
  
  
  
  <!-- ======= large image with headline and text ======= -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
    
    <tbody><tr><td height="55" style="font-size: 55px; line-height: 55px;">&nbsp;</td></tr>
    
    <tr>
      <td align="center">
        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
          
          <tbody><tr>
            <td>
              <table border="0" align="left" cellpadding="0" cellspacing="0">
                <tbody><tr>       
                  <!-- ======= icon ====== -->
            
                  <td align="left" valign="top" width="50">
                    <span class="editable_img"><img editable="true" mc:edit="icon1" src="http://pickedmail.com/mira/img/icon.png" style="display: block; width: 37px;" width="37" border="0" alt=""></span>
                  </td>
                  
                  <td align="left" mc:edit="title8" style="color: #2f2f2f; font-size: 17px; font-family: Arial, Calibri, sans-serif; font-weight: 600; line-height: 22px;" class="title_color">
                  
                    <!-- ======= section text ====== -->
                    
                    <div class="editable_text" style="line-height: 22px">
                      <span class="text_container">
                          <multiline>
                            The amazing email template
                          </multiline>
                      </span>
                    </div>
                      </td> 
                </tr>
              </tbody></table>
            </td>
          </tr>
          
          <tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
            
          <tr>
            <td align="left" mc:edit="text8" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; mso-line-height-rule: exactly; line-height: 26px;" class="text_color">
              
              <!-- ======= main header ======= -->
              
              <div class="editable_text" style="line-height: 26px;">
                <span class="text_container">
                    <multiline>
                      Lorem ipsum dolor sit amet love port amet consectetur adipiscing elitare  quis sodales min in risus identi ras lobortis fola ullamcorper orola ero claver orbi quis  elegant
                    </multiline>
                </span>
              </div>
              
                </td> 
          </tr>
          
          <tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
          
          <tr>
            <td align="left" mc:edit="text9" style="color: #8a8a8a; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; mso-line-height-rule: exactly; line-height: 26px;" class="text_color">
              
              <!-- ======= main header ======= -->
              
              <div class="editable_text" style="line-height: 26px;">
                <span class="text_container">
                    <multiline>
                      Lorem ipsum dolor sit amet love <a href="" style="text-decoration: none; color: #1eb9d0;" class="link_color">port amet consectetur</a> adipiscing elitare  quis sodales min in risus identi ras lobortis fola ullamcorper orola ero claver orbi quis  elegant
                    </multiline>
                </span>
              </div>
              
                </td> 
          </tr>
          
          <tr><td height="65" style="font-size: 65px; line-height: 65px;">&nbsp;</td></tr>
          
          <tr>
            <td align="center" class="section-img">
              <a href="" style=" border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="main-image2" src="http://pickedmail.com/mira/img/ipad.png" style="display: block; width: 501px;" width="501" border="0" alt="section image"></a>
            </td>
          </tr>
          
        </tbody></table>
      </td>
    </tr>
  </tbody></table>
  </li>
  <!-- ======= end section ======= -->
  
  
  <!-- ======= partners section ====== -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
    
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="8a5a8d" class="purple_bg">
    
    <tbody><tr><td height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td></tr>
          
    <tr>
      <td align="center">
      
        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
          
          <tbody><tr>
            <td align="center" mc:edit="partner-header" style="color: #ffffff; font-size: 18px; font-family: Arial, Calibri, sans-serif; font-weight: 700; mso-line-height-rule: exactly; line-height: 24px;" class="main-header white_color">
              
              <!-- ======= main header ======= -->
              
              <div class="editable_text" style="line-height: 24px;">
                <span class="text_container">
                    <multiline>
                      OUR PARTNERS
                    </multiline>
                </span>
              </div>
              
                </td> 
          </tr>
          
          <tr><td height="12" style="font-size: 12px; line-height: 12px;">&nbsp;</td></tr>
          
          <tr>
            <td align="center">
              <table align="center" width="73" border="0" cellpadding="0" cellspacing="0" bgcolor="ffffff">
                <tbody><tr><td height="1" style="font-size: 1px; line-height: 1px;"></td></tr>
              </tbody></table>
            </td>
          </tr>
          
          <tr><td height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
          
          <tr>
            <td align="center" mc:edit="partner-text" style="color: #ffffff; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 600; mso-line-height-rule: exactly; line-height: 23px;" class="white_color">
              
              <!-- ======= main text ======= -->
              
              <div class="editable_text" style="line-height: 23px;">
                <span class="text_container">
                    <multiline>
                      We are trusted by over 5000 company that enjoy our service ..
                    </multiline>
                </span>
              </div>
                </td>
            
          </tr>
          
          <tr><td height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td></tr>
          
          <tr>
            <td>
              <table border="0" align="left" cellpadding="0" width="270" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                
                
                <tbody><tr>
                  <td>
                    <table width="120" border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                        
                              <tbody><tr>
                                <td align="center">
                                    <a href="" style=" border-style: none !important; display: block; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="partner-img1" src="http://pickedmail.com/mira/img/partner-logo1.png" style="display: block; width: 97px;" width="97" border="0" alt=""></a>
                                  </td>
                              </tr>
                              
                            </tbody></table>
                            
                            <table border="0" width="5" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container50">
                      <tbody><tr><td width="5" height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
                    </tbody></table>
              
                            <table width="120" border="0" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                              <tbody><tr>
                                <td align="center">
                                    <a href="" style=" border-style: none !important; display: block; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="partner-img2" src="http://pickedmail.com/mira/img/partner-logo2.png" style="display: block; width: 111px;" width="111" border="0" alt=""></a>
                                  </td>
                              </tr>
                              
                            </tbody></table>
                            
                  </td>
                </tr> 
              </tbody></table>
              
              <table border="0" width="5" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr><td width="5" height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
              </tbody></table>
              
              <table border="0" align="right" cellpadding="0" width="270" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                <tbody><tr>
                  <td>
                    <table width="120" border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                        
                              <tbody><tr>
                                <td align="center">
                                    <a href="" style=" border-style: none !important; display: block; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="partner-img3" src="http://pickedmail.com/mira/img/partner-logo3.png" style="display: block; width: 104px;" width="104" border="0" alt="foo"></a>
                                  </td>
                              </tr>
                              
                            </tbody></table>
                            
                            <table border="0" width="5" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container50">
                      <tbody><tr><td width="5" height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
                    </tbody></table>
              
                            <table width="120" border="0" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                              <tbody><tr>
                                <td align="center">
                                    <a href="" style=" border-style: none !important; display: block; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="partner-img4" src="http://pickedmail.com/mira/img/partner-logo4.png" style="display: block; width: 95px;" width="95" border="0" alt="boo"></a>
                                  </td>
                              </tr>
                              
                            </tbody></table>
                            
                  </td>
                </tr> 
              </tbody></table>
              
            </td>
          </tr>
              
              <tr><td height="65" style="font-size: 65px; line-height: 65px;">&nbsp;</td></tr>
                      
        </tbody></table>
        
      </td>
    </tr>

  </tbody></table>
  </li>
  <!-- ======= end section ======= -->

  
  <!-- ======= social icons ====== -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="383b4d" class="dark_color">
    
    <tbody><tr><td height="55" style="font-size: 55px; line-height: 55px;">&nbsp;</td></tr>
    
    <tr>
      <td align="center">
        
        <table border="0" align="center" cellpadding="0" cellspacing="0" class="container590">
          
          <tbody><tr>
            <td align="center">
              <table border="0" cellpadding="0" cellspacing="0" align="center">
                <tbody><tr>
                  <!-- ======= logo ======= -->
                  
                  <td align="center">
                    <a href="" style="display: block; border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="logo2" width="76" border="0" style="display: block; width: 76px;" src="http://pickedmail.com/mira/img/logo.png" alt="logo"></a>
                  </td>     
                </tr>
              </tbody></table>    
            </td>
          </tr>
          
          <tr><td height="48" style="font-size: 48px; line-height: 48px;">&nbsp;</td></tr>
          
          <tr>
                <td align="center">
                  <table border="0" align="center" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                  <td>
                        <a href="" style="border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="instagram" width="21" border="0" style="display: block; width: 21px;" src="http://pickedmail.com/mira/img/instagram.png" alt="instagram"></a>    
                      </td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td>
                        <a href="" style="border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="facebook" width="11" border="0" style="display: block; width: 11px;" src="http://pickedmail.com/mira/img/facebook.png" alt="facebook"></a>   
                      </td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td>
                        <a href="" style="border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="google" width="22" border="0" style="display: block; width: 22px;" src="http://pickedmail.com/mira/img/google.png" alt="google"></a>   
                      </td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td>
                        <a href="" style="border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="twitter" width="22" border="0" style="display: block; width: 22px;" src="http://pickedmail.com/mira/img/twitter.png" alt="twitter"></a>    
                      </td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td>
                        <a href="" style="border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="linkeden" width="21" border="0" style="display: block; width: 21px;" src="http://pickedmail.com/mira/img/linkeden.png" alt="linkeden"></a>   
                      </td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td>
                        <a href="" style="border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="dribbble" width="21" border="0" style="display: block; width: 21px;" src="http://pickedmail.com/mira/img/dribbble.png" alt="dribbble"></a>   
                      </td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td>
                        <a href="" style="border-style: none !important; border: 0 !important;" class="editable_img"><img editable="true" mc:edit="pinterest" width="21" border="0" style="display: block; width: 21px;" src="http://pickedmail.com/mira/img/pinterest.png" alt="pinterest"></a>    
                      </td>
                </tr>   
                  </tbody></table>        
                </td>
              </tr>
        </tbody></table>
      </td>
    </tr>
    
    <tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
    
  </tbody></table>
  </li>
  <!-- ======= end section ====== -->
  
  
  <!-- ======= footer ====== -->
  <li>
    <div class="action-btn" style="display: none;">
      <a href="" class="add-section" title="duplicate section"><img src="http://pickedmail.com/mira/demo/img/add-section.png" alt="add section"></a>
      <a href="" class="remove-section" title="remove section"><img src="http://pickedmail.com/mira/demo/img/remove-section.png" alt="remove section"></a>
    </div>
  
  <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="383b4d">
              
    <tbody><tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
          
    <tr>
      <td align="center">
        
        <table border="0" align="center" width="340" cellpadding="0" cellspacing="0" class="container590">
          
          <tbody><tr>
            <td>
                                    
                      <table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                        <tbody><tr>
                          <td align="center" class="footer-nav" mc:edit="footer-copy" style="color: #676d81; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 300; line-height: 22px;">
                            <div class="editable_text" style=" line-height: 22px;">
                              <span class="text_container">
                                <multiline>
                                  ©2014 Mira - All rights reserved
                                </multiline>
                              </span>
                            </div>  
                          </td>
                        </tr>
                        
                      </tbody></table>
                      
                      <table border="0" align="left" width="5" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                        <tbody><tr><td height="20" width="5" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                      </tbody></table>
                      
                      <table border="0" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">         
                        <tbody><tr>
                          <td align="center" class="footer-nav" mc:edit="unsubscribe-link" style="color: #676d81; font-size: 14px; font-family: Arial, Calibri, sans-serif; font-weight: 300; line-height: 22px;">
                            <div class="editable_text" style=" line-height: 22px;">
                              <span class="text_container">
                                <a href="" style="color: #676d81; text-decoration: none;">Unsubscribe</a>
                              </span>
                            </div>
                          </td>
                        </tr>
                                                          
                        </tbody></table>
            </td>
          </tr>
          
        </tbody></table>
      </td>
    </tr>
              
    <tr><td height="60" style="font-size: 60px; line-height: 60px;">&nbsp;</td></tr>      
          
  </tbody></table>
  </li>
  </ul>
  <!-- ======= end footer ====== -->
  
  
  



</body></html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$headers .= 'From: <office@primus-romulus.net>' . "\r\n";

// Mail it
for($i=0; $i < count($email);$i++){
	mail($email[$i], $subject, $message, $headers);
}

?>