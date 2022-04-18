<?php

namespace App\Repositories\SocialLinks;
use App\Models\User as UserModel;
use App\Models\SocialLinksModel;
use App\Models\CategoriesModel;
use App\Models\IndustriesModel;
use App\Models\VideosCastsModel;
use Auth;
use DataTables;

class SocialLinksRepositories
{
    public function __construct(UserModel $user,SocialLinksModel $social_links)
    {
        $this->UserModel          = $user;
        $this->SocialLinksModel   = $social_links;
    }
    public function index($request)
    {
        $userLink = $socialArr = [];
        $userData = Auth::user();
        if (isset($userData->social_urls) && $userData->social_urls != '') 
        {
            $userLink = json_decode($userData->social_urls);
            foreach ($userLink as $key => $value) 
            {
                $socialArr[$key] = $value;
            }
        }
        $arrLinks = $this->SocialLinksModel::get()->toArray();
        foreach ($arrLinks as $key => $value) 
        {
           $arrLinks[$key]['input_value'] = isset($socialArr[$value['input_name']])?$socialArr[$value['input_name']]:'';
        }
      
        $data['arrLinks']          = $arrLinks;
        $data['middleContent']    = 'admin/social_links/index';
        $data['pageTitle']        = 'Social links';
        return $data;
    }
    public function update($request)
    {
        $jsonArr = [];
        $result = '';
        $userData = Auth::user();
        $formData = $request->except(['_token']);

        foreach ($formData as $key => $value) 
        {
            if ($value != null) 
            {
                $jsonArr[$key] = $value;
            }
        }
        if (isset($jsonArr) && !empty($jsonArr)) 
        {
            $updateArr['social_urls'] = json_encode($jsonArr);
            $result = $this->UserModel->where('id',$userData->id)->update($updateArr);
        }
        return $result;
    }
}
