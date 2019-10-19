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
use Illuminate\Support\Str;

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
        $lstPosts = $post->getAllDataPosts();
        $lstPosts = json_decode(json_encode($lstPosts),true);
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
}












