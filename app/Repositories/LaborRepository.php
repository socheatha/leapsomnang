<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Labor;
use App\Models\LaborCategory;
use App\Models\LaborService;
use App\Models\LaborDetail;
use App\Models\Patient;
use App\Models\Service;
use App\Repositories\PatientRepository;
use Yajra\DataTables\Facades\DataTables;
use Hash;
use Auth;
use DB;


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
		$labors = Labor::select('*', DB::raw("CONCAT(FORMAT(price, 2), ' $') as formated_price"))->whereBetween('date', [$from, $to])->orderBy('labor_number', 'asc')->get();

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

	public function getReport($request)
	{
		$from = $request->from;
		$to = $request->to;
		$tbody = '';
		$conditions = '';
		$pt_id = $request->pt_id;
		if ($pt_id!='') {
			$conditions = ' AND patient_id = '.$pt_id;
		}
		// $labors = Labor::whereBetween('date', [$from, $to])->orderBy('labor_number', 'asc')->get();
		$labors = Labor::whereRaw('date BETWEEN "'. $from .'" AND "'. $to .'"'. $conditions)->orderBy('labor_number', 'asc')->get();
		$total_patient = 0;
		$total_amount = 0;
		foreach ($labors as $key => $labor) {
			$total_patient++;
			$total_amount += $labor->price;

			$description = '';
			foreach ($labor->labor_details as $j => $labor_detail) {
				$description .= '<div>- '. $labor_detail->name .' : '. $labor_detail->result .' '. $labor_detail->service->unit .' ('. $labor_detail->service->ref_from .' - '. $labor_detail->service->ref_from .')</div>';
			}

			$tbody .= '<tr>
									<td class="text-center">'. str_pad($labor->labor_number, 6, "0", STR_PAD_LEFT) .'</td>
									<td class="text-center">'. date('d/M/Y', strtotime($labor->date)) .'</td>
									<td class="text-center font-weight-bold">'. number_format($labor->price,2) .' $</td>
									<td>'. $labor->pt_name .'</td>
									<td class="text-center">'. $labor->pt_age .' ឆ្នាំ</td>
									<td class="text-center">'. $labor->pt_gender .'</td>
									<td>'. $description .'</td>
								</tr>';
		}

		return response()->json([
			'tbody' => $tbody,
			'total_patient' => $total_patient .' នាក់',
			'total_amount' => number_format($total_amount, 2) .' $',
		]);

	}

	public function getLaborServiceCheckList($request)
	{
		$service_check_list = '';
		$labor_category = LaborCategory::find($request->id);
		if ($labor_category != null) {
			foreach ($labor_category->services as $key => $service) {
				$service_check_list .= '<div class="col-sm-3">
																	<div class="form-check mb-3">
																		<input class="minimal chb_service" type="checkbox" id="'. $service->id .'" value="'. $service->id .'">
																		<label class="form-check-label" for="'. $service->id .'">'. $service->name .'</label>
																	</div>
																</div>';
			}
		}
		return response()->json([
			'service_check_list' => $service_check_list,
		]);
	}

	public function getCheckedServicesList($request)
	{
		$checked_services_list = '';
		$labor_services = LaborService::select(DB::raw("id, name, category_id, unit, description, CONCAT(`ref_from`,' - ',`ref_to`) AS reference"))->whereIn('id', $request->ids)->get();
		$no = $request->no;

		foreach ($labor_services as $key => $service) {
			$no++;
			$checked_services_list .= '<tr class="labor_item" id="'. $no.'-'.$service->id .'">
																	<td class="text-center">'. $no .'</td>
																	<td>
																		<input type="hidden" name="service_id[]" value="'. $service->id .'">
																		<input type="hidden" name="service_name[]" value="'. $service->name .'">
																		'. $service->name .'
																	</td>
																	<td class="text-center">
																		<input type="text" name="result[]" class="form-controls is_number">
																	</td>
																	<td class="text-center">
																		<input type="hidden" name="unit[]" value="'. $service->unit .'">
																		'. $service->unit .'
																	</td>
																	<td class="text-center">
																		<input type="hidden" name="reference[]" value="'. $service->reference .'">
																		'. $service->reference .'
																	</td>
																	<td class="text-center">
																		<button type="button" onclick="removeCheckedService(\''. $no.'-'.$service->id .'\')" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
																	</td>
																</tr>';
		}
		return response()->json([
			'checked_services_list' => $checked_services_list,
		]);
	}

	public function storeAndGetLaborDetail($request)
	{

		$labor_detail_list = '';
		$labor = Labor::find($request->labor_id);
		$labor_services = LaborService::select(DB::raw("id, name, category_id, unit, description, CONCAT(`ref_from`,' - ',`ref_to`) AS reference"))->whereIn('id', $request->service_ids)->get();
		foreach ($labor_services as $key => $service) {
			LaborDetail::create([
				'name' => $service->name,
				'service_id' => $service->id,
				'labor_id' => $labor->id,
				'created_by' => Auth::user()->id,
				'updated_by' => Auth::user()->id,
			]);
		}

		foreach ($labor->labor_details as $order => $labor_detail) {
			$labor_detail_list .= '<tr class="labor_item" id="'. $labor_detail->result .'">
																<td class="text-center">'. ++$order .'</td>
																<td>
																	<input type="hidden" name="labor_detail_ids[]" value="'. $labor_detail->id .'">
																	'. $labor_detail->name .'
																</td>
																<td class="text-center">
																	<input type="text" name="result[]" value="'. $labor_detail->result .'" class="form-controls is_number"/>
																</td>
																<td class="text-center">
																	'. $labor_detail->service->unit .'
																</td>
																<td class="text-center">
																	'. $labor_detail->service->ref_from .' - '. $labor_detail->service->ref_to .'
																</td>
																<td class="text-center">
																	<button type="button" onclick="deleteLaborDetail(\''. $labor_detail->id .'\')" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
																</td>
															</tr>';
		}

		return response()->json([
			'labor_detail_list' => $labor_detail_list,
		]);
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
		$labor_detail_item_list = '';

		$labor = Labor::find($id);

		$title = 'Labor ('. str_pad($labor->labor_number, 6, "0", STR_PAD_LEFT) .')';

		foreach ($labor->labor_details as $labor_detail) {
			$class = '';
			if ($labor_detail->result < $labor_detail->service->ref_from) {
				$class = 'color_green';
			}else if ($labor_detail->result > $labor_detail->service->ref_to) {
				$class = 'color_red';
			}else{
				$class = '';
			}
			$labor_detail_item_list .= '<tr>
																		<td width="2%"></td>
																		<td width="30%">-'. $labor_detail->name .'</td>
																		<td width="20%">: <b><span class="'. $class .'">'. $labor_detail->result .'</span></b></td>
																		<td width="12%">&nbsp;'. $labor_detail->service->unit .'</td>
																		<td width="20%">('. $labor_detail->service->ref_from .'-'. $labor_detail->service->ref_to .')</td>
																	</tr>';
		}
		
		// 	<table width="100%">
		// 	<tr>
		// 		<td width="2%"></td>
		// 		<td width="28%">TO</td>
		// 		<td width="38%"><div style="border-bottom: 1px dotted red;">​ ​</div></td>
		// 		<td width="12%">Négatif</td>
		// 		<td width="20%"></td>
		// 	</tr>
		// 	<tr>
		// 		<td width="2%"></td>
		// 		<td width="28%">TH</td>
		// 		<td width="38%"><div style="border-bottom: 1px dotted red;">​ ​</div></td>
		// 		<td width="12%">Négatif</td>
		// 		<td width="20%"></td>
		// 	</tr>
		// </table>
		if(empty($labor->province)){ $labor->province = new \stdClass(); $labor->province->name = ''; }
		if(empty($labor->district)){ $labor->district = new \stdClass(); $labor->district->name = ''; }

		$labor_detail = '<section class="labor-print" style="position: relative;">
												<table class="table-header" width="100%">
													<tr>
														<td rowspan="5" width="20%" style="padding: 10px;">
															<img src="/images/setting/logo.png" alt="IMG">
														</td>
														<td class="text-center" style="padding: 5px 0;">
															<h6 class="KHOSMoulLight" style="font-size: 19px;">'. Auth::user()->setting()->clinic_name_kh .'</h6>
														</td>
													</tr>
													<tr>
														<td class="text-center" style="padding: 2px 0;">
															<h6 class="roboto_b" style="font-size: 19px;">'. Auth::user()->setting()->clinic_name_en .'</h6>
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
												<table class="table-information" width="100%" style="margin: 5px 0 15px 0;">
													<tr>
														<td colspan="4">
															<h6 class="text-center KHOSMoulLight" style="padding: 10px 0 10px 0; font-size: 16px;">លទ្ធផលពិនិត្យឈាម</h6>
														</td>
													</tr>
													<tr>
														<td width="35%" style="padding-left: 55px;">
															ឈ្មោះ:<span class="pt_name">'. $labor->pt_name .'</span>
														</td>
														<td width="18%">
															អាយុ:<span class="pt_age">'. $labor->pt_age .' ឆ្នាំ</span>
														</td>
														<td width="18%">
															ភេទ:<span class="pt_gender">'. $labor->pt_gender .' ឆ្នាំ</span>
														</td>
														<td width="25%" style="padding-left: 25px;">
															លេខរៀង:<span class="labor_number">'. str_pad($labor->labor_number, 6, "0", STR_PAD_LEFT) .'</span>
														</td>
													</tr>
													<tr class="sr-only">
														<td>
															កាលបរិច្ឆេទ:<span class="date">'. date('d/m/Y', strtotime($labor->date)) .'</span>
														</td>
														<td>
															ភេទ:<span class="pt_gender">'. $labor->pt_gender .'</span>
														</td>
														<td>
															ទូរស័ព្ទ:<span class="pt_phone">'. $labor->pt_phone .'</span>
														</td>
													</tr>
													<tr class="sr-only">
														<td colspan="3">
															អាសយដ្ឋាន: <span class="pt_name">'. (($labor->pt_village!='')? 'ភូមិ'.$labor->pt_village : '') . (($labor->pt_commune!='')? (($labor->province->name=='ភ្នំពេញ')? ' សង្កាត់'.$labor->pt_commune : ' ឃុំ'.$labor->pt_commune) : '') . (($labor->district->name!='')? (($labor->province->name=='ភ្នំពេញ')? ' ខណ្ឌ'.$labor->district->name : ' ស្រុក'.$labor->district->name) : ''). (($labor->province->name!='')? (($labor->province->name=='ភ្នំពេញ')? ' រាជធានីភ្នំពេញ'.$labor->province->name : ' ខេត្ត'.$labor->province->name) : '') .'</span>
														</td>
													</tr>
												</table>
												<div style="height: 14cm"></div>
												<small class="remark">'. $labor->remark .'</small>
												<br/>
												<div class="color_red" style="color: red; text-align: center; text-decoration: underline; position: absolute; bottom: 25px; left: 50%; transform: translateX(-50%);">សូមយកលទ្ធផលពិនិត្យឈាមនេះមកវិញពេលមកពិនិត្យលើក្រោយ</div>
												<table class="table-footer mt---5" width="100%">
													<tr>
														<td>
															<div>Séro Ag Widel</div>
															<ul style="list-style-type: none; margin: 0; padding-left: 14px;">
																<li style="margin-left: 0;">-TO:............................................Négatif</li>
																<li style="margin-left: 0;">-TH:............................................Négatif</li>
															</ul>
															<table width="100%">
																'. $labor_detail_item_list .'
															</table>
														</td>
														<td width="28%" class="text-center">
															<div>គ្រូពេទ្យព្យាបាល</div>
															<div class="sign_box"></div>
															<div><span class="KHOSMoulLight">'. Auth::user()->setting()->sign_name_kh .'</span></div>
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
			'price' => $request->price ?: 0,
			'remark' => $request->remark,
			'patient_id' => $patient_id,
			'created_by' => Auth::user()->id,
			'updated_by' => Auth::user()->id,
		]);
		
		if (isset($request->service_name) && isset($request->service_id)) {
			for ($i = 0; $i < count($request->service_name); $i++) {
				LaborDetail::create([
						'name' => $request->service_name[$i],
						'result' => $request->result[$i],
						'service_id' => $request->service_id[$i],
						'labor_id' => $labor->id,
						'created_by' => Auth::user()->id,
						'updated_by' => Auth::user()->id,
					]);
			}
		}

		return $labor;
	}

	public function update($request, $labor)
	{
		$labor->update([
			'date' => $request->date,
			'pt_age' => $request->pt_age,
			'pt_name' => $request->pt_name,
			'pt_gender' => $request->pt_gender,
			'pt_phone' => $request->pt_phone,
			'pt_village' => $request->pt_village,
			'pt_commune' => $request->pt_commune,
			'pt_district_id' => $request->pt_district_id,
			'pt_province_id' => $request->pt_province_id,
			'price' => $request->price ?: 0,
			'remark' => $request->remark,
			'updated_by' => Auth::user()->id,
		]);
		if (isset($request->labor_detail_ids)) {
			for ($i = 0; $i < count($request->labor_detail_ids); $i++) {
				LaborDetail::find($request->labor_detail_ids[$i])->update([
																														'result' => $request->result[$i],
																														'updated_by' => Auth::user()->id,
																													]);
			}
		}
		
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

	public function deleteLaborDetail($request)
	{
		$labor_detail = LaborDetail::find($request->id);
		$labor_id = $labor_detail->labor_id;
		$labor_detail->delete();

		$json = $this->getLaborPreview($labor_id)->getData();

		$labor = Labor::find($labor_id);
		$labor_detail_list = '';
		foreach ($labor->labor_details as $order => $labor_detail) {
			$labor_detail_list .= '<tr class="labor_item" id="'. $labor_detail->result .'">
																<td class="text-center">'. ++$order .'</td>
																<td>
																	<input type="hidden" name="labor_detail_ids[]" value="'. $labor_detail->id .'">
																	'. $labor_detail->name .'
																</td>
																<td class="text-center">
																	<input type="text" name="result[]" value="'. $labor_detail->result .'" class="form-controls is_number"/>
																</td>
																<td class="text-center">
																	'. $labor_detail->service->unit .'
																</td>
																<td class="text-center">
																	'. $labor_detail->service->ref_from .' - '. $labor_detail->service->ref_from .'
																</td>
																<td class="text-center">
																	<button type="button" onclick="deleteLaborDetail(\''. $labor_detail->id .'\')" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
																</td>
															</tr>';
			}

		return response()->json([
			'success'=>'success',
			'labor_preview' => $json->labor_detail,
			'labor_detail_list' => $labor_detail_list,
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
