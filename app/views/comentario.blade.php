@extends ('layout')

@section ('title')
Contacto 
@stop 
 @section ('titulo')
Contáctenos
@stop
@section ('content')
<!-- start main -->
<div class="main_bg">
<div class="wrap">
<div class="main">
		

<div id="disqus_thread"></div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES * * */
    var disqus_shortname = 'chipviscom';
    
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>

				
</div>
</div>
</div>





@stop
@section('js')
	{{ HTML::style('assets/css/styles/pay.css', array('media' => 'screen')) }}
	<script src='https://www.google.com/recaptcha/api.js'></script>

@stop