<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\PostContent;
use App\Http\Requests\StoreBlogPost;
use App\Http\Requests\UpdateBlogPost;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function index(Request $request, Post $post, Tag $tag)
    {
        //$dataPost = DB::table('posts')->get();
  
    	// do du lieu tu controller ra view
    	$name = "LPHP1903E";
    	$data = [];
    	$data['myName'] = $name;
    	$data['age'] = 20;
    	$data['address'] = 'Ha Noi';
        $data['createPostSuccess'] = $request->session()->get('createPostSuccess');

        // keyword
        $keyword = $request->keyword;
        $keyword = strip_tags($keyword);
        $data['keyword'] = $keyword;

        $lstPosts = $post->getAllDataPosts($keyword);
        $data['paginate'] = $lstPosts;
        
        $lstPosts = json_decode(json_encode($lstPosts),true);
        $lstPosts = $lstPosts['data'] ?? [];

        $lstTags = $tag->getDataTagByPost();

        // gan tags vao bai viet
        foreach($lstPosts as $key => $val){
            $lstPosts[$key]['lstTags'] = [];
            foreach($lstTags as $k => $item){
                if($val['id'] == $item['post_id']){
                    $lstPosts[$key]['lstTags'][] = $item['name_tag'];
                }
            }
        }
        $data['lstPosts'] = $lstPosts;

    	return view('admin.posts.index', $data);
    }

    public function createPost(Category $cate, Tag $tag, Request $request)
    {
        $data = [];
        $data['cates'] = $cate->getAllDataCategories();
        $data['tags'] = $tag->getAllDataTags();
        $data['errorPublisDate'] = $request->session()->get('errorPublisDate');
        $data['errorAvatar'] = $request->session()->get('errorAvatar');
        return view('admin.posts.create', $data );
    }

    public function handleCreatePost(StoreBlogPost $request, Post $post, PostContent $pContent)
    {
        $title = $request->titlePost;
        $slug  = Str::slug($title, '-');
        $sapo  = $request->sapoPost;
        $contentPost = $request->contentPost;
        $languagePost = $request->languagePost;
        $category = $request->catePost;
        $tags = $request->tagsPost;
        

        // publish date
        $publishDate = $request->publishDate;
        // kiem tra publish date : no phai khong duoc nho hon thoi gian hien tai
        if($publishDate){
            // thuc su admin chon ngay xuat ban
            $today = date('Y-m-d H:i:s');
            $timePublishDate = strtotime($publishDate);
            $timeToday = strtotime($today);
            if($timePublishDate < $timeToday){
                // sai - bao loi chon lai
                $request->session()->flash('errorPublisDate', 'Ngay xuat ban khong duoc nho hon ngay hien tai');
                // quay lai form tao bai viet
                return redirect()->route('admin.createPost');
            }
            $publishDate = date('Y-m-d H:i:s',strtotime($publishDate));
        }

        // Upload file
        /*
        if(isset($_FILES['avatarPost'])){
            //dd($_FILES['avatarPost']);
            //
            if($_FILES['avatarPost']['error'] == 0){
                $fileName = $_FILES['avatarPost']['name'];
                $tmpName  = $_FILES['avatarPost']['tmp_name'];
                $up = move_uploaded_file($tmpName, public_path() . '/upload/images/' . $fileName);
                if(!$up){
                    $request->session()->flash('errorAvatar', 'Khong upload dc anh len server');
                    // quay lai form tao bai viet
                    return redirect()->route('admin.createPost');
                }
            }
        }
        */
        
        if ($request->hasFile('avatarPost')) {
            // kiem tra xem nguoi dung chon file hay chua
            // kiem tra xem file co loi gi ko?
            if ($request->file('avatarPost')->isValid()) {
                // lay thong tin cua file
                $file = $request->file('avatarPost');
                
                // lay ten file
                $nameFile = $file->getClientOriginalName();
                // uplaod file
                $up = $file->move('upload/images', $nameFile);
                if(!$up){
                    $request->session()->flash('errorAvatar', 'Khong upload dc anh len server');
                    // quay lai form tao bai viet
                    return redirect()->route('admin.createPost');
                }
            }
        }
    

        // insert data to posts table
        $dataInsert = [
            'title' => $title,
            'slug' => $slug,
            'sapo' => $sapo,
            'categories_id' => $category,
            'publish_date' => $publishDate,
            'avatar' => $nameFile,
            'admins_id' => $request->session()->get('idSession'),
            'count_view' => 0,
            'lang_id' => $languagePost,
            'status' => 1, // 0 bi xoa - 1 dang ton tai
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null
        ];
        $idPost = $post->insertDataPost($dataInsert);
        if($idPost > 0){
            // insert data to post content table
            $postContentData = [
                'posts_id' => $idPost,
                'content_web' => $contentPost,
                'content_mobile' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null
            ];
            $contentInsert = $pContent->insertDataContentPost($postContentData);
            // insert vao bang post tag
            if($contentInsert){
                if(!empty($tags)){
                    foreach ($tags as $key => $idTag) {
                        DB::table('post_tag')->insert([
                            'posts_id' => $idPost,
                            'tags_id' => $idTag,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => null
                        ]);
                    }
                }
                // quay ve trang list bai viet
                $request->session()->flash('createPostSuccess', 'Tao bai viet thanh cong');
                return redirect()->route('admin.posts');
            } else {
               $request->session()->flash('errorAddPostContent', 'them du lieu vao bang post content bi loi');
                // quay lai form tao bai viet
                return redirect()->route('admin.createPost'); 
            }
        } else {
            $request->session()->flash('errorCreate', 'Tao bai viet bi loi, vui long kiem tra lai');
            // quay lai form tao bai viet
            return redirect()->route('admin.createPost');
        }
    }

    public function deletePost(Request $request, Post $post)
    {
        $id = $request->id;
        $id = is_numeric($id) ? $id : 0;
        if($id > 0){
            $del = $post->deletePostById($id);
            if($del){
                echo "ok";
            } else {
                echo "fail";
            }
        } else {
            echo "err";
        }
    }

    public function edit($slug, $id, Post $post, Category $cate, Tag $tag)
    {
        $id = is_numeric($id) ? $id : 0;
        $infoPost = $post->getInfoDatPostById($id);

        if($infoPost){
            $data = [];
            $data['cates'] = $cate->getAllDataCategories();
            $data['tags']  = $tag->getAllDataTags();

            // lay ra tat ca tag id thuoc bai viet nay
            $lstTags = $tag->getDataTagByPost();
            $arrIdTag = [];
            foreach($lstTags as $key => $item){
                if($item['post_id'] == $id){
                    $arrIdTag[] = $item['id'];
                }
            }

            $data['arrIdTag'] = $arrIdTag;
            $data['info']  = $infoPost;

            return view('admin.posts.edit', $data);
        } else {
            abort(404);
        }
    }

    public function hanleUpdate(UpdateBlogPost $request, Post $post, PostContent $pContent, Tag $tag)
    {
        $title = $request->titlePost;
        $slug  = Str::slug($title, '-');
        $sapo  = $request->sapoPost;
        $contentPost = $request->contentPost;
        $languagePost = $request->languagePost;
        $category = $request->catePost;
        $tags = $request->tagsPost;
        $status = $request->statusPost;
        $status = in_array($status, ['0','1']) ? $status : 0;

        $idPost = $request->id;
        $idPost = is_numeric($idPost) ? $idPost : 0;
        $infoPost = $post->getInfoDatPostById($idPost);
        $oldPublisDate = $infoPost['publish_date'];

        // publish date
        $publishDate = $request->publishDate;
        // kiem tra publish date : no phai khong duoc nho hon thoi gian hien tai
        if($publishDate){
            // so sanh publishDate ma nguoi dung gui len voi oldPublisDate trong database, neu no giong nhau chung to nguoi dung khong thay doi ngay xuat ban => khong kiem tra, nguoc lai moi kiem tra
             
            // thuc su admin chon ngay xuat ban
            $today = date('Y-m-d H:i:s');
            $timePublishDate = strtotime($publishDate);
            $timeToday = strtotime($today);
            $timeOldPublisdate = strtotime($oldPublisDate);

            if($timePublishDate != $timeOldPublisdate){

                if($timePublishDate < $timeToday){
                    // sai - bao loi chon lai
                    $request->session()->flash('errorPublisDate', 'Ngay xuat ban khong duoc nho hon ngay hien tai');
                    // quay lai form tao bai viet
                    return redirect()->route('admin.createPost');
                } else {
                    $oldPublisDate = $publishDate;
                }
            }
        } 

        // validate title : khong duoc update title da ton tai trong db loai tru title dang xem 
        $validator = Validator::make( 
            ['titlePost' => $title], 
            ['titlePost' => 'unique:posts,title,'.$idPost],
            ['unique' => 'title da ton tai']
        );

        if ($validator->fails()) {
            return redirect()->route('admin.editPost',['slug'=>$slug,'id' => $idPost])
                    ->withErrors($validator)
                    ->withInput();
        } else {
            // validate image avatar
            $oldAvatar = $infoPost['avatar'];
            if ($request->hasFile('avatarPost')) {
                // chung to co thay anh avatar
                // validate anh
                if ($request->file('avatarPost')->isValid()) {
                    $validatorAvatar = Validator::make( 
                        ['avatarPost' => $request->file('avatarPost')], 
                        ['avatarPost' => 'required|mimes:jpeg,bmp,png,jpg,gif'],
                        [
                            'required' => 'vu long chon anh', 
                            'mimes' => 'Dinh dang anh avatar khong dung, chi cho phep la cac anh jpeg,bmp,png,jpg,gif'
                        ]
                    );

                    if ($validatorAvatar->fails()) {
                        return redirect()->route('admin.editPost',['slug'=>$slug,'id' => $idPost])
                                ->withErrors($validatorAvatar)
                                ->withInput();
                    } else {
                        // thuc su moi upload anh
                        // lay thong tin cua file
                        $file = $request->file('avatarPost');
                        // lay ten file
                        $oldAvatar = $file->getClientOriginalName();
                        // uplaod file
                        $up = $file->move('upload/images', $oldAvatar);
                        if(!$up){
                            $request->session()->flash('errorAvatar', 'Khong upload dc anh len server');
                            // quay lai form tao bai viet
                            return redirect()->route('admin.createPost');
                        }
                    }
                }
            }

            // cac buoc update du lieu
            // 1 - update vao bang post
            $dataUpdate = [
                'title' => $title,
                'slug' => $slug,
                'sapo' => $sapo,
                'categories_id' => $category,
                'publish_date' => date('Y-m-d H:i:s',strtotime($oldPublisDate)),
                'avatar' => $oldAvatar,
                'lang_id' => $languagePost,
                'status' => $status,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $update = $post->updateDataPostById($dataUpdate, $idPost);
            if($update){
                // tiep tuc update content
                $updateContent = [
                    'content_web' => $contentPost
                ];
                $upV2 = $pContent->updateDataContentPostById($updateContent, $idPost);

                // xoa het du lieu trong bang post tag theo post id
                // sau do inset lai du lieu tags vua chon
                // chi thuc hien khi thuc su nguoi dung chon lai tag
                
                // lay ra tat ca tag id thuoc bai viet nay
                $lstTags = $tag->getDataTagByPost();
                $arrIdTag = [];
                foreach($lstTags as $key => $item){
                    if($item['post_id'] == $idPost){
                        $arrIdTag[] = $item['id'];
                    }
                }

                // check arrIdTag neu khac tags thi moi update tag
                $flagCheck = false;
                foreach($arrIdTag as $i) {
                    foreach($tags as $j){
                        if($i != $j){
                            $flagCheck = true;
                            break;
                        }
                    }
                }
                
                if($flagCheck) {
                    $del = DB::table('post_tag')
                            ->where('posts_id', $idPost)
                            ->delete();
                    if(!empty($tags) && $del){
                        foreach ($tags as $key => $idTag) {
                            DB::table('post_tag')->insert([
                                'posts_id' => $idPost,
                                'tags_id' => $idTag,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => null
                            ]);
                        }
                    }
                }

                // quay ve trang list bai viet
                $request->session()->flash('updatePostSuccess', 'Sua bai viet thanh cong');
                return redirect()->route('admin.posts');

            } else {
                $request->session()->flash('errorUpdatePost', 'Sua bai viet bi loi, vui long kiem tra lai');
                // quay lai form chinh sua bai viet
                return redirect()->route('admin.editPost',['slug'=>$slug,'id' => $idPost]);
            }

        }
    }
}












