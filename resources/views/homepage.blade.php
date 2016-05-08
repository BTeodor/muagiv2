<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Mua Gì</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="{{ asset('assets/css/bootstrap.css')}}" rel="stylesheet" />
    <!-- FONT AWESOME CSS -->
    <link href="{{ asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" />
    <!-- STYLE SWITCHER  CSS -->
    <link href="{{ asset('assets/css/styleSwitcher.css')}}" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" />
    <!--GREEN STYLE VERSION IS BY DEFAULT, USE ANY ONE STYLESHEET FROM TWO STYLESHEETS (green or red) HERE-->
    <link href="{{ asset('assets/css/themes/green.css')}}" id="mainCSS" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
  </head>
  <body >
    <div class="switcher" style="left:-50px;">
      <a id="switch-panel" class="hide-panel">
        <i class="fa fa-recycle"></i>
      </a>
      <p style="font-size:10px">choose</p>
      <ul class="colors-list">
        <li><a title="Green" id="green" class="green" ></a></li>
        <li><a title="Red" id="red" class="red" ></a></li>
      </ul>
    </div>
    <!--END STYLE SWITCHER-->
    <div class="navbar navbar-inverse navbar-fixed-top move-me" id="menu">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img class="logo-custom" src="{{ asset('assets/img/logo.png')}}" alt=""  /></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li ><a href="#home">Trang chủ</a></li>
            <li><a href="#features">Tiện ích</a></li>
            
            <li><a href="#developers">Developer</a></li>
            <li><a href="#pricing">Đầu tư</a></li>
            <li><a href="#contact">Liên hệ</a></li>
            <li><a href="/auth/login"> <i class="fa fa-sign-in"></i><span>Sign In</span></a></li>
          </ul>
        </div>
        
      </div>
    </div>
    <!--NAVBAR SECTION END-->
    <section class="header-sec" id="home" >
      <div class="overlay">
        <div class="container">
          <div class="row text-center" >
            
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
              
              <h2 data-scroll-reveal="enter from the bottom after 0.1s">
              <strong>
              The Best Service For Home Shopping
              </strong>
              </h2>
              
              <p data-scroll-reveal="enter from the bottom after 0.5s">
                This is the landing page of Home Shopping Channel
              </p>
              <p data-scroll-reveal="enter from the bottom after 0.9s">
                Guests please download and use our application for the best experience
              </p>
              <br />
            </div>
            
          </div>
        </div>
      </div>
      
    </section>
    <!--HEADER SECTION END-->
    <section class="features" id="features">
      <div class="container">
        <div class="row text-center" >
          
          <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
            
            <h3 data-scroll-reveal="enter from the bottom after 0.1s">
            <strong>
            Tiện ích tuyệt vời
            </strong>
            </h3>
            
          </div>
          
        </div>
        <div class="row " >
          
          <div class="col-lg-6 col-md-6 col-sm-6" data-scroll-reveal="enter from the left after 0.4s" >
            <div class="media">
              <div class="pull-left">
                <i class=" fa fa-history fa-5x "></i>
              </div>
              <div class="media-body">
                <h4 class="media-heading"><strong> Real time home shopping channel </strong></h4>
                <p>Kênh mua sắm tại nhà cập nhật 24/24</p>
              <p>Thông tin về hàng hoá luôn được cập nhật tức thì</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6" data-scroll-reveal="enter from the right after 0.7s">
            <div class="media">
              <div class="pull-left">
                <i class=" fa fa-ra fa-5x "></i>
              </div>
              <div class="media-body">
                <h4 class="media-heading"><strong> Notifications push </strong></h4>
                <p>
                Thông báo cho khách hàng khi có chương trình shop bán hàng lên sóng
                </p>
              </div>
            </div>
          </div>
          
        </div>
        <div class="row text-center just-pad" >
          
          <div class="col-lg-4 col-md-4 col-sm-4" data-scroll-reveal="enter from the bottom after 0.2s" >
            <i class=" fa fa-database fa-5x "></i>
            <h4 ><strong> Price compare </strong></h4>
            <p>
            So sáng gía cả các mặt hàng, gíup khách hàng dễ dàng ra quyết định
            </p>
          </div>
          
          <div class="col-lg-4 col-md-4 col-sm-4" data-scroll-reveal="enter from the bottom after 0.8s" >
            <i class=" fa fa-send fa-5x "></i>
            <h4 ><strong> Fast delivery </strong></h4>
            <p>
            Giao hàng nhanh chóng
            </p>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4" data-scroll-reveal="enter from the bottom after 1.4s" >
            <i class=" fa fa-puzzle-piece fa-5x "></i>
            <h4 ><strong> Cooperations with shopping channels </strong></h4>
            <p>
            Luôn luôn sẵn sàng hợp tác nếu shop của bạn có nhu cầu
            </p>
          </div>
        </div>
      </div>
      
    </section>
    <!--FEATURES SECTION END-->
    <section class="testi-sec" >
      <div class="overlay">
        <div class="container">
          <div class="row text-center" >
            
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
              
              <h3 data-scroll-reveal="enter from the bottom after 0.1s">
              <strong>
              Khách hàng chúng tôi nói gì
              </strong>
              </h3>
              
              <h4 data-scroll-reveal="enter from the bottom after 0.8s">
              <i class="fa fa-quote-left "></i> This is the best shopping service I've ever used
              <i class="fa fa-quote-right "></i>
              <br />
              <span class="pull-right"><strong>Customer</strong></span>
              </h4>
            </div>
            
          </div>
        </div>
      </div>
      
    </section>
    <!--TESTIMONIAL SECTION END-->
    <section class="developers" id="developers" >
      <div class="container">
        <div class="row text-center" >
          
          <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
            
            <h3 data-scroll-reveal="enter from the bottom after 0.1s">
            <strong>
            Các developer của chúng tôi
            </strong>
            </h3>
          </div>
          
        </div>
        
        <div class="row " >
          
          <div class="col-lg-3 col-md-3 col-sm-3" data-scroll-reveal="enter from the bottom after 0.2s" >
            
            <img src="{{ asset('assets/img/anhnguyen.jpg')}}" class="img-circle img-responsive" alt=""  />
            <h4 ><strong> Anh Nguyen </strong></h4>
            <i>Android Developer</i>
            <p>
              
            </p>
            
          </div>
          
          <div class="col-lg-3 col-md-3 col-sm-3" data-scroll-reveal="enter from the bottom after 0.4s" >
            <img src="{{ asset('assets/img/gs.jpg')}}" class="img-circle img-responsive" alt=""  />
            <h4 ><strong>Duong Nguyen </strong></h4>
            <i>Web Developer</i>
            <p>
              
            </p>
            
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3" data-scroll-reveal="enter from the bottom after 0.2s" >
            <img src="{{ asset('assets/img/Duyle.jpg')}}" class="img-circle img-responsive" alt=""  />
            <h4 ><strong>Duy Le</strong></h4>
            <i>Web Developer</i>
            <p>
              
            </p>
            
          </div>

          <div class="col-lg-3 col-md-3 col-sm-3" data-scroll-reveal="enter from the bottom after 0.2s" >
            <img src="{{ asset('assets/img/datbui_400x400.jpg')}}" class="img-circle img-responsive" alt=""  />
            <h4 ><strong>Dat Bui</strong></h4>
            <i>Android Developer</i>
            <p>
              
            </p>
            
          </div>
        </div>
      </div>
      
    </section>
    <!--DEVELOPERS SECTION END-->
    <section class="price-sec text-center "  id="pricing">
      <div class="col-lg-6  col-md-6 col-sm-6 single-price" data-scroll-reveal="enter from the left after 0.2s">
        <span >1 <i class="fa fa-dollar"></i></span>
        <h1>START-UP INVESTMENT</h1>
      </div>
      <div class="col-lg-6  col-md-6 col-sm-6 multi-price" data-scroll-reveal="enter from the right after 0.2s">
        <span >1000 <i class="fa fa-dollar"></i></span>
        <h1>FUTURE PROFIT</h1>
      </div>
    </section>
    <!--PRICING SECTION END-->
    <section class="contact" id="contact" >
      <div class="container">
        <div class="row text-center " >
          
          <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
            
            <h3 data-scroll-reveal="enter from the bottom after 0.1s">
            <strong>
            Hợp tác với chúng tôi
            </strong>
            </h3>
            
          </div>
          
        </div>
        
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6" data-scroll-reveal="enter from the right after 0.2s">
            <strong>ADDRESS</strong>
            <p>
              School of Information and Technology (SOICT)
              <br />
              Hanoi University of Science and Technology (HUST)
              <br />
              1<sup>st</sup> Dai Co Viet road, Hai Ba Trung Dist, Hanoi, Vietnam
              <br />
              <a href="mailto:support@muagi.16mb.com?Subject=Product%20Enquiry" target="_top"> <i class="fa fa-envelope-o"></i><span class="home-mail">e-mail: support@muagi.16mb.com</span></a>
            </p>
            
            
            
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6" data-scroll-reveal="enter from the left after 0.4s">
            <strong>OUR PARTNERS</strong>
            <p>
              Thanks for your collaborations!
            </p>
            
            
          </div>
        </div>
        
      </div>
    </section>
    <!--CONTACT SECTION END-->
    <div class="myfooter" >
      &copy; 2016 <a href="http://homeshopping.esy.es" title="Home Page">homeshopping.esy.es</a> | by: <a href="http://binarytheme.com" style="color:#fff;" target="_blank"  >www.binarytheme.com</a>
    </div>
    <!--FOOTER SECTION END-->
    <!--  Jquery Core Script -->
    <script src="{{ asset('assets/js/jquery-1.10.2.js')}}"></script>
    <!--  Core Bootstrap Script -->
    <script src="{{ asset('assets/js/bootstrap.js')}}"></script>
    <!--  Scrolling Reveal Script -->
    <script src="{{ asset('assets/js/scrollReveal.js')}}"></script>
    <!--  Scroll Scripts -->
    <script src="{{ asset('assets/js/jquery.easing.min.js')}}"></script>
    <!--  Style Switcher Scripts -->
    <script src="{{ asset('assets/js/styleSwitcher.js')}}"></script>
    <!--  Custom Scripts -->
    <script src="{{ asset('assets/js/custom.js')}}"></script>
    
  </body>
</html>