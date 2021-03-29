<?php

namespace App\Repositories\Component;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Auth;

class GlobalComponent extends Controller
{	
	protected $logo;
	protected $clinic_name_kh;
	protected $clinic_name_en;
	protected $description;
	protected $address;
	protected $phone;
	protected $sign_name_kh;
	protected $sign_name_en;
	protected $echo_description;
	protected $echo_address;
	protected $unique_clinic_name;

	public function __construct() {
		$setting_obj =  Auth::user()->setting();
		
		$this->unique_clinic_name = trim(strtoupper(Auth::user()->roles->first()->name));
		foreach (['logo', 'clinic_name_kh', 'clinic_name_en', 'description', 'address', 'phone', 'sign_name_kh', 'sign_name_en', 'echo_description', 'echo_address'] as $obj_member) {
			$this->{$obj_member} = $setting_obj->{$obj_member};
		}
		
	}

	public function PrintHeader($module = 'invoice', $object = null)
	{
		$html_header = '';
		$title_module = ($module == 'invoice' ? 'វិក្កយបត្រ' : ($module == 'prescription' ? 'វេជ្ជបញ្ជា' : ($module == 'labor' ? 'ប័ណ្ណវិភាគវេជ្ជសាស្រ្ត' : '_______________')));
		$number = ($module == 'invoice' ? 'inv_number' : ($module == 'prescription' ? 'code' : ($module == 'labor' ? 'labor_number' : 'number')));
		// Top Header
		if ($module == 'echo') {
			if ($object->echo_default_description->slug == 'letter-form-the-hospital') {
				$html_header .= '
					<div class="KHOSMoulLight text-center" style=="font-size: 16px;">ព្រះរាជាណាចក្រកម្ពុជា</div>
					<div class="KHOSMoulLight text-center" style=="font-size: 16px;">ជាតិ   សាសនា    ព្រះមហាក្សត្រ</div>
					<table class="table-header" width="100%">
						<tr>
							<td  width="30%" class="text-center">
								<div style="width: 3cm; height: 3cm; margin: 0 auto;"><img src="/images/setting/logo.png" alt="IMG"></div>
								<div class="KHOSMoulLight" style="padding: 5px 0;">មន្ទីសុខាភិបាលខេត្តកំពង់ចាម</div>
								<div class="KHOSMoulLight">'. $this->clinic_name_kh .'</div>
							</td>
							<td width="30%" class="text-center">
							</td>
							<td width="40%" class="text-center">
								<br/>
								<div>'. $this->address .'</div>
								<div style="padding: 5px 0;">Tel: '. $this->phone .'</div>
							</td>
						</tr>
					</table>
				';
			} else {
				$html_header .= '
					<table class="table-header" width="100%">
						<tr>
							<td width="40%">
								<div class="KHOSMoulLight"style="color: red;">'. $this->sign_name_kh .'</div>
								<div style="color: blue; font-weight: bold; text-transform: uppercase; padding: 5px 0;">'. $this->sign_name_en .'</div>
								<div>'. $this->echo_description .'</div>
							</td>
							<td  width="20%">
								<img src="/images/setting/logo.png" alt="IMG">
							</td>
							<td width="40%" class="text-center">
								<div>'. $this->echo_address .'</div>
								<div style="padding: 5px 0;">Tel: '. $this->phone .'</div>
							</td>
						</tr>
					</table>
				';
			}
		} else {
			$html_header .= '		
				<table class="table-header" width="100%">
					<tr>					
						<td rowspan="2" width="130px">
							<img src="/images/setting/logo.png" alt="IMG">
						</td>
						<td class="text-center">
							<div style="font-size: 35px;" class="color_blue KHOSMoulLight">' . $this->clinic_name_kh . '</div>
						</td>
						<td rowspan="2" width="130px">
							<img src="/images/setting/logo.png" alt="IMG">
						</td>
					</tr>
					<tr>
						<td class="text-center">
							<div style="font-size: 18px;" class="color_green KHOSMoulLight">'. $this->clinic_name_en .'</div>
						</td>
					</tr>
					<tr>
						<td colspan="3" class="text-center" style="padding: 1px 0;">
							<div class="color_blue">'. $this->description .'</div>
						</td>
					</tr>
					<tr>
						<td colspan="3" class="text-center" style="padding: 1px 0;">
							<div class="color_blue">'. $this->address .'</div>
						</td>
					</tr>
					<tr>
						<td colspan="3" class="text-center" style="padding-bottom: 5px;">
							<div class="color_blue">លេខទូរស័ព្ទ: <b>'. $this->phone .'</b></div>
						</td>
					</tr>
				</table>
			';
		}
		// Sub Header
		if(empty($object)){ $object = new \stdClass(); }
		if(empty($object->province)){ $object->province = new \stdClass(); $object->province->name = ''; }
		if(empty($object->district)){ $object->district = new \stdClass(); $object->district->name = ''; }

		$html_header .= '
			<table class="table-information" width="100%" style="margin: 5px 0 15px 0;">
				<tr>
					<td colspan="4">
						<div class="color_red text-center KHOSMoulLight"  style="font-size: 18px; padding: 0 0 5px 0; text-decoration: underline;">' . $title_module . '</div>
					</td>
				</tr>
				<tr>
					<td width="35%" style="padding-left: 55px;">
						ឈ្មោះអ្នកជំងឺ: <span class="pt_name">'. ($object->pt_name ?? '') .'</span>
					</td>
					<td width="18%">
						អាយុ: <span class="pt_age">'. ($object->pt_age ?? '') . ' ' .  (($object->pt_age_type ? __('module.table.selection.age_type_' . $object->pt_age_type) : '')).'</span>
					</td>
					<td width="18%">
						ភេទ: <span class="pt_gender">'. ($object->pt_gender ?? '') .'</span>
					</td>
					<td width="25%" style="padding-left: 25px;">
						លេខកូដអ្នកជំងឺ: <span class="labor_number">'. str_pad(($object->$number ?? 0), 6, "0", STR_PAD_LEFT) .'</span>
					</td>
				</tr>
				<tr>
					<td colspan="4" style="padding-left: 55px;">
						អាសយដ្ឋាន: <span>'. (($object->pt_village!='')? 'ភូមិ'.$object->pt_village : '') . (($object->pt_commune!='')? (($object->province->name=='ភ្នំពេញ')? ' សង្កាត់'.$object->pt_commune : ' ឃុំ'.$object->pt_commune) : '') . (($object->district->name!='')? (($object->province->name=='ភ្នំពេញ')? ' ខណ្ឌ'.$object->district->name : ' ស្រុក'.$object->district->name) : ''). (($object->province->name!='')? (($object->province->name=='ភ្នំពេញ')? ' រាជធានីភ្នំពេញ'.$object->province->name : ' ខេត្ត'.$object->province->name) : '') .'</span>
					</td>
				</tr>
				'.(($module == 'labor')?
						'<tr>
							<td colspan="4">
								<div class="text-center KHOSMoulLight"  style="font-size: 18px; padding: 0 0 5px 0; text-decoration: underline;">លទ្ធផលពិនិត្យ</div>
							</td>
						</tr>'
					: '').'
			</table>
		';
		return $html_header;		
	}

	public static function DoctorSignature($doctor_name = '', $title_signature = 'គ្រូពេទ្យព្យាបាល')
	{
		return "
		<div class='text-center' style='position: absolute; right: 30px; bottom: 1.5cm;'>
				<div class='KHOSMoulLight'>$title_signature</div>
				<div class='sign_box'></div>
				<div><span class='KHOSMoulLight'>វេជ្ជបណ្ឌិត. " . ($doctor_name ?: Auth::user()->setting()->sign_name_kh) . "</span></div>
			</div>
		";
	}

	public function FooterComeBackText($text = '', $color = 'color_red')
	{
		// $html_footer_comeback ="
		// 											<div class='color_light_blue' style=' text-align: center; position: absolute; bottom: 0.4cm; left: 0; width: 100%; padding: 0 0.8cm;'>
		// 												<div style=' border-top: 2px solid #0070C0; padding-top: 10px;'>
		// 													<span class='KHOSMoulLight'>កំណត់ចំណាំ:</span> " . ($text ?: 'សូមយកវេជ្ជបញ្ជាមកវិញពេលមកពិនិត្យលើក្រោយ') . "
		// 												</div>
		// 											</div>
		// 										";
		$html_footer_comeback ="";
		return $html_footer_comeback;
	}

	public static function GetPatientIdOrCreate($request)
	{	
		$patient_id = 0;	
		$patient_name = trim($request->pt_name);
		if (!empty($patient_name)) {
			$patient = Patient::where('name', $patient_name)->first();

			if ($patient != null) {
				$patient_id = $patient->id;
			} else {
				$created_patient = Patient::create([
					'name' => $patient_name,
					'age' => $request->pt_age ?? '0',
					'age_type' => $request->pt_age_type ?: '1',
					'gender' => (($request->pt_gender == 'ប្រុស' || strtolower(trim($request->pt_gender)) == 'male') ? '1' : '2'),
					'phone' => $request->pt_phone ?? '',
					'address_village' => $request->pt_village ?? '',
					'address_commune' => $request->pt_commune ?? '',
					'address_district_id' => $request->pt_district_id ?? '',
					'address_province_id' => $request->pt_province_id ?? '',
					'created_by' => Auth::user()->id,
					'updated_by' => Auth::user()->id,
				]);
				$patient_id = $created_patient->id;
			}
		}
		
		return $patient_id;		
	}
}

/*
	How to use : 
		use App\Repositories\Component\GlobalComponent as GComponent;
		GComponent::FooterComeBackText('សូមយកលទ្ធផលពិនិត្យឈាមនេះមកវិញពេលមកពិនិត្យលើក្រោយ')
		GComponent::DoctorSignature()
*/
