@extends("frontend.layout.master")
@section("title")
Filigans Hotel | Contact US
@endsection
@section("headerTitle")
Contact
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
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15729.229054983613!2d118.741694!3d9.740019!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x41e8b071c03f3e07!2sFiligans+Hotel!5e0!3m2!1sfil!2sph!4v1471852494704" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>


		</div>

		<label style="margin-top:10px">We are located here</label>
		<h4>J.P. Rizal Ave., Puerto Princesa</h4>
		<h4>Palawan, Philippines</h4>
	</div>
</div>

@endsection