
<html>
	<head>
		<meta charset="utf-8">
		<title>Hostel Application</title>
		<link href="css/app.css" rel="stylesheet">
		<link href="css/layout.css" rel="stylesheet">
		<link rel="stylesheet" href="css/pdf.css">
		<style>
			html{
				font-size: 20px;
			}
		</style>
	</head>
	<body>
		<header>
			<hr><h2 class="text-center">Hostel Application Acknowledgement</h2><hr>
			
			<div>
				<p> Applicant :  <b>{{ $application->regno}} , {{ $application->name}}</b></p>
				<p>{{ $application->studentyear->name}} {{ $application->studentbranch->name}}</p>
				<p>Accomodation applied for - <b>{{ $application->accomodation->name}}</b> </p>
			</div>

			<p class="text-center"><b>Merit Details</b></p>
			<table class="text-center">
				<tr>
					<th><span>Your Academics Record : </span></th>
					<td><span>{{($meritdata->academics)/100}}</span></td>
				</tr>
				<tr>
					<th><span>Your Attendance Record : </span></th>
					<td><span>{{($meritdata->attendance)/100}}</span></td>
				</tr>
				<tr>
					<th><span>Final Merit for Hostel Accomodation : </span></th>
					<td><span>{{($meritdata->merit)/100}}</span></td>
				</tr>
			</table>

			<br><br>
			<p class="text-center"><b>Your Hostel Choice</b></p>
			<table class="meta">
				<tr>
					<th><span>Hostels</span></th>
					<td><span>{{$application->hostelpref1->hostelname}}, 
								@if($application->hostel_pref2)
									 {{$application->hostelpref2->hostelname}} ,
								@elseif($application->hostel_pref3)
									 {{$application->hostelpref3->hostelname}} ,
								@elseif($application->hostel_pref4)
									 {{$application->hostelpref4->hostelname}}
								@endif</span></td>
				</tr>
				<tr>
					<th><span>Floor</span></th>
					<td><span>{{$application->floorpref1->name}}, {{$application->floorpref2->name}} , {{$application->floorpref3->name}} , {{$application->floorpref4->name}}</span></td>
				</tr>
				<tr>
					<th><span>Room Type</span></th>
					<td><span>{{$application->roompref1->name}}, {{$application->roompref2->name}} , {{$application->roompref3->name}} , {{$application->roompref4->name}}</span></td>
				</tr>
				<tr>
					<th><span>Room-mates</span></th>
					<td><span>{{$application->mate1}},{{$application->mate2}},{{$application->mate3}}</span></td>
				</tr>
			</table>

			<br>
			<hr><p class="text-center">Applied online at :- {{$application->created_at}} </p><hr>
			
			<br>
			<div>
				<div class="text-center">Accomodation will be generated by Admin soon. Hope you had nice experiance.</div>
				<div class="text-center"><b>Thank You</b></div>
			</div>
	</body>
</html>