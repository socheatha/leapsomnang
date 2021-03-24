<?php

namespace App\Http\Controllers\Location;

use App\Models\FourLevelAddress;

class FourLevelAddressController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function BSSFullAddress($code = '08021103', $return_type = 'selection') {
		return array_map(function($length, $level) use ($code, $return_type) {			
			return $this->Platform($this->$level(substr($code, 0, $length - 2)), $return_type, substr($code, 0, $length));
		}, [2, 4, 6, 8], ['Province', 'District', 'Commune', 'Village']);
	}

	public function Province($code = null, $return_type = 'array')
	{
		return $this->Platform($this->Address(__FUNCTION__, $code), $return_type);
	}

	public function District($code = null, $return_type = 'array')
	{
		return $this->Platform($this->Address(__FUNCTION__, $code), $return_type);
	}

	public function Commune($code = null, $return_type = 'array')
	{
		return $this->Platform($this->Address(__FUNCTION__, $code), $return_type);
	}

	public function Village($code = null, $return_type = 'array')
	{
		return $this->Platform($this->Address(__FUNCTION__, $code), $return_type);
	}

	public function Address($level_type = 'Province', $code = null, $order_by = '_name_en')
	{
		$province = FourLevelAddress::where('_type_en', $level_type);
		if ($code) $province->where('_code', 'like',  $code . '%');
		return $province->orderBy($order_by)->limit(1000)->get()->toArray();
	}

	// array|selection|datalist
	public function Platform($address, $return_type = 'array', $selected = null)
	{
		if ($return_type == 'selection') {
			$html_elements = '<selection __ATTRIBUTES__>';
			foreach ($address as $addr) {
				$html_elements .= '<option ' . (($selected && $selected == $addr['_code']) ? 'selected' : '') . ' value="' . $addr['_code'] . '">' . $addr['_name_kh'] . '</option>';
			}
			$html_elements .= '</selection>';
			return $html_elements;
		} else if ($return_type == 'datalist') {
			$html_elements = '<datalist __ATTRIBUTES__>';
			foreach ($address as $addr) {
				$html_elements .= '<option value="' . $addr['_name_kh'] . '">' . $addr['_name_en'] . '</option>';
			}
			$html_elements .= '</datalist>';
			return $html_elements;
		}
		return $address;
	}
}
