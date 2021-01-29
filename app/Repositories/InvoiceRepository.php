<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Yajra\DataTables\Facades\DataTables;
use Hash;
use Auth;


class InvoiceRepository
{

	public function getDatatable($request)
	{
		
		$from = $request->from;
		$to = $request->to;
		$invoices = Invoice::whereBetween('date', [$from, $to])->orderBy('inv_number', 'asc')->get();

		return Datatables::of($invoices)
			->editColumn('inv_number', function ($invoice) {
				return str_pad($invoice->inv_number, 6, "0", STR_PAD_LEFT);
			})
			->addColumn('sub_total', function ($invoice) {
				return number_format($invoice->invoice_detail_sub_total(), 2);
			})
			->addColumn('discount', function ($invoice) {
				return number_format($invoice->invoice_discount_total(), 2);
			})
			->addColumn('grand_total', function ($invoice) {
				return number_format($invoice->invoice_detail_grand_total(), 2);
			})
			->addColumn('actions', function () {
				$button = '';
				return $button;
			})
			->make(true);
	}

	public function get_edit_detail($id)
	{
		$inv_detail = InvoiceDetail::find($id);
		$service = $inv_detail->service;
		return $inv_detail;
	}

	public function getInvoicePreview($id)
	{

		$no = 1;
		$total = 0;
		$total_discount = 0;
		$grand_total = 0;
		$invoice_detail = '';
		$tbody = '';

		$invoice = Invoice::find($id);

		$title = 'Invoice (INV'. date('Y', strtotime($invoice->date)) .'-'.str_pad($invoice->inv_number, 6, "0", STR_PAD_LEFT) .')';

		foreach ($invoice->invoice_details as $invoice_detail) {
			$amount = ($invoice_detail->amount * $invoice_detail->qty);
			$discount = ($amount * $invoice_detail->discount);
			$grand_amount = $amount - $discount;
			$total += $amount;
			$total_discount += $discount;
			$grand_total += $grand_amount;
			$tbody .= '<tr>
									<td class="text-center">' . $no++ . '</td>
									<td colspan="2">' . $invoice_detail->description . '</td>
									<td class="text-right"><span class="pull-left float-left">$</span> ' . number_format($amount, 2) . '</td>
									<td class="text-right"><span class="pull-left float-left">$</span> ' . number_format($discount, 2) . '</td>
									<td class="text-right"><span class="pull-left float-left">$</span> ' . number_format($grand_amount, 2) . '</td>
								</tr>';
		}
		$total_riel = number_format($total*$invoice->rate, 0);
		$total_discount_riel = number_format($total_discount*$invoice->rate, 0);
		$grand_total_riel = number_format($grand_total*$invoice->rate, 0);

		
		$gtt = explode(".", number_format($grand_total,2));
		$gtt_dollars = $gtt[0];
		$gtt_cents = $gtt[1];

		$grand_total_in_word = Auth::user()->num2khtext($gtt_dollars, false) . 'ដុល្លារ' . (($gtt_cents>0)? ' និង'. Auth::user()->num2khtext($gtt_cents, false) .'សេន' : '');
		$grand_total_riel_in_word = Auth::user()->num2khtext(round($grand_total*$invoice->rate, 0), false);

		$invoice_detail = '<section class="invoice-print">
												<table class="table-header" width="100%">
													<tr>
														<td rowspan="5" width="20%" style="padding: 10px;">
															<img src="/images/setting/Logo.png" alt="IMG">
														</td>
														<td class="text-center" style="padding: 5px 0;">
															<h3 class="color_blue KHOSMoulLight" style="color: blue;">'. Auth::user()->setting()->clinic_name_kh .'</h3>
														</td>
													</tr>
													<tr>
														<td class="text-center" style="padding: 2px 0;">
															<h3 class="color_red roboto_b" style="color: red;">'. Auth::user()->setting()->clinic_name_en .'</h3>
														</td>
													</tr>
													<tr>
														<td class="text-center" style="padding: 1px 0;">
															<div>'. Auth::user()->setting()->description .'</div>
														</td>
													</tr>
													<tr>
														<td class="text-center" style="padding: 1px 0;">
															<div>អាសយដ្ឋាន: '. Auth::user()->setting()->address .'</div>
														</td>
													</tr>
													<tr>
														<td class="text-center" style="padding-bottom: 5px;">
															<div>លេខទូរស័ព្ទ: '. Auth::user()->setting()->phone .'</div>
														</td>
													</tr>
												</table>
												<table class="table-information" width="100%" style="border-top: 4px solid red; border-bottom: 4px solid red; margin: 10px 0;">
													<tr>
														<td colspan="3">
															<h5 class="text-center KHOSMoulLight" style="padding-top: 8px;">វិក្កយបត្រ</h5>
														</td>
													</tr>
													<tr>
														<td>
															កាលបរិច្ឆេទ/Date:<span class="date">'. date('d/m/Y', strtotime($invoice->date)) .'</span>
														</td>
														<td width="29%">
															Patient ID:<span class="pt_no">PT-'. str_pad($invoice->inv_number, 6, "0", STR_PAD_LEFT) .'</span>
														</td>
														<td width="29%">
															No.:<span class="inv_number">INV'. date('Y', strtotime($invoice->date)) .'-'.str_pad($invoice->inv_number, 6, "0", STR_PAD_LEFT) .'</span>
														</td>
													</tr>
													<tr>
														<td>
															ឈ្មោះ/Name:<span class="pt_name">'. $invoice->pt_name .'</span>
														</td>
														<td>
															ភេទ/Gender:<span class="pt_gender">'. $invoice->pt_gender .'</span>
														</td>
														<td>
															ទូរស័ព្ទ/Phone:<span class="pt_phone">'. $invoice->pt_phone .'</span>
														</td>
													</tr>
												</table>
												<table class="table-detail" width="100%">
													<thead>
														<th class="text-center" width="8%">
															<div>ល.រ</div>
															<div>No.</div>
														</th>
														<th colspan="2" class="text-center">
															<div>បរិយាយ</div>
															<div>description</div>
														</th>
														<th class="text-center" width="16%">
															<div>តម្លៃ</div>
															<div>Price</div>
														</th>
														<th class="text-center" width="16%">
															<div>បញ្ចុះតម្លៃ</div>
															<div>Discount</div>
														</th>
														<th class="text-center" width="14%">
															<div>តម្លៃសរុប</div>
															<div>Amount</div>
														</th>
													</thead>
													<tbody>
														'. $tbody .'
													</tbody>
													<tfoot>
														<tr>
															<th colspan="2"><small>*** '. $grand_total_in_word .' ***</small></th>
															<th colspan="2" width="30%" class="text-right">សរុប/Total</th>
															<th class="text-right sub_total_riel">'. $total_riel .' ៛</th>
															<th class="text-right sub_total_dollar"><span class="float-left pull-left">$</span> '. number_format($total, 2) .'</th>
														</tr>
														<tr>
															<th colspan="2"><small>*** '. $grand_total_riel_in_word .' ***</small></th>
															<th colspan="2" class="text-right">បញ្ចុះតម្លៃ/Discount</th>
															<th class="text-right discount_total_riel">'. $total_discount_riel .' ៛</th>
															<th class="text-right discount_total_dollar"><span class="float-left pull-left">$</span> '. number_format($total_discount, 2) .'</th>
														</tr>
														<tr>
															<th colspan="2"></th>
															<th colspan="2" class="text-right">តម្លៃសរុបទាំងអស់/Grand Total</th>
															<th class="text-right grand_total_riel">'. $grand_total_riel .' ៛</th>
															<th class="text-right grand_total_dollar"><span class="float-left pull-left">$</span> '. number_format($grand_total, 2) .'</th>
														</tr>
													</tfoot>
												</table>
												<small class="remark">'. $invoice->remark .'</small>
												<br/>
												<table class="table-footer" width="100%">
													<tr>
														<td></td>
														<td width="32%" class="text-center">
															<div>រៀបចំដោយ/Prepared By</div>
															<div class="sign_box"></div>
															<div style="color: blue;">វេជ្ជបណ្ឌិត.<span class="color_blue KHOSMoulLight">'. Auth::user()->setting()->sign_name .'</span></div>
														</td>
													</tr>
												</table>
											</section>';

		return response()->json(['invoice_detail' => $invoice_detail, 'title' => $title]);
		// return $invoice_detail;

	}

	public function inv_number()
	{
		$invoice = Invoice::whereYear('date', date('Y'))->orderBy('inv_number', 'desc')->first();
		return (($invoice === null) ? '000001' : $invoice->inv_number + 1);
	}

	public function create($request)
	{
		$invoice = Invoice::create([
			'date' => $request->date,
			'inv_number' => $request->inv_number,
			'rate' => $request->exchange_rate,
			'pt_no' => $request->pt_no,
			'pt_age' => $request->pt_age,
			'pt_name' => $request->pt_name,
			'pt_gender' => $request->pt_gender,
			'pt_phone' => $request->pt_phone,
			'remark' => $request->remark,
			'patient_id' => $request->patient_id,
			'created_by' => Auth::user()->id,
			'updated_by' => Auth::user()->id,
		]);
		
		if (isset($request->service_id) && isset($request->price) && isset($request->qty) && isset($request->description)) {
			for ($i = 0; $i < count($request->service_id); $i++) {
				$invoice_detail = InvoiceDetail::create([
						'amount' => $request->price[$i],
						'discount' => $request->discount[$i],
						'qty' => $request->qty[$i],
						'description' => $request->description[$i],
						'index' => $i + 1,
						'service_id' => $request->service_id[$i],
						'invoice_id' => $invoice->id,
						'created_by' => Auth::user()->id,
						'updated_by' => Auth::user()->id,
					]);
			}
		}

		return $invoice;
	}

	// public function create_invoice_detail($request)
	// {

	// 	$invoice = Invoice::find($request->invoice_id);
	// 	$last_item = $invoice->invoice_details()->first();
	// 	$index = (($last_item !== null) ? $last_item->index + 1 : 1);
	// 	$service_id = explode(":;:", $request->service_id);

	// 	$invoice_detail = InvoiceDetail::create([
	// 		'amount' => $request->price,
	// 		'discount' => $request->discount,
	// 		'qty' => $request->qty,
	// 		'description' => $request->description,
	// 		'index' => $index,
	// 		'service_id' => $service_id[0],
	// 		'invoice_id' => $request->invoice_id,
	// 		'created_by' => Auth::user()->id,
	// 		'updated_by' => Auth::user()->id,
	// 	]);

	// 	return $invoice_detail;
	// }


	public function invoiceDetailStore($request)
	{

		$invoice = Invoice::find($request->invoice_id);
		$last_item = $invoice->invoice_details()->first();
		$index = (($last_item !== null) ? $last_item->index + 1 : 1);

		$invoice_detail = InvoiceDetail::create([
												'amount' => $request->price,
												'qty' => $request->qty,
												'description' => $request->description,
												'index' => $index,
												'service_id' => $request->service_id,
												'invoice_id' => $request->invoice_id,
												'created_by' => Auth::user()->id,
												'updated_by' => Auth::user()->id,
											]);

		$json = $this->getInvoicePreview($invoice_detail->invoice_id)->getData();

		return response()->json([
			'success'=>'success',
			'invoice_detail' => $invoice_detail,
			'invoice_preview' => $json->invoice_detail,
		]);

	}
	public function invoiceDetailUpdate($request)
	{
		$invoice_detail = InvoiceDetail::find($request->id);
		$invoice_detail->update([
			'amount' => $request->price,
			'qty' => $request->qty,
			'discount' => $request->discount,
			'description' => $request->description,
			'service_id' => $request->service_id,
			'updated_by' => Auth::user()->id,
		]);

		$json = $this->getInvoicePreview($invoice_detail->invoice_id)->getData();
		return response()->json([
			'success'=>'success',
			'invoice_detail' => $invoice_detail,
			'invoice_preview' => $json->invoice_detail,
		]);
	}
	
	// public function update_invoice_detail($request)
	// {
	// 	$invoice = Invoice::find($request->edit_invoice_id);
	// 	$service_id = explode(":;:", $request->edit_service_id);
	// 	$invoice_detail = InvoiceDetail::find($request->edit_id);
	// 	$invoice_detail->update([
	// 		'amount' => $request->edit_price,
	// 		'discount' => $request->edit_discount,
	// 		'qty' => $request->edit_qty,
	// 		'description' => $request->edit_description,
	// 		'service_id' => $service_id[0],
	// 		'updated_by' => Auth::user()->id,
	// 	]);
		
	// 	return $invoice_detail;
	// }

	public function save_order($request)
	{
		$order = explode(',', $request->order_ids);
		$ids = explode(',', $request->item_ids);

		for ($i = 0; $i < count($ids); $i++) {
			$invoice_detail = InvoiceDetail::find($ids[$i])
				->update([
					'index' => $order[$i],
					'updated_by' => Auth::user()->id,
				]);
		}
		return 'success';
	}

	public function update($request, $invoice)
	{
		$invoice->update([
			'date' => $request->date,
			'inv_number' => $request->inv_number,
			'rate' => $request->exchange_rate,
			'pt_no' => $request->pt_no,
			'pt_age' => $request->pt_age,
			'pt_name' => $request->pt_name,
			'pt_gender' => $request->pt_gender,
			'pt_phone' => $request->pt_phone,
			'remark' => $request->remark,
			'patient_id' => $request->patient_id,
			'updated_by' => Auth::user()->id,
		]);
		
		return $invoice;

	}

	public function status($invoice, $status)
	{
		$invoice->update([
			'status' => $status,
		]);

		return $invoice;
	}

	public function destroy($request, $invoice)
	{
		if (Hash::check($request->passwordDelete, Auth::user()->password)) {
			$inv_number = $invoice->inv_number;
			if ($invoice->delete()) {

				return $inv_number;
			}
		} else {
			return false;
		}
	}

	public function destroy_invoice_detail($invoice_detail)
	{
		$inv_number = $invoice_detail->invoice->inv_number;
		if ($invoice_detail->delete()) {
				
			return $inv_number;
		}
		

	}
}
