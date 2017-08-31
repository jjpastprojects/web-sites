<style>
*{font-family:helvetica; font-size:12px;}
table.fancy {  font-size:11px; border-collapse: collapse;  width:99%;  margin:0 auto;  margin-bottom:10px; margin-top:10px;}
table.fancy th{  border: 1px #2e2e2e solid;  padding: 0.2em;  padding-left:10px; vertical-align:top}
table.fancy th {  border:1px solid #2e2e2e; background: whitesmoke;  background: gainsboro;  text-align: left;}
table.fancy caption {  margin-left: inherit;  margin-right: inherit;}
table.fancy tr:hover{background-color:#ddd;}

table.fancy-detail {  font-size:11px; background: whitesmoke;   border-collapse: collapse;  width:99%;  margin:0 auto;  margin-bottom:10px; margin-top:10px;}
table.fancy-detail-detail-detail th{  border: 1px #2e2e2e solid;  padding: 0.2em;  padding-left:10px; vertical-align:top}
table.fancy-detail-detail th, table.fancy-detail td  {  padding: 0.2em;  padding-left:10px; border:1px solid #2e2e2e; text-align: left;}
table.fancy-detail caption {  margin-left: inherit;  margin-right: inherit;}
table.fancy-detail tr:hover{background-color:#ddd;}

</style>
<p style='text-align:center;font-size:16px; font-weight:bold;'>{!! config('config.company_name') !!}</h2>
<p style='text-align:center;font-size:14px; font-weight:bold;'>{!! config('config.address') !!}
{!! config('config.zipcode') !!}</p>
<p style='text-align:center;'>Email: {!! config('config.email') !!} | Phone: {!! config('config.phone') !!}</p>
<table class="fancy">
	<tr>
		<th>Name</th>
		<th>{!! $user->first_name." ".$user->last_name !!}</th>
		<th>Employee Code</th>
		<th>{!! $user->Profile->employee_code !!}</th>
	</tr>
	<tr>
		<th>Client</th>
		<th>{!! $user->Location->Client->client_name !!}</th>
		<th>Location</th>
		<th>{!! $user->Location->location !!}</th>
	</tr>
	<tr>
		<th>Salary Month</td>
		<th>{!! ucfirst($payroll_slip->month)." ".$payroll_slip->year !!}</th>
		<th>Payslip No</td>
		<th>{!! str_pad($payroll_slip->id, 3, 0, STR_PAD_LEFT) !!}</th>
	</tr>
	<tr>
		<td colspan = "2">
			<table class="fancy-detail">
				<tr>
					<th>Earning Salary</th>
					<th>Amount</th>
				</tr>
				@foreach($earning_salary_types as $earning_salary_type)
				<tr>
					<td>{!! $earning_salary_type->salary_head !!}</td>
					<td>{!! array_key_exists($earning_salary_type->id, $payroll) ? round($payroll[$earning_salary_type->id],2) : 0 !!}</td>
				</tr>
				<?php $total_earning += array_key_exists($earning_salary_type->id, $payroll) ? round($payroll[$earning_salary_type->id],2) : 0; ?>
				@endforeach
			</table>
		</td>
		<td colspan = "2" valign="top">
			<table class="fancy-detail">
				<tr>
					<th>Deduction Salary</th>
					<th>Amount</th>
				</tr>
				@foreach($deduction_salary_types as $deduction_salary_type)
				<tr>
					<td>{!! $deduction_salary_type->salary_head !!}</td>
					<td>{!! array_key_exists($deduction_salary_type->id, $payroll) ? round($payroll[$deduction_salary_type->id],2) : 0 !!}</td>
				</tr>
				<?php $total_deduction += array_key_exists($deduction_salary_type->id, $payroll) ? round($payroll[$deduction_salary_type->id],2) : 0; ?>
				@endforeach
			</table>
		</td>
	</tr>
	<tr>
		<td colspan = "2">
			<table class="fancy-detail">
				<tr>
					<th>Total Earning</th>
					<th>{!! $total_earning !!}</th>
				</tr>
			</table>
		</td>
		<td colspan = "2">
			<table class="fancy-detail">
				<tr>
					<th>Total Deduction</th>
					<th>{!! $total_deduction !!}</th>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th>NET SALARY</th>
		<th colspan = "3">{!! $total_earning-$total_deduction." (".ucwords(App\Classes\Helper::inWords($total_earning-$total_deduction))." Only)" !!} {!! config('config.default_currency_symbol') !!}</th>
	</tr>
</table>
<p style='text-align:right;margin-right:20px;'>Authorised Signatory</p>