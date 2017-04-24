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
use think\Db;
use think\Cache;

class School extends Base
{
	public function school_list()
    {
		$search_name=input('search_name');
		$map=array();
		if($search_name){
			$map['school_name']= array('like',"%".$search_name."%");
		}
		$school_list = Db::name('school')->where($map)->order('school_id')->paginate(config('paginate.list_rows'),false,['query'=>get_query()]);
		$page = $school_list->render();
		$this->assign('search_name',$search_name);
		$this->assign('school_list',$school_list);
		$this->assign('page',$page);

        return $this->fetch();
    }
    public function school_add()
    {
        return $this->fetch();
    }
	public function school_runadd()
	{
		$data = [
			'school_name' => input('school_name'),
		];
		SchoolModel::create($data);

		$this->success('添加成功',url('admin/School/school_list'));

	}
	public function school_edit()
	{
		$school_id = input('school_id','0');
		$school = Db::name('school')->where(array('school_id' => $school_id))->find();
		if(!$school)
		{
			$this->error('不存在中职学校',url('admin/School/major_list'));
		}
		$this->assign('school',$school);
		return $this->fetch();
	}
	public function school_runedit()
	{
		$school_id = input('school_id','0');
		$school = Db::name('school')->where(array('school_id' => $school_id))->find();
		if(!$school)
		{
			$this->error('不存在中职学校',url('admin/School/major_list'));
		}
		$srt = Db::name('school')->where(array('school_id' => $school_id))->update(array('school_name' => input('school_name')));
		$this->success('更新成功');
	}
	public function school_del()
	{
		$p=input('p');
		$school_id = input('school_id','0');
		$data_admin = Db::name('admin')->where(array('school_id' => $school_id))->find();
		$data_member = Db::name('member_list')->where(array('school_id' => $school_id))->find();
		if($data_admin || $data_member)
		{
			$this->error('删除失败,请先删除该学院下的中职管理员及用户',url('admin/School/major_list', array('p' => $p)));
		}
		$rst=Db::name('school')->where(array('school_id'=>$school_id))->delete();
		if($rst!==false){
			$this->success('删除成功',url('admin/School/school_list', array('p' => $p)));
		}else{
			$this->error('删除失败',url('admin/School/school_list', array('p' => $p)));
		}

	}
	public function major_add()
	{
		$school_id = input('school_id','0');
		$school = Db::name('school')->where(array('school_id' => $school_id))->find();
		if(!$school)
		{
			$this->error('不存在中职学校',url('admin/School/major_list'));
		}
		$this->assign('school',$school);
		$recruit_major_list = Db::name('recruit_major')->select();
		$this->assign('recruit_major_list',$recruit_major_list);
		return $this->fetch();
	}
	public function major_list()
	{
		$school_id = input('school_id','0');
		$school = Db::name('school')->where(array('school_id' => $school_id))->find();
		if(!$school)
		{
			$this->error('不存在中职学校',url('admin/School/school_list'));
		}
		$search_name = input('search_name');
		$map=array();
		if($search_name){
			$map['m.major_name']= array('like',"%".$search_name."%");
		}
		if($school_id)
		{
			$map['m.school_id']= array('like',"%".$school_id."%");
		}

		$major_list = Db::name('major')->alias('m')
					->join(config('database.prefix').'recruit_major rm','rm.recruit_major_id = m.recruit_major_id')
					->where($map)
					->order('major_id')
					->paginate(config('paginate.list_rows'),false,['query'=>get_query()]);

		$data = $major_list->all();
		foreach($data as $key => $major)
		{
			$data[$key]['major_score'] = json_decode($major['score'],true);
		}
		$page = $major_list->render();
		$this->assign('major_list',$data);
		$this->assign('page',$page);
		$this->assign('school',$school);
		$this->assign('search_name',$search_name);
		return $this->fetch();
	}

	public function secondary_vocat_major_edit()
	{
		$major_id= $this->admin['major_id'];
		$major = Db::name('major')->where(array('major_id' => $major_id))->find();
		if(!$major)
		{
			$this->error('不存在该专业');
		}
		$school = Db::name('school')->where(array('school_id' => $major['school_id']))->find();
		$major_score = json_decode($major['score'],true);
		$recruit_major_list = Db::name('recruit_major')->select();
		$this->assign('recruit_major_list',$recruit_major_list);
		$this->assign('school',$school);
		$this->assign('major',$major);
		$this->assign('major_score',$major_score);
		return $this->fetch();
	}

	public function secondary_vocat_major_runedit()
	{
		$major_id= $this->admin['major_id'];
		$major = Db::name('major')->where(array('major_id' => $major_id))->find();
		if(!$major)
		{
			$this->error('不存在该专业');
		}
		$score = $_POST['score'];
		$data = [
			'score' => json_encode($score),
		];
		$rst = Db::name('major')->where(array('major_id' => $major['major_id']))->update($data);
		if($rst!==false){
			$this->success('修改成功',url('admin/School/secondary_vocat_major_edit'));
		}else{
			$this->error('修改失败',url('admin/School/secondary_vocat_major_edit'));
		}
	}

	public function major_edit()
	{
		$major_id= input('major_id','0');
		$major = Db::name('major')->where(array('major_id' => $major_id))->find();
		if(!$major)
		{
			$this->error('不存在该专业');
		}
		$school = Db::name('school')->where(array('school_id' => $major['school_id']))->find();
		$major_score = json_decode($major['score'],true);
		$recruit_major_list = Db::name('recruit_major')->select();
		$this->assign('recruit_major_list',$recruit_major_list);
		$this->assign('school',$school);
		$this->assign('major',$major);
		$this->assign('major_score',$major_score);
		return $this->fetch();
	}
	public function major_runadd()
	{
		$score = $_POST['score'];
		$school_id = input('school_id','0');
		$school = Db::name('school')->where(array('school_id' => $school_id))->find();
		if(!$school)
		{
			$this->error('不存在中职学校',url('admin/School/school_list'));
		}
		$data = [
			'major_name' => input('major_name'),
			'school_id'	 => $school_id,
			'recruit_major_id' => input('recruit_major_id'),
			'major_code' => input('major_code'),
			'score' => json_encode($score),
			'number' => input('number'),
		];
		MajorModel::create($data);
		$this->success('添加成功',url('admin/School/major_list',array('school_id' => $school_id)));
	}
	public function major_runedit()
	{
		$major_id= input('major_id','0');
		$major = Db::name('major')->where(array('major_id' => $major_id))->find();
		if(!$major)
		{
			$this->error('不存在该专业');
		}
		$score = $_POST['score'];
		$data = [
			'major_name' => input('major_name'),
			'score' => json_encode($score),
			'major_code' => input('major_code'),
			'recruit_major_id' => input('recruit_major_id'),
			'number' => input('number'),
		];
		$rst = Db::name('major')->where(array('major_id' => $major['major_id']))->update($data);
		if($rst!==false){
			$this->success('修改成功',url('admin/School/major_edit',array('major_id' => $major_id)));
		}else{
			$this->error('修改失败',url('admin/School/major_edit',array('major_id' => $major_id)));
		}
	}
	public function major_del()
	{
		$p=input('p');
		$major_id = input('major_id','0');
		$data_admin = Db::name('admin')->where(array('major_id' => $major_id))->find();
		$data_member = Db::name('member_list')->where(array('major_id' => $major_id))->find();
		if($data_admin || $data_member)
		{
			$this->error('删除失败,请先删除该专业下的中职管理员及用户',url('admin/School/major_list', array('p' => $p)));
		}
		$rst=Db::name('major')->where(array('major_id'=>$major_id))->delete();
		if($rst!==false){
			$this->success('删除成功',url('admin/School/major_list', array('p' => $p)));
		}else{
			$this->error('删除失败',url('admin/School/major_list', array('p' => $p)));
		}

	}
	public function recruit_major_list()
	{
		$search_name = input('search_name');
		$map=array();
		if($search_name){
			$map['rm.major_name']= array('like',"%".$search_name."%");
		}
		$major_list = Db::name('recruit_major')->alias('rm')
							->join(config('database.prefix').'major mj','mj.recruit_major_id = rm.recruit_major_id')
							->field(array(
								'rm.*',
								'sum(mj.number) as zs_number'
							))
							->where($map)
							->order('rm.recruit_major_id')
							->group('rm.recruit_major_id')
							->paginate(config('paginate.list_rows'),false,['query'=>get_query()]);

		$page = $major_list->render();
		$this->assign('major_list',$major_list);
		$this->assign('search_name',$search_name);
		$this->assign('page',$page);
		return $this->fetch();
	}
	public function recruit_major_add()
	{
		return $this->fetch();
	}
	public function recruit_major_edit()
	{
		$recruit_major_id= input('recruit_major_id','0');
		$recruit_major = Db::name('recruit_major')->where(array('recruit_major_id' => $recruit_major_id))->find();
		if(!$recruit_major)
		{
			$this->error('不存在该专业');
		}
		$this->assign('recruit_major',$recruit_major);
		return $this->fetch();
	}
	public function recruit_major_runadd()
	{
		$data = [
			'recruit_major_name' => input('recruit_major_name'),
			'min_score'
		//	'number'	 => input('number'),
		];
		RecruitMajorModel::create($data);
		$this->success('添加成功',url('admin/School/recruit_major_list'));
	}
	public function recruit_major_runedit()
	{
		$recruit_major_id= input('recruit_major_id','0');
		$data = [
			'recruit_major_name' => input('recruit_major_name'),
			//'number'	 => input('number'),
		];
		$rst = Db::name('recruit_major')->where(array('recruit_major_id' => $recruit_major_id))->update($data);
		if($rst!==false){
			$this->success('修改成功',url('admin/School/recruit_major_edit',array('recruit_major_id' => $recruit_major_id)));
		}else{
			$this->error('修改失败',url('admin/School/recruit_major_edit',array('recruit_major_id' => $recruit_major_id)));
		}
	}
	public function recruit_major_del()
	{
		$p=input('p');
		$recruit_major_id = input('recruit_major_id','0');

		$data_admin = Db::name('admin')->alias('am')
						->join(config('database.prefix').'major mj','mj.major_id = am.major_id')
						->join(config('database.prefix').'recruit_major rm','rm.recruit_major_id = mj.recruit_major_id')
						->where(array('rm.recruit_major_id' => $recruit_major_id))
						->find();
		if($data_admin)
		{
			$this->error('删除失败,请先删除该专业下的中职管理员及用户',url('admin/School/major_list', array('p' => $p)));
		}
		$rst=Db::name('recruit_major')->where(array('recruit_major_id'=>$recruit_major_id))->delete();
		if($rst!==false){
			$this->success('删除成功',url('admin/School/recruit_major_list', array('p' => $p)));
		}else{
			$this->error('删除失败',url('admin/School/recruit_major_list', array('p' => $p)));
		}

	}
	public function ajax_recruit_major(){
		if (!request()->isAjax()){
			$this->error('提交方式不正确');
		}else{
			$school_id = input('school_id','0');
			$recruit_major_list = Db::name('recruit_major')->alias('rm')
										->join(config('database.prefix').'major mj','mj.recruit_major_id = rm.recruit_major_id')
										->join(config('database.prefix').'admin am','am.major_id = mj.major_id')
										->where(array('am.school_id' => $school_id))
										->field('rm.recruit_major_name,rm.recruit_major_id')
										->distinct('recruit_major_id')
										->select();
			$html = '<option value="">请选择高职专业</option>';
			foreach($recruit_major_list as $key => $major)
			{
				$html .= "<option value='".$major['recruit_major_id']."'>".$major['recruit_major_name']."</option>";
			}
			return [
				'code' => 200,
				'html' => $html,
			];
		}
	}
	public function ajax_major(){
		if (!request()->isAjax()){
			$this->error('提交方式不正确');
		}else{
			$school_id = input('school_id','0');
			$major_list = Db::name('major')->where(array('school_id' => $school_id))->select();
			$html = '<option value="">请选择中职专业</option>';
			foreach($major_list as $key => $major)
			{
				$html .= "<option value='".$major['major_id']."'>".$major['major_name']."</option>";
			}
			return [
				'code' => 200,
				'html' => $html,
			];
		}
	}
	public function enrollment()
	{
		$majors = Db::name('major')->alias('mj')
							->join(config('database.prefix').'recruit_major rm','mj.recruit_major_id = rm.recruit_major_id')
							->join(config('database.prefix').'school s','mj.school_id = s.school_id')
							->order('mj.school_id')
							->select();
		$this->assign('majors',$majors);
		return $this->fetch();
	}
	public function export_enrollment()
	{
		$data = Db::name('major')->alias('mj')
							->join(config('database.prefix').'recruit_major rm','mj.recruit_major_id = rm.recruit_major_id')
							->join(config('database.prefix').'school s','mj.school_id = s.school_id')
							->order('mj.school_id')
							->select();
        $field_titles = ['中职学校','中职专业','中职专业代码','高职专业','高职专业代码','招生计划数'];
        $fields = ['school_name','major_name','major_code','recruit_major_name','recruit_major_code','number'];
        $table = '招生计划表'.date('YmdHis');
        error_reporting(E_ALL);
        date_default_timezone_set('Asia/chongqing');
        $objPHPExcel = new \PHPExcel();
        //import("Org.Util.PHPExcel.Reader.Excel5");
        /*设置excel的属性*/
        $objPHPExcel->getProperties()->setCreator("wuzhijie")//创建人
        ->setLastModifiedBy("wuzhijie")//最后修改人
        ->setKeywords("excel")//关键字
        ->setCategory("result file");//种类

        //第一行数据
        $objPHPExcel->setActiveSheetIndex(0);
        $active = $objPHPExcel->getActiveSheet();
        foreach($field_titles as $i=>$name){
            $ck = num2alpha($i++) . '1';
            $active->setCellValue($ck, $name);
        }
        //填充数据
        foreach($data as $k => $v){
            $k=$k+1;
            $num=$k+1;//数据从第二行开始录入
            $objPHPExcel->setActiveSheetIndex(0);
            foreach($fields as $i=>$name){
                $ck = num2alpha($i++) . $num;
                $active->setCellValue($ck, $v[$name]);
            }
        }
        $objPHPExcel->getActiveSheet()->setTitle($table);
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$table.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
	}
}
