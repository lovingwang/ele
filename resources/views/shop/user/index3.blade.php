@extends('shop.layouts.default')
@section("title","联系我们")
@section("content")

	<div class="wrap">
	<div class="total">

		<div class="main">
   		  <div class="contact">
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h3>记得联系我们哟！</h3>
					    <form method="post" action="contact-post.html">
					    	<div>
						    	<span><label>姓名</label></span>
						    	<span><input name="userName" type="text" class="textbox"></span>
						    </div>
						    <div>
						    	<span><label>邮箱</label></span>
						    	<span><input name="userEmail" type="text" class="textbox"></span>
						    </div>
						    <div>
						     	<span><label>联系方式</label></span>
						    	<span><input name="userPhone" type="text" class="textbox"></span>
						    </div>
						    <div>
						    	<span><label>主题</label></span>
						    	<span><textarea name="userMsg"> </textarea></span>
						    </div>
						   <div>
						   		<button class="btn1 btn-8 btn-8a">提交</button>
						  </div>
					    </form>
				  </div>
  				</div>
				<div class="col span_1_of_3">
					<div class="contact_info">
    	 				<h3>Find Us Here</h3>
					    	  <div class="map">
							   	    <iframe width="100%" height="175" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="/bootstrap/1.png"?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265&amp;output=embed"></iframe><br><small></small>
							  </div>
      				</div>
      			<div class="company_address">
				     	<h3>联系方式：</h3>
						<p>tel:(00) 222 666 444</p>
				   		<p>Fax: (000) 000 00 00 0</p>
				 	 	<p>Email: <span>info@mycompany.com</span></p>
				   		<p>address: <span>the College  of Chongqing Internet </span>
				   </div>
				 </div>
				 <div class="clear"></div> 
			  </div>

		</div>
	</div>
</div>
@stop

    	
            