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
use App\Repositories\Component\GlobalComponent;


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
		$labors = Labor::select('*', DB::raw("CONCAT('៛ ', FORMAT(price, 0)) as formated_price"))->whereBetween('date', [$from, $to])->orderBy('labor_number', 'asc')->get();

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
		$GlobalComponent = new GlobalComponent;
		$from = $request->from;
		$to = $request->to;
		$tbody = '';
		$conditions = '';
		$pt_id = $request->pt_id;
		if ($pt_id!='') {
			$conditions = ' AND patient_id = '.$pt_id;
		}
		$labors = Labor::whereRaw('date BETWEEN "'. $from .'" AND "'. $to .'"'. $conditions)->orderBy('labor_number', 'asc')->get();
		$total_patient = 0;
		$total_amount = 0;
		foreach ($labors as $key => $labor) {
			$total_patient++;
			$total_amount += $labor->price;
			
			$tbody .= '<tr>
									<td class="text-center">'. str_pad($labor->labor_number, 6, "0", STR_PAD_LEFT) .'</td>
									<td class="text-center">'. date('d/M/Y', strtotime($labor->date)) .'</td>
									<td class="text-center font-weight-bold">៛ '. number_format($labor->price, 0) .'</td>
									<td>'. $labor->pt_name .'</td>
									<td class="text-center">'. $labor->pt_age . ' ' . __('module.table.selection.age_type_' . $labor->pt_age_type) . '</td>
									<td class="text-center">'. $labor->pt_gender .'</td>
									<td class="text-right">
									<button class="btn btn-sm btn-info" onclick="getDetail('. $labor->id .')"><i class="fa fa-list"></i></button>
									<div class="sr-only" id="detail-'. $labor->id .'">'. $this->getLaborPreview($labor->id)->getData()->labor_detail .'</div>
									</td>
								</tr>';
		}

		return response()->json([
			'tbody' => $tbody,
			'total_patient' => $total_patient .' នាក់',
			'total_amount' => '៛ ' . number_format($total_amount, 0),
		]);

	}

	public function getLaborServiceCheckList($request)
	{
		$category_check_list = '';
		$service_check_list = '';

		$ids = [];
		if ($request->type == 'labor-standard') {
			$ids = [1,2,3,4,5];
		}else if ($request->type == 'hematology') {
			$ids = [1];
		}else if ($request->type == 'biologie') {
			$ids = [2];
		}else if ($request->type == 'urine') {
			$ids = [3];
		}else if ($request->type == 'serologie') {
			$ids = [4];
		}else if ($request->type == 'blood-type') {
			$ids = [5];
		}

		$labor_categories = LaborCategory::whereIn('id', $ids)->get();

		foreach ($labor_categories as $key => $labor_category) {

			$service_check_list = '';
			foreach ($labor_category->services as $jey => $service) {
				$service_check_list .= '<div class="col-sm-4">
																	<div class="form-check mb-3">
																		<input class="minimal chb_service" type="checkbox" id="'. $service->id .'" value="'. $service->id .'">
																		<label class="form-check-label" for="'. $service->id .'">'. $service->name .'</label>
																	</div>
																</div>';
			}

			$category_check_list .= '<div class="col-sm-12">
																<h5 class="text-center pt-3 pb-4">'. $labor_category->name .'</h5>
															</div>
															'. $service_check_list .'
														';

		}

		return response()->json([
			'category_check_list' => $category_check_list,
		]);
	}

	public function getCheckedServicesList($type)
	{
		$ids = [];
		$no = 0;
		$checked_services_list = '';
		if ($type == 'glycemia') {
			$ids = [2];
		}else if ($type == 'labor-bio') {
			$ids = [2];
		}else if ($type == 'serologie') {
			$ids = [3,4];
		}else if ($type == 'urine') {
			$ids = [5];
		}
		
		$service_check_list = '';
		$labor_categories = LaborCategory::whereIn('id', $ids)->get();
		foreach ($labor_categories as $key => $labor_category) {

			if ($type == 'glycemia') {

				$service = $labor_category->services()->where('name', 'Glycémie')->first();
				$reference = '';
				if ($service->ref_from == '' && $service->ref_to != '') {
					$reference = '('. $service->description .' <'. $service->ref_to .' '. $service->unit .')';
				}else if($service->ref_from != '' && $service->ref_to ==''){
					$reference = '('. $service->description .' '. $service->ref_from .'> '. $service->unit .')';
				}else if($service->ref_from != '' && $service->ref_to!=''){
					$reference = '('. $service->description .' '. $service->ref_from .'-'. $service->ref_to .' '. $service->unit .')';
				}else{
					$reference = '';
				}
				
				$checked_services_list .= '<tr class="labor_item" id="1-'.$service->id .'">
													<td class="text-center">1</td>
													<td>
														<input type="hidden" name="service_id[]" value="'. $service->id .'">
														<input type="hidden" name="service_name[]" value="'. $service->name .'">
														'. $service->name .'
													</td>
													<td>
														'. $service->category->name .'
													</td>
													<td class="text-center">
														<input type="text" name="result[]" value="'. $service->default_value .'" class="form-control">
													</td>
													<td class="text-center">
														<input type="hidden" name="unit[]" value="">
														'. $service->unit .'
													</td>
													<td class="text-center">
														<input type="hidden" name="reference[]" value="'. $reference .'">
														'. $reference .'
													</td>
													<td class="text-center sr-only">
														<button type="button" onclick="removeCheckedService(\'1'.$service->id .'\')" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
													</td>
												</tr>';
			}else{
				foreach ($labor_category->services as $jey => $service) {
					
					$reference = '';
					if ($service->ref_from == '' && $service->ref_to != '') {
						$reference = '('. $service->description .' <'. $service->ref_to .' '. $service->unit .')';
					}else if($service->ref_from != '' && $service->ref_to ==''){
						$reference = '('. $service->description .' '. $service->ref_from .'> '. $service->unit .')';
					}else if($service->ref_from != '' && $service->ref_to!=''){
						$reference = '('. $service->description .' '. $service->ref_from .'-'. $service->ref_to .' '. $service->unit .')';
					}else{
						$reference = '';
					}
					
					if ($service->unit == 'Negatif') {
						$checked_services_list .= '<tr class="labor_item" id="'. $jey.'-'.$service->id .'">
																				<td class="text-center">'. $jey .'</td>
																				<td>
																					<input type="hidden" name="service_id[]" value="'. $service->id .'">
																					<input type="hidden" name="service_name[]" value="'. $service->name .'">
																					'. $service->name .'
																				</td>
																				<td>
																					'. $service->category->name .'
																				</td>
																				<td class="text-center">
																					<select name="result[]" class="form-control">
																						<option value="Negatif">Negatif</option>
																						<option value="Positif">Positif</option>
																					</select>
																				</td>
																				<td class="text-center">
																					<input type="hidden" name="unit[]" value="">
																					
																				</td>
																				<td class="text-center">
																					<input type="hidden" name="reference[]" value="'. $reference .'">
																					'. $reference .'
																				</td>
																				<td class="text-center sr-only">
																					<button type="button" onclick="removeCheckedService(\''. $jey.'-'.$service->id .'\')" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
																				</td>
																			</tr>';
					}else{
						$checked_services_list .= '<tr class="labor_item" id="'. $jey.'-'.$service->id .'">
												<td class="text-center">'. $jey .'</td>
												<td>
													<input type="hidden" name="service_id[]" value="'. $service->id .'">
													<input type="hidden" name="service_name[]" value="'. $service->name .'">
													'. $service->name .'
												</td>
												<td>
													'. $service->category->name .'
												</td>
												<td class="text-center">
													<input type="text" name="result[]" value="'. $service->default_value .'" class="form-control">
												</td>
												<td class="text-center">
													<input type="hidden" name="unit[]" value="">
													'. $service->unit .'
												</td>
												<td class="text-center">
													<input type="hidden" name="reference[]" value="'. $reference .'">
													'. $reference .'
												</td>
												<td class="text-center sr-only">
													<button type="button" onclick="removeCheckedService(\''. $jey.'-'.$service->id .'\')" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
												</td>
											</tr>';
					}
		
				}
			}
		}

		return $checked_services_list;

	}

	public function getLaborDetail($id)
	{
		
		$labor_detail_list = '';
		$labor = Labor::find($id);
		$hematology = '';
		$biologie = '';
		$urine = '';
		$serologie = '';
		$blood_type = '';
		foreach ($labor->labor_details as $order => $labor_detail) {
			
			$reference = '';
			if ($labor_detail->service->ref_from == '' && $labor_detail->service->ref_to != '') {
				$reference = '(<'. $labor_detail->service->ref_to .' '. $labor_detail->service->unit .')';
			}else if($labor_detail->service->ref_from != '' && $labor_detail->service->ref_to ==''){
				$reference = '('. $labor_detail->service->ref_from .'> '. $labor_detail->service->unit .')';
			}else if($labor_detail->service->ref_from != '' && $labor_detail->service->ref_to!=''){
				$reference = '('. $labor_detail->service->ref_from .'-'. $labor_detail->service->ref_to .' '. $labor_detail->service->unit .')';
			}else{
				$reference = '';
			}

			if ($labor_detail->service->unit == 'Negatif') {
				$labor_detail_list .= '<tr class="labor_item" id="'. $labor_detail->result .'">
																<td class="text-center">'. ++$order .'</td>
																<td>
																	<input type="hidden" name="labor_detail_ids[]" value="'. $labor_detail->id .'">
																	'. $labor_detail->name .'
																</td>
																<td>
																	'. $labor_detail->service->category->name .'
																</td>
																<td class="text-center">
																	<select name="result[]" class="form-control">
																		<option value="Negatif" '. (($labor_detail->result=="Negatif")? 'selected' : '') .'>Negatif</option>
																		<option value="Positif" '. (($labor_detail->result=="Positif")? 'selected' : '') .'>Positif</option>
																	</select>
																</td>
																<td class="text-center">
																	<input type="hidden" name="unit[]" value="">

																</td>
																<td class="text-center">
																	'. $reference .'
																</td>
																<td class="text-center sr-only">
																	<button type="button" onclick="deleteLaborDetail(\''. $labor_detail->id .'\')" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
																</td>
															</tr>';
			}else{
				$labor_detail_list .= '<tr class="labor_item" id="'. $labor_detail->result .'">
																<td class="text-center">'. ++$order .'</td>
																<td>
																	<input type="hidden" name="labor_detail_ids[]" value="'. $labor_detail->id .'">
																	'. $labor_detail->name .'
																</td>
																<td>
																	'. $labor_detail->service->category->name .'
																</td>
																<td class="text-center">
																	<input type="text" name="result[]" value="'. $labor_detail->result .'" class="form-control"/>
																</td>
																<td class="text-center">
																	<input type="hidden" name="unit[]" value="">
																	'. $labor_detail->service->unit .'
																</td>
																<td class="text-center">
																	'. $reference .'
																</td>
																<td class="text-center sr-only">
																	<button type="button" onclick="deleteLaborDetail(\''. $labor_detail->id .'\')" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
																</td>
															</tr>';
			}

		}

		return $labor_detail_list;
	}

	public function storeAndGetLaborDetail($request)
	{

		$labor = Labor::find($request->labor_id);
		$labor_services = LaborService::select(DB::raw("id, name, category_id, unit, description, CONCAT(`ref_from`,' - ',`ref_to`) AS reference"))->whereIn('id', $request->service_ids)->get();
		foreach ($labor_services as $key => $service) {
			LaborDetail::create([
				'name' => $service->name,
				'unit' => '',
				'service_id' => $service->id,
				'labor_id' => $labor->id,
				'created_by' => Auth::user()->id,
				'updated_by' => Auth::user()->id,
			]);
		}


		$json = $this->getLaborPreview($request->labor_id)->getData();

		return response()->json([
			'labor_detail_list' => $this->getLaborDetail($request->labor_id),
			'labor_preview' => $json->labor_detail,
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
		$GlobalComponent = new GlobalComponent;

		$no = 1;
		$total = 0;
		$total_discount = 0;
		$grand_total = 0;
		$labor_detail = '';
		$labor_detail_item_list = '';
		$labor = Labor::find($id);

		$title = 'Labor ('. str_pad($labor->labor_number, 6, "0", STR_PAD_LEFT) .')';

		
		if ($labor->type == 'glycemia') {
			$glycemia ='';
			foreach ($labor->labor_details as $jey => $labor_detail) {
				$reference = $labor_detail->service->ref_from .'-'.  $labor_detail->service->ref_to;
				
				$reference = '';
				if ($labor_detail->service->ref_from == '' && $labor_detail->service->ref_to != '') {
					$reference = '('. $labor_detail->service->description .' <'. $labor_detail->service->ref_to .' '. $labor_detail->service->unit .')';
				}else if($labor_detail->service->ref_from != '' && $labor_detail->service->ref_to ==''){
					$reference = '('. $labor_detail->service->description .' '. $labor_detail->service->ref_from .'> '. $labor_detail->service->unit .')';
				}else if($labor_detail->service->ref_from != '' && $labor_detail->service->ref_to!=''){
					$reference = '('. $labor_detail->service->description .' '. $labor_detail->service->ref_from .'-'. $labor_detail->service->ref_to .' '. $labor_detail->service->unit .')';
				}else{
					$reference = '';
				}

				$class = '';
				if ($labor_detail->result < $labor_detail->service->ref_from) {
					$class = 'color_green';
				}else if ($labor_detail->result > $labor_detail->service->ref_to) {
					$class = 'color_red';
				}
				
				if ($labor_detail->result== 'positif' || $labor_detail->result== 'Positif' || $labor_detail->result== 'POSITIF') {
					$class = 'color_red';
				}

				$glycemia .= '<tr>
					<td width="25%" style="padding: 6px 0 6px 0.5cm;">- '. $labor_detail->name .'</td>
					<td width="25%" class="'. $class .'">: '. $labor_detail->result .'</td>
					<td width="25%">'. (($labor_detail->service->unit=='Negatif')? '' : $labor_detail->service->unit.' ' ) .'</td>
					<td width="25%">'. $reference .'</td>
				</tr>';
			}
			
			$labor_detail_item_list = '<div style="padding: 0 1.3cm;">
																	<table width="100%">
																		<tr>
																			<td colspan="4"> <b style="text-decoration:underline;">BIO-CHIMIE</b></td>
																		</tr>
																		'. $glycemia .'
																	</table>	
																</div>';
		
		}else if ($labor->type == 'labor-bio') {
			$bio ='';
			$bio_bottom ='';
			foreach ($labor->labor_details as $jey => $labor_detail) {
				$reference = $labor_detail->service->ref_from .'-'.  $labor_detail->service->ref_to;
				
				$reference = '';
				if ($labor_detail->service->ref_from == '' && $labor_detail->service->ref_to != '') {
					$reference = '('. $labor_detail->service->description .' <'. $labor_detail->service->ref_to .' '. $labor_detail->service->unit .')';
				}else if($labor_detail->service->ref_from != '' && $labor_detail->service->ref_to ==''){
					$reference = '('. $labor_detail->service->description .' '. $labor_detail->service->ref_from .'> '. $labor_detail->service->unit .')';
				}else if($labor_detail->service->ref_from != '' && $labor_detail->service->ref_to!=''){
					$reference = '('. $labor_detail->service->description .' '. $labor_detail->service->ref_from .'-'. $labor_detail->service->ref_to .' '. $labor_detail->service->unit .')';
				}else{
					$reference = '';
				}

				$class = '';
				if ($labor_detail->service->ref_from == '' || $labor_detail->service->ref_to == '') {

					if ($labor_detail->result== 'positif' || $labor_detail->result== 'Positif' || $labor_detail->result== 'POSITIF') {
						$class = 'color_red';
					}

				}else{

					if ($labor_detail->result < $labor_detail->service->ref_from) {
						$class = 'color_green';
					}else if ($labor_detail->result > $labor_detail->service->ref_to) {
						$class = 'color_red';
					}

				}

				if ($labor_detail->name == 'Helicobacter pylori' || $labor_detail->name == 'BP' || $labor_detail->name == 'PR' || $labor_detail->name == 'SP02') {
					$bio_bottom .= '<tr>
														<td width="35%" style="padding: 6px 0.5cm 6px 0;"> '. $labor_detail->name .' : <span class="'. $class .'">'. $labor_detail->result .'</span> '. (($labor_detail->service->unit=='Negatif')? '' : $labor_detail->service->unit.' ' ) . $reference .'</td>
													</tr>';
				}else{
					$bio .= '<tr>
										<td width="35%" style="padding: 6px 0 6px 0.5cm;">- '. $labor_detail->name .'</td>
										<td width="20%" class="'. $class .'">: '. $labor_detail->result .'</td>
										<td width="15%">'. (($labor_detail->service->unit=='Negatif')? '' : $labor_detail->service->unit.' ' ) .'</td>
										<td width="30%">'. $reference .'</td>
									</tr>';
				}

			}
			
			$labor_detail_item_list = '<div style="padding: 0 1.3cm;">
																	<table width="100%">
																		<tr>
																			<td colspan="4"> <b style="text-decoration:underline;">BIO-CHIMIE</b></td>
																		</tr>
																		'. $bio .'
																	</table>	
																</div>
																<br/>
																<br/>
																<br/>
																<div style="padding: 0 0.8cm;">
																	<table width="100%">
																		'. $bio_bottom .'
																	</table>	
																</div>';

		}else if ($labor->type == 'serologie') {
			$serologie ='';
			$transaminase ='';
			foreach ($labor->labor_details as $jey => $labor_detail) {
				$reference = $labor_detail->service->ref_from .'-'.  $labor_detail->service->ref_to;
				
				$reference = '';
				if ($labor_detail->service->ref_from == '' && $labor_detail->service->ref_to != '') {
					$reference = '('. $labor_detail->service->description .' <'. $labor_detail->service->ref_to .' '. $labor_detail->service->unit .')';
				}else if($labor_detail->service->ref_from != '' && $labor_detail->service->ref_to ==''){
					$reference = '('. $labor_detail->service->description .' '. $labor_detail->service->ref_from .'> '. $labor_detail->service->unit .')';
				}else if($labor_detail->service->ref_from != '' && $labor_detail->service->ref_to!=''){
					$reference = '('. $labor_detail->service->description .' '. $labor_detail->service->ref_from .'-'. $labor_detail->service->ref_to .' '. $labor_detail->service->unit .')';
				}else{
					$reference = '';
				}

				$class = '';
				if ($labor_detail->service->ref_from == '' || $labor_detail->service->ref_to == '') {

					if ($labor_detail->result== 'positif' || $labor_detail->result== 'Positif' || $labor_detail->result== 'POSITIF') {
						$class = 'color_red';
					}

				}else{

					if ($labor_detail->result < $labor_detail->service->ref_from) {
						$class = 'color_green';
					}else if ($labor_detail->result > $labor_detail->service->ref_to) {
						$class = 'color_red';
					}

				}

				if ($labor_detail->service->category->name == 'SEROLOGIE') {
					$serologie .= '<tr>
										<td width="25%" style="padding: 6px 0 6px 0.5cm;">- '. $labor_detail->name .'</td>
										<td width="20%" class="'. $class .'">: '. $labor_detail->result .'</td>
										<td width="15%">'. (($labor_detail->service->unit=='Negatif')? '' : $labor_detail->service->unit.' ' ) .'</td>
										<td width="40%">'. $reference .'</td>
									</tr>';
				}else{
					$transaminase .= '<tr>
										<td width="25%" style="padding: 6px 0 6px 0.5cm;">- '. $labor_detail->name .'</td>
										<td width="20%" class="'. $class .'">: '. $labor_detail->result .'</td>
										<td width="15%">'. (($labor_detail->service->unit=='Negatif')? '' : $labor_detail->service->unit.' ' ) .'</td>
										<td width="40%">'. $reference .'</td>
									</tr>';
				}

			}
			
			$labor_detail_item_list = '<div style="padding: 0 1.3cm;">
																	<table width="100%">
																		<tr>
																			<td colspan="4"> <b style="text-decoration:underline;">SEROLOGIE</b></td>
																		</tr>
																		'. $serologie .'
																		<tr>
																			<td colspan="4" style="padding-top: 20px;"> <b style="text-decoration:underline;">TRANSAMINASE</b></td>
																		</tr>
																		'. $transaminase .'
																	</table>	
																</div>';
		
		}else if ($labor->type == 'urine') {
			$urine ='';
			foreach ($labor->labor_details as $jey => $labor_detail) {
				
				$class = '';
				if (str_contains($labor_detail->result, '+') || $labor_detail->result == '7.5' || $labor_detail->result == '1.010') {
					$class = 'color_red';
				}

				$urine .= '<tr>
										<td width="13%" style="padding: 6px 0 6px 0.5cm;">- '. $labor_detail->name .'</td>
										<td>: ( <span class="'. $class .'">'. $labor_detail->result .'</span> )</td>
									</tr>';
			}
			
			$labor_detail_item_list = '<div style="padding: 0 1.3cm;">
																	<table width="100%">
																		<tr>
																			<td colspan="4"> <b style="text-decoration:underline;">URINE</b></td>
																		</tr>
																		'. $urine .'
																	</table>	
																</div>';
		
		}

		$labor_detail = '<section class="labor-print" style="position: relative;">
			' . $GlobalComponent->PrintHeader('labor', $labor) . '
			
			'. $labor_detail_item_list .'

			<small class="remark">'. $labor->remark .'</small>
			
			' . $GlobalComponent->FooterComeBackText('សូមយកលទ្ធផលពិនិត្យឈាមនេះមកវិញពេលមកពិនិត្យលើកក្រោយ') . '
			<table width="100%">
				<tr>
					<td></td>
					<td width="28%" class="text-center">
						' . $GlobalComponent->DoctorSignature() . '
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

	public function create($request, $type)
	{
		$patient_id = GlobalComponent::GetPatientIdOrCreate($request);
		
		$labor = Labor::create([
			'date' => $request->date,
			'labor_number' => $request->labor_number,
			'pt_no' => str_pad($patient_id, 6, "0", STR_PAD_LEFT),
			'pt_age' => $request->pt_age,
			'pt_age_type' => $request->pt_age_type ?: '1',
			'pt_name' => $request->pt_name,
			'pt_gender' => $request->pt_gender,
			'pt_phone' => $request->pt_phone,
			'pt_village' => $request->pt_village,
			'pt_commune' => $request->pt_commune,
			'pt_district_id' => $request->pt_district_id,
			'pt_province_id' => $request->pt_province_id,
			'price' => $request->price ?: 0,
			'type' => $type,
			'labor_type' => $request->labor_type ?: 1,
			'simple_labor_detail' => $request->simple_labor_detail ?: '',
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
						'unit' => $request->unit[$i],
						'service_id' => $request->service_id[$i],
						'labor_id' => $labor->id,
						'created_by' => Auth::user()->id,
						'updated_by' => Auth::user()->id,
					]);
			}
		}

		return $labor;
	}

	public function update($request, $type, $labor)
	{
		// dd($request->all());
		$labor->update([
			'date' => $request->date,
			'pt_age' => $request->pt_age,
			'pt_age_type' => $request->pt_age_type ?: '1',
			'pt_name' => $request->pt_name,
			'pt_gender' => $request->pt_gender,
			'pt_phone' => $request->pt_phone,
			'pt_village' => $request->pt_village,
			'pt_commune' => $request->pt_commune,
			'pt_district_id' => $request->pt_district_id,
			'pt_province_id' => $request->pt_province_id,
			'price' => $request->price ?: 0,
			'type' => $type,
			'simple_labor_detail' => $request->simple_labor_detail ?: '',
			'remark' => $request->remark,
			'updated_by' => Auth::user()->id,
		]);
		if (isset($request->labor_detail_ids)) {
			for ($i = 0; $i < count($request->labor_detail_ids); $i++) {
				LaborDetail::find($request->labor_detail_ids[$i])->update([
																														'result' => $request->result[$i],
																														'unit' => $request->unit[$i],
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
																	<input type="text" name="result[]" value="'. $labor_detail->result .'" class="form-control"/>
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
			'labor_detail_list' => $this->getLaborDetail($labor_id),
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
