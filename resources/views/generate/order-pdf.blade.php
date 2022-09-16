<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>A simple, clean, and responsive HTML invoice template</title>

		<style>
             *{ font-family: DejaVu Sans !important;}
            .text-uppercase {
                text-transform: uppercase
            }
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="{{ $setting->app_favicon }}" style="width: 100%; max-width: 50px" />
								</td>

								<td>
                                    @if ($order->payment_status == 'unpaid')
                                        <b style="color: red">
                                            Unpaid
                                        </b>
                                    @else
                                        <b style="color: green">
                                            Paid
                                        </b>
                                    @endif
								    </br>
									Order Id : #{{ $order->order_id }}<br />
									TXN Id: {{ $order->transaction_id }}<br />
									Created: {{ formatTime($order->created_at, 'F d, Y') }}<br />
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									{{ $setting->app_name }}.<br />
									{{ $setting->app_contact_number }}<br />
									{{ $setting->app_email }}<br />
									{{ $setting->app_location }}<br />
								</td>
								<td>
									{{ $company->user->name }}<br />
									{{ $company->user->email }}<br /><br/>
									{{ $company->company_name }}<br />
									{{ $company->company_email }}<br />
									{{ $company->company_phone }}<br />
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class="heading">
					<td>Payment Method</td>
					<td>Price</td>
				</tr>
				<tr class="details">
					<td class="text-uppercase">{{ $order->payment_provider }}</td>
					<td>{{ currencyPosition($subscribed_plan->plan->price) }}</td>
				</tr>


				<tr class="heading">
					<td colspan="2">Plan Details</td>
				</tr>
				<tr class="item">
					<td>Plan</td>
					<td>{{ $subscribed_plan->plan->name }}</td>
				</tr>
				<tr class="item">
					<td>Subscription Type</td>
					<td>
                        @if ($subscribed_plan->plan->interval == 'custom_days')
                            {{ $subscribed_plan->plan->custom_interval_days }} Days
                        @else
                            {{ $subscribed_plan->plan->interval }}
                        @endif
                    </td>
				</tr>
                @if ($subscribed_plan->plan && $subscribed_plan->plan->interval != 'lifetime')
                    <tr class="item">
                        <td>Expiration Remaining</td>
                        <td>
                            {{ $subscribed_plan->remaining_days }} Days
                        </td>
                    </tr>
                @endif

                <tr class="heading">
					<td colspan="2">Plan Features</td>
				</tr>
				<tr>
					<td>Unlimited Employees</td>
					<td>
                        @if ($subscribed_plan->plan->planFeatures->is_limited_employee)
                            &check;
                        @else
                            &times;
                        @endif
                    </td>
				</tr>
				<tr>
					<td>Max Employees</td>
					<td>
                        @if ($subscribed_plan->plan->planFeatures->is_limited_employee)
                            {{ $subscribed_plan->plan->planFeatures->max_employees }}
                        @else
                            ∞
                        @endif
                    </td>
				</tr>
				<tr>
                    <td>Max Teams</td>
					<td>{{ $subscribed_plan->plan->planFeatures->max_teams }}</td>
				</tr>
				<tr>
                    <td>Max Leave Types</td>
					<td>{{ $subscribed_plan->plan->planFeatures->max_leave_types }}</td>
				</tr>
                <tr>
                    <td>Custom Theme Look</td>
                    <td>
                        @if ($subscribed_plan->plan->planFeatures->custom_theme_look)
                            &check;
                        @else
                            &times;
                        @endif
                    </td>
                </tr>
			</table>
		</div>
	</body>
</html>
