<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Labor;
use App\Models\LaborDetail;
use App\Models\Patient;
use App\Models\Service;
use App\Repositories\PatientRepository;
use Yajra\DataTables\Facades\DataTables;
use Hash;
use Auth;


class LaborRepository
{

	public function getDatatable($request)
	{
		
		$from = $request->from;
		$to = $request->to;
		$labor_number = $request->labor_number;
		$conditions = '';
		if ($labor_number!='') {
			$conditions = ' AND labor_number LIKE "%'. intval($labor_number) .'%"';
		}
		$labors = Labor::whereBetween('date', [$from, $to])->orderBy('labor_number', 'asc')->get();

		return Datatables::of($labors)
			->editColumn('labor_number', function ($labor) {
				return str_pad($labor->labor_number, 6, "0", STR_PAD_LEFT);
			})
			->addColumn('actions', function () {
				$button = '';
				return $button;
			})
			->make(true);
	}

	public function get_edit_detail($id)
	{
		$labor_detail = LaborDetail::find($id);
		$service = $labor_detail->service;
		return $labor_detail;
	}

	public function getLaborPreview($id)
	{

		$no = 1;
		$total = 0;
		$total_discount = 0;
		$grand_total = 0;
		$labor_detail = '';
		$tbody = '';

		$labor = Labor::find($id);

		$title = 'Labor (INV'. date('Y', strtotime($labor->date)) .'-'.str_pad($labor->labor_number, 6, "0", STR_PAD_LEFT) .')';

		foreach ($labor->labor_details as $labor_detail) {
			$amount = ($labor_detail->amount);
			$total += $amount;
			$tbody .= '<tr>
									<td class="text-center">' . $no++ . '</td>
									<td colspan="3">' . $labor_detail->name . '</td>
									<td class="text-right"><span class="pull-left float-left">$</span> ' . number_format($amount, 2) . '</td>
								</tr>';
		}
		$total_riel = number_format($total*$labor->rate, 0);

		
		$gtt = explode(".", number_format($total,2));
		$gtt_dollars = $gtt[0];
		$gtt_cents = $gtt[1];

		$grand_total_in_word = Auth::user()->num2khtext($gtt_dollars, false) . 'ដុល្លារ' . (($gtt_cents>0)? ' និង'. Auth::user()->num2khtext($gtt_cents, false) .'សេន' : '');
		$grand_total_riel_in_word = Auth::user()->num2khtext(round($total*$labor->rate, 0), false);

		if(empty($labor->province)){ $labor->province = new \stdClass(); $labor->province->name = ''; }
		if(empty($labor->district)){ $labor->district = new \stdClass(); $labor->district->name = ''; }

		$labor_detail = '<section class="labor-print" style="position: relative;">
												<table class="table-header" width="100%">
													<tr>
														<td rowspan="5" width="20%" style="padding: 10px;">
															<img src="/images/setting/logo.png" alt="IMG">
														</td>
														<td class="text-center" style="padding: 5px 0;">
															<h6 class="color_blue KHOSMoulLight" style="color: blue;">'. Auth::user()->setting()->clinic_name_kh .'</h6>
														</td>
													</tr>
													<tr>
														<td class="text-center" style="padding: 2px 0;">
															<h6 class="color_red roboto_b" style="color: red;">'. Auth::user()->setting()->clinic_name_en .'</h6>
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
												<table class="table-information" width="100%" style="margin: 15px 0 15px 0;">
													<tr>
														<td colspan="3">
															<h6 class="text-center KHOSMoulLight" style="padding-top: 8px;">លទ្ធផលពិនិត្យឈាម</h6>
														</td>
													</tr>
													<tr>
														<td>
															កាលបរិច្ឆេទ:<span class="date">'. date('d/m/Y', strtotime($labor->date)) .'</span>
														</td>
														<td width="29%">
															លេខអ្នកជំងឺ:<span class="pt_no">'. str_pad($labor->pt_no, 6, "0", STR_PAD_LEFT) .'</span>
														</td>
														<td width="29%">
															រោគវិនិច្ឆ័យ:<span class="labor_number">'. $labor->pt_diagnosis .'</span>
														</td>
													</tr>
													<tr>
														<td>
															ឈ្មោះ:<span class="pt_name">'. $labor->pt_name .'</span>
														</td>
														<td>
															ភេទ:<span class="pt_gender">'. $labor->pt_gender .'</span>
														</td>
														<td>
															ទូរស័ព្ទ:<span class="pt_phone">'. $labor->pt_phone .'</span>
														</td>
													</tr>
													<tr>
														<td colspan="3">
															អាសយដ្ឋាន: <span class="pt_name">'. (($labor->pt_village!='')? 'ភូមិ'.$labor->pt_village : '') . (($labor->pt_commune!='')? (($labor->province->name=='ភ្នំពេញ')? ' សង្កាត់'.$labor->pt_commune : ' ឃុំ'.$labor->pt_commune) : '') . (($labor->district->name!='')? (($labor->province->name=='ភ្នំពេញ')? ' ខណ្ឌ'.$labor->district->name : ' ស្រុក'.$labor->district->name) : ''). (($labor->province->name!='')? (($labor->province->name=='ភ្នំពេញ')? ' រាជធានីភ្នំពេញ'.$labor->province->name : ' ខេត្ត'.$labor->province->name) : '') .'</span>
														</td>
													</tr>
												</table>
												<table class="table-detail" width="100%">
													<thead>
														<th class="text-center" width="8%">
															<div>ល.រ</div>
														</th>
														<th colspan="3" class="text-center">
															<div>បរិយាយ</div>
														</th>
														<th class="text-center" width="16%">
															<div>តម្លៃ</div>
														</th>
													</thead>
													<tbody>
														'. $tbody .'
													</tbody>
												</table>
												<small class="remark">'. $labor->remark .'</small>
												<br/>
												<div style="color: red; text-align: center; position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%);"><u>សូមយកវិក្កយបត្រមកវិញពេលមកពិនិត្យលើក្រោយ</u></div>
												<table class="table-footer" width="100%">
													<tr>
														<td>
															<div>Séro Ag Widel</div>
															<ul class="">
																<li>TO:……………………………………………Négatif</li>
																<li>TH:……………………………………………Négatif</li>
															</ul>
														</td>
														<td width="32%" class="text-center">
															<div>គ្រូពេទ្យព្យាបាល</div>
															<div class="sign_box"></div>
															<div style="color: blue;"><span class="color_blue KHOSMoulLight">'. Auth::user()->setting()->sign_name_kh .'</span></div>
														</td>
													</tr>
												</table>
											</section>';

		return response()->json(['labor_detail' => $labor_detail, 'title' => $title]);
		// return $labor_detail;

	}

	public function labor_number()
	{
		$labor = Labor::whereYear('date', date('Y'))->orderBy('labor_number', 'desc')->first();
		return (($labor === null) ? '000001' : $labor->labor_number + 1);
	}

	public function create($request)
	{

		$patient_id = $request->patient_id;

		if (isset($request->patient_id) && $request->patient_id!='') {
			# code...
		}else{
			$patient = Patient::where('name', $request->pt_name)->first();

			if ($patient!=null) {
				$patient_id = $patient->id;
			}else{
				$created_patient = Patient::create([
					'name' => $request->pt_name,
					'age' => $request->pt_age,
					'gender' => (($request->pt_gender=='ប្រុស' || $request->pt_gender == 'male' || $request->pt_gender == 'Male')? '1' : '2'),
					'phone' => $request->pt_phone,
					'address_village' => $request->pt_village,
					'address_commune' => $request->pt_commune,
					'address_district_id' => $request->pt_district_id,
					'address_province_id' => $request->pt_province_id,
					'created_by' => Auth::user()->id,
					'updated_by' => Auth::user()->id,
				]);
				$patient_id = $created_patient->id;
			}
		}

		$labor = Labor::create([
			'date' => $request->date,
			'labor_number' => $request->labor_number,
			'pt_no' => str_pad($patient_id, 6, "0", STR_PAD_LEFT),
			'pt_age' => $request->pt_age,
			'pt_name' => $request->pt_name,
			'pt_gender' => $request->pt_gender,
			'pt_phone' => $request->pt_phone,
			'pt_village' => $request->pt_village,
			'pt_commune' => $request->pt_commune,
			'pt_district_id' => $request->pt_district_id,
			'pt_province_id' => $request->pt_province_id,
			'pt_diagnosis' => $request->pt_diagnosis,
			'remark' => $request->remark,
			'patient_id' => $patient_id,
			'created_by' => Auth::user()->id,
			'updated_by' => Auth::user()->id,
		]);
		
		if (isset($request->service_name) && isset($request->price) && isset($request->description)) {
			for ($i = 0; $i < count($request->service_name); $i++) {
				LaborDetail::create([
						'name' => $request->service_name[$i],
						'amount' => $request->price[$i],
						'description' => $request->description[$i],
						'index' => $i + 1,
						'service_id' => $this->get_service_id_or_create($request->service_name[$i], $request->price[$i], $request->description[$i]),
						'labor_id' => $labor->id,
						'created_by' => Auth::user()->id,
						'updated_by' => Auth::user()->id,
					]);
			}
		}

		return $labor;
	}

	public function laborDetailStore($request)
	{
		$labor = Labor::find($request->labor_id);
		$last_item = $labor->labor_details()->first();
		$index = (($last_item !== null) ? $last_item->index + 1 : 1);

		$labor_detail = LaborDetail::create([
												'name' => $request->service_name,
												// 'discount' => $request->discount,
												'amount' => $request->price,
												'description' => $request->description,
												'index' => $index,
												'service_id' => $this->get_service_id_or_create($request->service_name, $request->price, $request->description),
												'labor_id' => $request->labor_id,
												'created_by' => Auth::user()->id,
												'updated_by' => Auth::user()->id,
											]);

		$json = $this->getLaborPreview($labor_detail->labor_id)->getData();

		return response()->json([
			'success'=>'success',
			'labor_detail' => $labor_detail,
			'labor_preview' => $json->labor_detail,
		]);

	}
	public function laborDetailUpdate($request)
	{
		$labor_detail = LaborDetail::find($request->id);
		$labor_detail->update([
			'name' => $request->service_name,
			'amount' => $request->price,
			// 'discount' => $request->discount,
			'description' => $request->description,
			'service_id' => $this->get_service_id_or_create($request->service_name, $request->price, $request->description),
			'updated_by' => Auth::user()->id,
		]);

		$json = $this->getLaborPreview($labor_detail->labor_id)->getData();
		return response()->json([
			'success'=>'success',
			'labor_detail' => $labor_detail,
			'labor_preview' => $json->labor_detail,
		]);
	}

	public function save_order($request)
	{
		$order = explode(',', $request->order_ids);
		$ids = explode(',', $request->item_ids);

		for ($i = 0; $i < count($ids); $i++) {
			$labor_detail = LaborDetail::find($ids[$i])
				->update([
					'index' => $order[$i],
					'updated_by' => Auth::user()->id,
				]);
		}
		return 'success';
	}

	public function update($request, $labor)
	{
		$labor->update([
			'date' => $request->date,
			'labor_number' => $request->labor_number,
			'rate' => $request->exchange_rate,
			'pt_no' => str_pad($request->patient_id, 6, "0", STR_PAD_LEFT),
			'pt_age' => $request->pt_age,
			'pt_name' => $request->pt_name,
			'pt_gender' => $request->pt_gender,
			'pt_phone' => $request->pt_phone,
			'pt_village' => $request->pt_village,
			'pt_commune' => $request->pt_commune,
			'pt_district_id' => $request->pt_district_id,
			'pt_province_id' => $request->pt_province_id,
			'pt_diagnosis' => $request->pt_diagnosis,
			'status' => (($request->status==null)? 0 : 1),
			'remark' => $request->remark,
			'patient_id' => $request->patient_id,
			'updated_by' => Auth::user()->id,
		]);
		
		return $labor;

	}

	public function status($request)
	{
		$labor = Labor::find($request->id);
		$status = $labor->status;
		$labor->update([
			'status' => (($status==0)? '1' : '0'),
		]);

		return $labor;
	}

	public function destroy($request, $labor)
	{
		if (Hash::check($request->passwordDelete, Auth::user()->password)) {
			$labor_number = $labor->labor_number;
			if ($labor->delete()) {

				return $labor_number;
			}
		} else {
			return false;
		}
	}

	public function destroy_labor_detail($labor_detail)
	{
		$labor_number = $labor_detail->labor->labor_number;
		if ($labor_detail->delete()) {
				
			return $labor_number;
		}
		

	}

	public function deleteLaborDetail($request)
	{
		$labor_detail = LaborDetail::find($request->id);
		$labor_id = $labor_detail->labor_id;
		$labor_detail->delete();
		$json = $this->getLaborPreview($labor_id)->getData();

		return response()->json([
			'success'=>'success',
			'labor_preview' => $json->labor_detail,
		]);
	}

	public function get_service_id_or_create($name = '', $price = 0, $description = '')
	{
		$name = trim($name);
		$service = Service::where('name', $name)->first();

		if ($service != null) return $service->id;
		$created_service = Service::create([
			'name' => $name,
			'price' => $price,
			'description' => $description,
			'created_by' => Auth::user()->id,
			'updated_by' => Auth::user()->id,
		]);
		return $created_service->id;
	}
}
