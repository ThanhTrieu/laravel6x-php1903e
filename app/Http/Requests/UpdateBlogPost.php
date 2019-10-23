<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'titlePost' => 'required|max:200|min:5',
            'sapoPost' => 'required|max:200|min:5',
            'languagePost' => 'required|numeric',
            'catePost' => 'required|numeric',
            'tagsPost' => 'required',
            'contentPost' => 'required|min:5',
            'statusPost' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'statusPost.required' => 'Vui long chon trang thai bai viet',
            'statusPost.numeric' => 'loi trang thai bai viet',
            'titlePost.required' => 'Vui long nhap tieu de bai viet',
            'titlePost.max' => 'Tieu de bai viet khong lon hon :max ki tu',
            'titlePost.min' => 'Tieu de bai viet khong nho hon :min ki tu',
            'sapoPost.required' => 'Vui long nhap mieu ta bai viet',
            'sapoPost.max' => 'Mieu ta bai viet khong lon hon :max ki tu',
            'sapoPost.min' => 'Mieu ta bai viet khong nho hon :min ki tu',
            'languagePost.required' => 'Vui long chon ngon ngu bai viet',
            'languagePost.numeric' => 'ngon ngu ban chon khong duoc ho tro',
            'catePost.required' => 'Vui long chon danh muc bai viet',
            'catePost.numeric' => 'danh muc ban chon khong ton tai',
            'tagsPost.required' => 'Vui long chon Tags bai viet',
            'contentPost.required' => 'Vui long nhap noi dung bai viet',
            'contentPost.min' => 'Noi dung bai viet lon hon :min ki tu'
        ];
    }
}
