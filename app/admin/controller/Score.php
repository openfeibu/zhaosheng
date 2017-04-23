<?php
// +----------------------------------------------------------------------
// | YFCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015-2016 http://www.rainfer.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: rainfer <81818832@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\model\School as SchoolModel;
use app\admin\model\Major as MajorModel;
use app\admin\model\RecruitMajor as RecruitMajorModel;
use app\admin\model\Score as ScoreModel;
use think\Db;
use think\Cache;

class Score extends Base
{
    public function score_list()
    {
        $admin=Db::name('admin')->alias("a")->join(config('database.prefix').'auth_group_access b','a.admin_id =b.uid')
					->join(config('database.prefix').'auth_group c','b.group_id = c.id')
					->where(array('a.admin_id'=>session('admin_auth.aid')))
					->find();

		$score_list = Db::name('major_score')->alias("ms")
						->join(config('database.prefix').'member_list m','m.member_list_id = ms.member_list_id')
                        ->join(config('database.prefix').'major mj','mj.major_id = m.major_id')
						->where(array('m.major_id' => $admin['major_id']))
                        ->order('m.member_list_id desc')
						->field('ms.major_score, ms.major_score_id,ms.major_score_status,m.member_list_nickname , m.member_list_username, m.member_list_id,mj.score as major_score_key')
						->order('major_score_id desc')->paginate(config('paginate.list_rows'),false,['query'=>get_query()]);

		$data = $score_list->all();
		$status = config("status");

		foreach($data as $key => $val)
		{
            $major_score_key =array_filter(json_decode($val['major_score_key'],true));
            $major_score_arr = json_decode($val['major_score'],true);
            $major_score_arr = handle_major_score_arr($major_score_key,$major_score_arr);
            $data[$key]['major_score_arr'] = $major_score_arr;
			$data[$key]['status_desc'] = $val['major_score_status'] == 2 ? "<span class='red'>" . $status[$val['major_score_status']] ."</span>" : $status[$val['major_score_status']];
		}

		$page = $score_list->render();
		$major = Db::name('major')->where(array('major_id' => $admin['major_id']))->find();
        $major_score = json_decode($major['score'],true);
		$major_score = array_filter($major_score);
		$this->assign('major_score',$major_score);
		$this->assign('data',$data);
		$this->assign('page',$page);
        return $this->fetch();
    }
	 public function score_all()
    {
		$activetype_check = input("activetype_check",'0');
		$score_list = Db::name('major_score')->alias("ms")
						->join(config('database.prefix').'member_list m','m.member_list_id = ms.member_list_id')
						->join(config('database.prefix').'major mj','mj.major_id = m.major_id')
						->join(config('database.prefix').'recruit_major rm','rm.recruit_major_id = mj.recruit_major_id')
						->where(array('ms.major_score_status' => $activetype_check))
                        ->order('m.member_list_id desc')
						->field('ms.major_score, ms.major_score_status,m.member_list_nickname , m.member_list_username, m.member_list_id,m.major_id,ms.major_score_id,mj.major_name,rm.recruit_major_name')
						->order('major_score_id desc')->paginate(config('paginate.list_rows'),false,['query'=>get_query()]);

		$data = $score_list->all();
		$status = config("status");

		foreach($data as $key => $val)
		{
			$data[$key]['major_score_list'] = json_decode($val['major_score'],true);
			$data[$key]['status_desc'] = $val['major_score_status'] == 2 ? "<span class='red'>" . $status[$val['major_score_status']] ."</span>" : $status[$val['major_score_status']];
			$major = Db::name('major')->where(array('major_id' => $val['major_id']))->find();
			$major_score = json_decode($major['score'],true);
			$major_score = array_filter($major_score);
			$data[$key]['major_score_key'] =  $major_score;
		}

		$page = $score_list->render();
		$this->assign('activetype_check',$activetype_check);
		$this->assign('data',$data);
		$this->assign('page',$page);
        return $this->fetch();
    }
    public function score_add()
    {
        $member_list_edit=Db::name('member_list')->where(array('member_list_id'=>input('member_list_id')))->find();
        $major_score_data = Db::name('major_score')->where(array('member_list_id' => input('member_list_id')))->find();
        if($major_score_data)
        {
            $major_score_val = json_decode($major_score_data['major_score'],true);
            $this->assign('major_score_val',$major_score_val);
        }
        $major = Db::name('major')->where(array('major_id' => $member_list_edit['major_id']))->find();
		$major_score = json_decode($major['score'],true);
		$major_score = array_filter($major_score);
		$this->assign('major_score',$major_score);
        $this->assign('member_list_edit',$member_list_edit);
        return $this->fetch();
    }
    public function score_runadd()
    {
        $member_list_id = input('member_list_id');
        if(!$member_list_id){
            $this->error('参数错误！');
        }
        $score = $_POST['score'];
        $major_score = json_encode($score);
        $major_score_data = Db::name('major_score')->where(array('member_list_id' => $member_list_id))->find();
        if($major_score_data)
        {
            $data = [
                'major_score' => $major_score,
                'major_score_status' => 0,
            ];
            $rst = Db::name('major_score')->where(array('member_list_id' => $member_list_id))->update($data);
			if($rst!==false){
            $this->success('提交成功，请等待审核',url('admin/Score/score_list'));
			}else{
				$this->error('提交失败');
			}
        }
        $data = [
            'member_list_id' => $member_list_id,
            'major_score' => $major_score
        ];
        $rst = Db::name('major_score')->insert($data);
        if($rst!==false){
            $this->success('提交成功，请等待审核',url('admin/Score/score_list'));
        }else{
            $this->error('提交失败');
        }
    }
	public function score_del()
	{
		$p=input('p');
		$rst=Db::name('major_score')->where(array('member_list_id'=>input('member_list_id')))->delete();
		if($rst!==false){
			$this->success('删除成功',url('admin/Score/score_list',array('p' => $p)));
		}else{
			$this -> error("删除失败！",url('admin/Score/score_list',array('p'=>$p)));
		}
	}
    public function recruit_score_list()
    {
		$score_list = Db::name('major_score')->alias("ms")
						->join(config('database.prefix').'member_list m','m.member_list_id = ms.member_list_id')
						->join(config('database.prefix').'major mj','mj.major_id = m.major_id')
						->join(config('database.prefix').'recruit_major rm','rm.recruit_major_id = mj.recruit_major_id')
						->where(array('ms.major_score_status' => 1))
                        ->order('ms.member_list_id desc')
						->field('ms.major_score, ms.major_score_status,ms.recruit_score,ms.recruit_score_status,m.member_list_nickname,m.member_list_username, m.member_list_id,m.major_id,ms.major_score_id,mj.major_name,rm.recruit_major_name')
						->order('major_score_id desc')->paginate(config('paginate.list_rows'),false,['query'=>get_query()]);

		$data = $score_list->all();
		$status = config("status");

		foreach($data as $key => $val)
		{
			$data[$key]['major_score_list'] = json_decode($val['major_score'],true);
			$data[$key]['status_desc'] = $val['recruit_score_status'] == 2 ? "<span class='red'>".$status[$val['recruit_score_status']].'</span>' : $status[$val['recruit_score_status']];
			$major = Db::name('major')->where(array('major_id' => $val['major_id']))->find();
			$major_score = json_decode($major['score'],true);
			$major_score = array_filter($major_score);
			$data[$key]['major_score_key'] =  $major_score;
		}

		$page = $score_list->render();
		$this->assign('data',$data);
		$this->assign('page',$page);
        return $this->fetch();
    }
    public function recruit_score_add()
    {

    }
	public function recruit_score_runedit()
    {
        $member_list_id = input('member_list_id');
        if(!$member_list_id){
            return [
				'code' => 0,
				'msg' => '参数错误'
			];
        }

        $major_score_data = Db::name('major_score')->where(array('member_list_id' => $member_list_id))->find();
        if($major_score_data)
        {
			if($major_score_data['recruit_score'] == input('recruit_score')){
				return [
					'code' => 2,
					'msg' => ''
				];
			}
            $data = [
                'recruit_score' => input('recruit_score'),
                'recruit_score_status' => 0,
            ];
            $rst = Db::name('major_score')->where(array('member_list_id' => $member_list_id))->update($data);
			if($rst!==false){
				return [
					'code' => 1,
					'msg' => '提交成功，请等待审核'
				];
			}else{
				return [
					'code' => 0,
					'msg' => '提交失败'
				];
			}
        }

		return [
			'code' => 0,
			'msg' => '参数错误'
		];

    }
	public function recruit_score_all()
    {
		$score_list = Db::name('major_score')->alias("ms")
						->join(config('database.prefix').'member_list m','m.member_list_id = ms.member_list_id')
						->join(config('database.prefix').'major mj','mj.major_id = m.major_id')
						->join(config('database.prefix').'recruit_major rm','rm.recruit_major_id = mj.recruit_major_id')
						->where(array('ms.recruit_score_status' => 0))
						->field('ms.major_score, ms.major_score_status,ms.recruit_score,ms.recruit_score_status,m.member_list_nickname,m.member_list_username, m.member_list_id,m.major_id,ms.major_score_id,mj.major_name,rm.recruit_major_name')
						->order('major_score_id desc')->paginate(config('paginate.list_rows'),false,['query'=>get_query()]);

		$data = $score_list->all();
		$status = config("status");

		foreach($data as $key => $val)
		{
			$data[$key]['major_score_list'] = json_decode($val['major_score'],true);
			$data[$key]['status_desc'] = $val['recruit_score_status'] == 2 ? "<span class='red'>".$status[$val['recruit_score_status']].'</span>' : $status[$val['recruit_score_status']];
			$major = Db::name('major')->where(array('major_id' => $val['major_id']))->find();
			$major_score = json_decode($major['score'],true);
			$major_score = array_filter($major_score);
			$data[$key]['major_score_key'] =  $major_score;
		}

		$page = $score_list->render();
		$this->assign('data',$data);
		$this->assign('page',$page);
        return $this->fetch();
    }
	public function score_active()
	{
		$p = input('p');
		$ids = input('n_id/a');
		if(empty($ids)){
			$this -> error("请选择列表",url('admin/score/score_all',array('p'=>$p)));
		}
		if(is_array($ids)){
			$where = 'major_score_id in('.implode(',',$ids).')';
		}else{
			$where = 'major_score_id='.$ids;
		}

		$rst=Db::name('major_score')->where($where)->setField('major_score_status',1);
		if($rst!==false){
			foreach($ids as $key => $id)
			{
				$data = Db::name('major_score')->where(array('major_score_id' => $id))->find();
				if($data){
					Db::name('member_list')->where(array('member_list_id' => $data['member_list_id']))->update(array('major_score' => $data['major_score']));
				}
			}
			$this->success("操作成功",url('admin/score/score_all',array('p'=>$p)));
		}else{
			$this -> error("操作失败！",url('admin/score/score_all',array('p'=>$p)));
		}
	}
	public function score_unactive()
	{
		$p = input('p');
		$ids = input('n_id/a');
		if(empty($ids)){
			$this -> error("请选择列表",url('admin/score/score_all',array('p'=>$p)));
		}
		if(is_array($ids)){
			$where = 'major_score_id in('.implode(',',$ids).')';
		}else{
			$where = 'major_score_id='.$ids;
		}

		$rst=Db::name('major_score')->where($where)->setField('major_score_status',2);
		if($rst!==false){
			$this->success("操作成功",url('admin/score/score_all',array('p'=>$p)));
		}else{
			$this -> error("操作失败！",url('admin/score/score_all',array('p'=>$p)));
		}
	}
	public function recruit_score_active()
	{
		$p = input('p');
		$ids = input('n_id/a');
		if(empty($ids)){
			$this -> error("请选择列表",url('admin/score/recruit_score_all',array('p'=>$p)));
		}
		if(is_array($ids)){
			$where = 'major_score_id in('.implode(',',$ids).')';
		}else{
			$where = 'major_score_id='.$ids;
		}

		$rst=Db::name('major_score')->where($where)->setField('recruit_score_status',1);
		if($rst!==false){
			foreach($ids as $key => $id)
			{
				$data = Db::name('major_score')->where(array('major_score_id' => $id))->find();
				if($data){
					Db::name('member_list')->where(array('member_list_id' => $data['member_list_id']))->update(array('recruit_score' => $data['recruit_score']));
				}
			}
			$this->success("操作成功",url('admin/score/recruit_score_all',array('p'=>$p)));
		}else{
			$this -> error("操作失败！",url('admin/score/recruit_score_all',array('p'=>$p)));
		}
	}
	public function recruit_score_unactive()
	{
		$p = input('p');
		$ids = input('n_id/a');
		if(empty($ids)){
			$this -> error("请选择列表",url('admin/score/recruit_score_all',array('p'=>$p)));
		}
		if(is_array($ids)){
			$where = 'major_score_id in('.implode(',',$ids).')';
		}else{
			$where = 'major_score_id='.$ids;
		}

		$rst=Db::name('major_score')->where($where)->setField('recruit_score_status',2);
		if($rst!==false){
			$this->success("操作成功",url('admin/score/recruit_score_all',array('p'=>$p)));
		}else{
			$this -> error("操作失败！",url('admin/score/recruit_score_all',array('p'=>$p)));
		}
	}
}
