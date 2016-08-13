@extends("frontend.layout.master")
@section("title")
Filigans Hotel | Contact US
@endsection
@section("headerTitle")
Contact Us
@endsection

@section("content")
<div class="row row2">
	<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
		<h3 class="text-center"> Connect with us your concerns, send us an email or call us at the contact details below.
		</h3>
		<table class="table table-hover" style="margin-top:70px">

			<tr>
				<td>Telephone No:</td>
				<td>
				{{ $settings->telephone_no }}
				</td>
			</tr>
			<tr>
				<td>Email Address:</td>
				<td>
				{{ $settings->email }}
				</td>
			</tr>

		</table>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5" style='min-height:400px;text-align:right'>
		
		<div class="map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d15455.577569140463!2d121.01754124498288!3d14.43324923160536!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sph!4v1467173666986"  height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>

		<label style="margin-top:10px">We are located here</label>
		<h4>J.P. Rizal, Puerto Princesa</h4>
		<h4>Palawan, Philippines</h4>
	</div>
</div>

@endsection