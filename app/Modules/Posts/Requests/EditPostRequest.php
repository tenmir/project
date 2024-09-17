<?php

namespace App\Modules\Posts\Requests;

use App\Modules\User\Dto\AddCompanyDto;
use Illuminate\Foundation\Http\FormRequest;

class EditPostRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'id'          => 'required',
			'title'       => 'required|string|max:150',
			'description' => 'required|string|max:255',
			'picture'     => 'required',
		];
	}

	public function getDto(): AddCompanyDto
	{
		return new AddCompanyDto(
			$this->get('title'),
			$this->get('inn'),
			$this->get('contact_name'),
			$this->get('correspondent_account'),
			$this->get('payment_account'),
			$this->get('bank_name'),
			$this->get('general_manager'),
			$this->get('orgnip'),
			$this->get('bik'),
			$this->get('kpp'),
			$this->get('legal_address')
		);
	}
}
