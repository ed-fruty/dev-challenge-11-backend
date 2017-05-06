<?php

namespace App\Common\Document\App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class GetDocumentListRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function hasStatus(): bool
    {
        return $this->has('status');
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->get('status');
    }
}