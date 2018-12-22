<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Item;
use Auth;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->route()->action['as'] == 'item.store'){
            return true;
        }else{
          $user = Auth::user();
          $item = Item::find($this->route('item'));
          return $user->can('update', $item);  
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:190',
            'qty' => 'required|numeric|max:999999999',
            'price' => 'required|numeric|max:999999',
            'manufacturer' => 'required',
            'model' => 'required',
            'date_of_purchased' => 'required|date'
        ];
    }

    public function getValidatorInstance()
    {
        $this->formatDateOfPurchased();
        
        return parent::getValidatorInstance();
    }

    protected function formatDateOfPurchased()
    {
        if($this->request->has('date_of_purchased')){
            $this->merge([
                'date_of_purchased' => date('Y-m-d',strtotime($this->request->get('date_of_purchased')))
            ]);
        }
    }

}
