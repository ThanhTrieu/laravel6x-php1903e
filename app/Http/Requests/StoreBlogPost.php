<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPost extends FormRequest
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
            'titlePost' => 'required|max:200|min:5|unique:posts,title',
            'sapoPost' => 'required|max:200|min:5',
            'avatarPost' => 'required|mimes:jpeg,bmp,png,jpg,gif',
            'languagePost' => 'required|numeric',
            'catePost' => 'required|numeric',
            'tagsPost' => 'required',
            'contentPost' => 'required|min:5'
        ];
    }

    public function messages()
    {
        return [
            'titlePost.required' => 'Vui long nhap tieu de bai viet',
            'titlePost.unique' => 'Tieu de bai viet da ton tai',
            'titlePost.max' => 'Tieu de bai viet khong lon hon :max ki tu',
            'titlePost.min' => 'Tieu de bai viet khong nho hon :min ki tu',
            'sapoPost.required' => 'Vui long nhap mieu ta bai viet',
            'sapoPost.max' => 'Mieu ta bai viet khong lon hon :max ki tu',
            'sapoPost.min' => 'Mieu ta bai viet khong nho hon :min ki tu',
            'avatarPost.required' => 'Vui long chon anh bai viet',
            'avatarPost.mimes' => 'Dinh dang anh avatar khong dung, chi cho phep la cac anh jpeg,bmp,png,jpg,gif',
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
