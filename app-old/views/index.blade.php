@extends ('layout')

{{--@section ('title') Saludos a {{ $name }} @stop --}}

@section ('content')
<!-- start slider -->
<div class="slider"> 
      <!---start-image-slider---->
      <div class="image-slider">
    <div class="wrapper">
          <div id="ei-slider" class="ei-slider">
        <ul class="ei-slider-large">
              <li> <img src="{{ asset('assets/images/slider-image1.jpg') }}" alt="image06"/>
            <div class="ei-title">
                  <h3 class="btn">$145.99</h3>
                  <h2>Zapatillas <br>
                Colección 2015</h2>
                  <h3 class="active"> </h3>
                  <h3> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_1.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_2.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_3.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_4.png') }}" alt=""></a> </h3>
                </div>
          </li>
              <li> <img src="{{ asset('assets/images/slider-image3.jpg') }}" alt="image01" />
            <div class="ei-title">
                  <h3 class="btn">$145.99</h3>
                  <h2>Sandalias <br>
                Colección 2015</h2>
                  <h3 class="active"><!--It is a long established fact that a reader<br>
                Lorem Ipsum is that it has a more-or-less --> </h3>
                  <h3> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_1.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_2.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_3.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_4.png') }}" alt=""></a> </h3>
                </div>
          </li>
              <li> <img src="{{ asset('assets/images/slider-image2.jpg') }}" alt="image02" />
            <div class="ei-title">
                  <h3 class="btn">$145.99</h3>
                  <h2>Semicerrados <br>
                Colección 2015</h2>
                  <h3 class="active"><!--It is a long established fact that a reader<br>
                                	Lorem Ipsum is that it has a more-or-less --> 
              </h3>
                  <h3> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_1.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_2.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_3.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_4.png') }}" alt=""></a> </h3>
                </div>
          </li>
              <li> <img src="{{ asset('assets/images/slider-image4.jpg') }}" alt="image03"/>
            <div class="ei-title">
                  <h3 class="btn">$145.99</h3>
                  <h2>Cerrados <br>
                Colección 2015</h2>
                  <h3 class="active"><!--It is a long established fact that a reader<br>
                                	Lorem Ipsum is that it has a more-or-less --> 
              </h3>
                  <h3> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_1.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/imagesicon_2.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/') }}icon_3.png" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/') }}icon_4.png" alt=""></a> </h3>
                </div>
          </li>
              <li> <img src="{{ asset('assets/images/slider-image5.jpg') }}" alt="image04"/>
            <div class="ei-title">
                  <h3 class="btn">$145.99</h3>
                  <h2>Botas <br>
                Colección 2015</h2>
                  <h3 class="active"><!--It is a long established fact that a reader<br>
                                	Lorem Ipsum is that it has a more-or-less --> 
              </h3>
                  <h3> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_1.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_2.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_3.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_4.png') }}" alt=""></a> </h3>
                </div>
          </li>
              <li> <img src="{{ asset('assets/images/slider-image6.jpg') }}" alt="image05"/>
            <div class="ei-title">
                  <h3 class="btn">$145.99</h3>
                  <h2>Tenis <br>
                Colección 2015</h2>
                  <h3 class="active"><!--It is a long established fact that a reader<br>
                                	Lorem Ipsum is that it has a more-or-less --> 
              </h3>
                  <h3> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_1.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_2.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_3.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_4.png') }}" alt=""></a> </h3>
                </div>
          </li>
              <li> <img src="{{ asset('assets/images/slider-image7.jpg') }}" alt="image07"/>
            <div class="ei-title">
                  <h3 class="btn">$145.99</h3>
                  <h2>Pantuflas <br>
                Colección 2015</h2>
                  <h3 class="active"><!--It is a long established fact that a reader<br>
                                	Lorem Ipsum is that it has a more-or-less --> 
              </h3>
                  <h3> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_1.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_2.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_3.png') }}" alt=""></a> <a class="ei_icons" href="details.html"><img src="{{ asset('assets/images/icon_4.png') }}" alt=""></a> </h3>
                </div>
          </li>
            </ul>
        <!-- ei-slider-large
        Sandalia
        Semicerrado
        Cerrado
        Bota
        Tenis
        Pantuflas

         -->
        <ul class="ei-slider-thumbs">
              <li class="ei-slider-element">Current</li>
              <li> <a href="#"> <span class="active">Zapatilla</span>
                <p><!--now of $145.99--></p>
                </a> <img src="{{ asset('assets/images/thumbs/1.jpg') }}" alt="thumb01" /> </li>
              <li class="hide"><a href="#"><span>Sandalia</span>
                <p><!--limited edition--></p>
                </a><img src="{{ asset('assets/images/thumbs/3.jpg') }}" alt="thumb01" /></li>
              <li  class="hide1"><a href="#"><span> Semicerrado</span>
                <p><!--summer is coming--></p>
                </a><img src="{{ asset('assets/images/thumbs/2.jpg') }}" alt="thumb02" /></li>
              <li class="hide1"><a href="#"><span>Cerrado</span>
                <p><!--all colors available--></p>
                </a><img src="{{ asset('assets/images/thumbs/4.jpg') }}" alt="thumb03" /></li>
              <li><a href="#"><span> Bota</span>
                <p><!--free delivery--></p>
                </a><img src="{{ asset('assets/images/thumbs/5.jpg') }}" alt="thumb04" /></li>
              <li><a href="#"><span>Tenis</span>
                <p><!--limited edition--></p>
                </a><img src="{{ asset('assets/images/thumbs/6.jpg') }}" alt="thumb05" /></li>
              <li><a href="#"><span>Pantuflas</span>
                <p><!--limited edition--></p>
                </a><img src="{{ asset('assets/images/thumbs/7.jpg') }}" alt="thumb07" /></li>
            </ul>
        <!-- ei-slider-thumbs --> 
      </div>
          <!-- ei-slider --> 
        </div>
    <!-- wrapper --> 
  </div>
      <!---End-image-slider----> 
    </div>
<!-- start image1_of_3 -->
<div class="top_bg">
      <div class="wrap">
    <div class="main1">
          <div class="image1_of_3"> <img src="{{ asset('assets/images/img1.jpg') }}" alt=""/> <a href="details.html"><span class="tag">En venta</span></a> </div>
          <div class="image1_of_3"> <img src="{{ asset('assets/images/img2.jpg') }}" alt=""/> <a href="details.html"><span class="tag">Ofertas especiales</span></a> </div>
          <div class="image1_of_3"> <img src="{{ asset('assets/images/img3.jpg') }}" alt=""/> <a href="details.html"><span class="tag">Debe tener</span></a> </div>
          <div class="clear"></div>
        </div>
  </div>
    </div>
<!-- start main -->
<div class="main_bg">
      <div class="wrap">
    <div class="main">
          <div class="top_main">
        <h2>Mas recientes</h2>
        <a href="#">Mostrar todo</a>
        <div class="clear"></div>
      </div>
          <!-- start grids_of_3 -->
          <div class="grids_of_3">
        <div class="grid1_of_3"> <a href="details.html"> <img src="{{ asset('assets/images/pic1.jpg') }}" alt=""/>
          <h3>even & odd</h3>
          <span class="price">$145,99</span> </a> </div>
        <div class="grid1_of_3"> <a href="details.html"> <img src="{{ asset('assets/images/pic2.jpg') }}" alt=""/>
          <h3>buffalo decollete</h3>
          <span class="price">$185,99</span> <span class="price1 bg">En venta</span> </a> </div>
        <div class="grid1_of_3"> <a href="details.html"> <img src="{{ asset('assets/images/pic3.jpg') }}" alt=""/>
          <h3>even & odd</h3>
          <span class="price">$145,99</span> </a> </div>
        <div class="clear"></div>
      </div>
          <div class="top_main">
        <h2>Más vendidos del mes</h2>
        <a href="#">Mostrar todo</a>
        <div class="clear"></div>
      </div>
          <!-- start grids_of_3 -->
          <div class="grids_of_3">
        <div class="grid1_of_3"> <a href="details.html"> <img src="{{ asset('assets/images/pic4.jpg') }}" alt=""/>
          <h3>buffalo decollete</h3>
          <span class="price">$145,99</span> </a> </div>
        <div class="grid1_of_3"> <a href="details.html"> <img src="{{ asset('assets/images/pic5.jpg') }}" alt=""/>
          <h3>even & odd</h3>
          <span class="price">$185,99</span> </a> </div>
        <div class="grid1_of_3"> <a href="details.html"> <img src="{{ asset('assets/images/pic6.jpg') }}" alt=""/>
          <h3>buffalo decollete</h3>
          <span class="price">$145,99</span> <span class="price1 bg1">out of stock</span> </a> </div>
        <div class="clear"></div>
      </div>
          <div class="clear"></div>
          <!-- start grids_of_2 -->
          <div class="grids_of_2">
        <div class="grid1_of_2">
              <div class="span1_of_2">
            <h2>Envío gratis</h2>
            <p><!--Lorem Ipsum is simply dummy  typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.--></p>
          </div>
              <div class="span1_of_2">
            <h2>Testimonios</h2>
            <p><!--It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using [...]--></p>
          </div>
            </div>
        <div class="grid1_of_2 bg">
              <h2>blog news</h2>
              <div class="grid_date">
            <div class="date1">
                  <h4>apr 01</h4>
                </div>
            <div class="date_text">
                  <h4><a href="#"> Donec vehicula est ac augue consectetur,</a></h4>
                  <p><!--There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form--></p>
                </div>
            <div class="clear"></div>
          </div>
              <div class="grid_date">
            <div class="date1">
                  <h4>feb 01</h4>
                </div>
            <div class="date_text">
                  <h4>
                  <a href="#"><!-- The standard chunk of Lorem Ipsum used since ,,</a></h4>
					<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from-->
                  </p>
                </div>
            <div class="clear"></div>
          </div>
            </div>
        <div class="clear"></div>
      </div>
        </div>
  </div>
    </div>
@stop

