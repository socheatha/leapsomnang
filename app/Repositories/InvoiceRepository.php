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

	public function get_invoice_preview($id)
	{

		$no = 1;
		$total = 0;
		$total_vat = 0;
		$grand_total = 0;
		$grand_total_riel = 0;
		$invoice_detail = '';
		$tbody = '';

		$invoice = Invoice::find($id);

		$title = 'DNKL-Tax-Invoice (' . str_pad($invoice->inv_number, 6, "0", STR_PAD_LEFT) . ')';

		foreach ($invoice->invoice_details as $invoice_detail) {
			$tbody .= '<tr class="' . (($invoice->empty_row == 0) ? 'last-tr' : '') . '">
									<td class="text-center" valign="top">' . $no++ . '</td>
									<td>' . $invoice_detail->description . '</td>
									<td class="text-center" valign="top">' . $invoice_detail->qty . '</td>
									<td class="text-right" valign="top" colspan="2"><span class="pull-left">$</span> ' . number_format($invoice_detail->amount, 2) . '</td>
									<td class="text-right" valign="top"><span class="pull-left">$</span> ' . number_format(($invoice_detail->amount * $invoice_detail->qty), 2) . '</td>
								</tr>';
			$total += ($invoice_detail->amount * $invoice_detail->qty);
		}


		$invoice_detail = '';

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

	public function create_invoice_detail($request)
	{

		$invoice = Invoice::find($request->invoice_id);
		$last_item = $invoice->invoice_details()->first();
		$index = (($last_item !== null) ? $last_item->index + 1 : 1);
		$service_id = explode(":;:", $request->service_id);

		$invoice_detail = InvoiceDetail::create([
			'amount' => $request->price,
			'qty' => $request->qty,
			'description' => $request->description,
			'index' => $index,
			'service_id' => $service_id[0],
			'invoice_id' => $request->invoice_id,
			'created_by' => Auth::user()->id,
			'updated_by' => Auth::user()->id,
		]);

		return $invoice_detail;
	}

	public function update_invoice_detail($request)
	{
		$invoice = Invoice::find($request->edit_invoice_id);
		$service_id = explode(":;:", $request->edit_service_id);
		$invoice_detail = InvoiceDetail::find($request->edit_id);
		$invoice_detail->update([
			'amount' => $request->edit_price,
			'qty' => $request->edit_qty,
			'description' => $request->edit_description,
			'service_id' => $service_id[0],
			'updated_by' => Auth::user()->id,
		]);
		
		return $invoice_detail;
	}

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
				
				$invoice_detail2 = DB::connection('mysql2')->table('invoice_details')->where('id', $ids[$i])->update([
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
