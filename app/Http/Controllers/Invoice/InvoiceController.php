<?php

namespace App\Http\Controllers\Invoice;

use App\Models\Service;
use App\Models\Patient;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\InvoiceDetailRequest;
use App\Http\Requests\InvoiceDetailUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\InvoiceRepository;
use Auth;

class InvoiceController extends Controller
{
	
	protected $invoice;

	public function __construct(InvoiceRepository $repository)
	{
		$this->invoice = $repository;
	}

	public function getDatatable(Request $request)
	{
		return $this->invoice->getDatatable($request);
	}

	public function index()
	{

		$invoices = Invoice::all();
		$invoice_description = '';
		foreach ($invoices as $i => $invoice) {
			foreach ($invoice->invoice_details as $j => $invoice_detial) {
				if ($invoice->invoice_details->count() > 1) {
					$invoice_description .= str_replace(' on ' . date('M-D', strtotime($invoice_detial->invoice->date)), "", strip_tags($invoice_detial->description, "</p>")) . ', ';
				} else {

					$invoice_description = str_replace(' on ' . date('M-D', strtotime($invoice_detial->invoice->date)), "", strip_tags($invoice_detial->description, "</p>"));
				}
			}
		}
		$from = '2020-05-01';
		$to = '2020-05-31';
		$invoice_ids = Invoice::whereBetween('date', [$from, $to])->select('id');
		$this->data = [
			'invoice_description' => $invoice_description,
			'invoice_details' => InvoiceDetail::whereIn('service_id', ['59', '60', '61', '62', '63', '64', '65'])->whereIn('invoice_id', $invoice_ids)->get(),
		];

		return view('invoice.index', $this->data);
	}


	public function create()
	{
		$this->data = [
			'inv_number' => $this->invoice->inv_number(),
			'services' => Service::getSelectData('id', 'name', '', 'name' ,'asc'),
			'patients' => Patient::getSelectData('id', 'name', '', 'name' ,'asc'),
		];
		return view('invoice.create', $this->data);
	}


	public function store(InvoiceRequest $request)
	{
		$invoice = $this->invoice->create($request);
		if ($invoice) {
			// Redirect
			return redirect()->route('invoice.edit', $invoice->id)
				->with('success', __('alert.crud.success.create', ['name' => Auth::user()->module()]) . $request->date);
		}
	}

	// public function invoice_detail_store(InvoiceDetailRequest $request)
	// {
	// 	$invoice_detail = $this->invoice->create_invoice_detail($request);
	// 	if ($invoice_detail) {
	// 		// Redirect
	// 		return redirect()->route('invoice.edit', $request->invoice_id)
	// 			->with('success', __('alert.crud.success.create', ['name' => Auth::user()->module()]) . str_pad($invoice_detail->invoice->inv_number, 6, "0", STR_PAD_LEFT));
	// 	}
	// }

	// public function invoice_detail_update(InvoiceDetailUpdateRequest $request)
	// {

	// 	$invoice_detail = $this->invoice->update_invoice_detail($request);
	// 	if ($invoice_detail) {
	// 		// Redirect
	// 		return redirect()->route('invoice.edit', $request->edit_invoice_id)
	// 			->with('success', __('alert.crud.success.update', ['name' => Auth::user()->module()]) . str_pad($invoice_detail->invoice->inv_number, 6, "0", STR_PAD_LEFT));
	// 	}
	// }

	public function save_order(Request $request, Invoice $invoice)
	{
		if ($this->invoice->save_order($request)) {
			// Redirect
			return redirect()->route('invoice.edit', $invoice->id)
				->with('success', __('alert.crud.success.update', ['name' => Auth::user()->module()]) . str_pad($invoice->inv_number, 6, "0", STR_PAD_LEFT));
		}
	}

	public function show(Invoice $invoice)
	{
		//
	}

	
	public function getItemDetail(Request $request)
	{
		return response()->json([ 'invoice_detail' => InvoiceDetail::find($request->id) ]);
	}

	public function get_edit_detail(Request $request)
	{
		return $this->invoice->get_edit_detail($request->id);
	}
	
	public function invoiceDetailStore(Request $request)
	{
		$validator = \Validator::make($request->all(), [
			'price' => 'required|numeric',
			'qty' => 'required|numeric',
			'discount' => 'required',
			'description' => 'required',
		]);
		
		if ($validator->fails())
		{
				return response()->json(['errors'=>$validator->errors()]);
		}
		return $this->invoice->invoiceDetailStore($request);
	}

	public function invoiceDetailUpdate(Request $request)
	{
		$validator = \Validator::make($request->all(), [
			'price' => 'required|numeric',
			'qty' => 'required|numeric',
			'discount' => 'required',
			'description' => 'required',
		]);
		
		if ($validator->fails())
		{
				return response()->json(['errors'=>$validator->errors()]);
		}
		return $this->invoice->invoiceDetailUpdate($request);
	}

	public function getInvoicePreview(Request $request)
	{
		return $this->invoice->getInvoicePreview($request->id);
	}

	public function invoice_detail(Invoice $invoice)
	{
		$this->data = [
			'invoice' => $invoice,
			'services' => Service::getSelectService($invoice->service_id),
			'invoice_preview' => $this->invoice->getInvoicePreview($invoice->id),
		];

		return view('invoice.invoice_detail', $this->data);
	}


	public function edit(Invoice $invoice)
	{

		$this->data = [
			'invoice' => $invoice,
			// 'services' => Service::getSelectService(InvoiceDetail::select('service_id')->where('invoice_id', $invoice->id)),
			'services' => Service::getSelectData('id', 'name', '', 'name' ,'asc'),
			'patients' => Patient::getSelectData('id', 'name', '', 'name' ,'asc'),
			'invoice_preview' => $this->invoice->getInvoicePreview($invoice->id)->getData()->invoice_detail,
		];

		return view('invoice.edit', $this->data);
	}

	public function print(Invoice $invoice)
	{

		$this->data = [
			'invoice' => $invoice,
			'invoice_preview' => $this->invoice->getInvoicePreview($invoice->id)->getData()->invoice_detail,
		];

		return view('invoice.print', $this->data);
	}

	public function update(InvoiceRequest $request, Invoice $invoice)
	{
		if ($this->invoice->update($request, $invoice)) {

			// Redirect
			return redirect()->route('invoice.edit', $invoice->id)
				->with('success', __('alert.crud.success.update', ['name' => Auth::user()->module()]) . str_pad($request->inv_number, 6, "0", STR_PAD_LEFT));
		}
	}

	public function status(Invoice $invoice, $status)
	{
		if ($this->invoice->status($invoice, $status)) {

			// Redirect
			return redirect()->route('invoice.index')
				->with('success', __('alert.crud.success.update', ['name' => Auth::user()->module()]) . str_pad($invoice->inv_number, 6, "0", STR_PAD_LEFT));
		}
	}


	public function destroy(Request $request, Invoice $invoice)
	{
		// Redirect
		return redirect()->route('invoice.index')
			->with('success', __('alert.crud.success.delete', ['name' => Auth::user()->module()]) . str_pad(($this->invoice->destroy($request, $invoice)), 6, "0", STR_PAD_LEFT));
	}

	public function invoice_detail_destroy(InvoiceDetail $invoice_detail)
	{
		// Redirect
		return redirect()->route('invoice.edit', $invoice_detail->invoice_id)
			->with('success', __('alert.crud.success.delete', ['name' => Auth::user()->module()]) . $this->invoice->destroy_invoice_detail($invoice_detail));
	}
}
