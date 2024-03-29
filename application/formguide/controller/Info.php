<?php
// +----------------------------------------------------------------------
// | Yzncms [ 御宅男工作室 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018 http://yzncms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 御宅男 <530765310@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 表单信息管理
// +----------------------------------------------------------------------
namespace app\formguide\controller;

use app\common\controller\Adminbase;
use app\formguide\model\Formguide as Formguide_Model;
use think\Db;

class Info extends AdminBase
{
    /**
     * @var Formguide_Model
     */
    private $Formguide_Model;

    protected function initialize()
    {
        parent::initialize();
        $this->Formguide_Model = new Formguide_Model;
    }

    //信息列表
    public function index()
    {
        $formid = $this->request->param('formid/d', 0);
        if ($this->request->isAjax()) {
            $modelCache = cache("Model");
            $tableName  = $modelCache[$formid]['tablename'];

            $this->modelClass           = Db::name($tableName);
            list($page, $limit, $where) = $this->buildTableParames();

            $total = Db::name($tableName)->where($where)->count();
            $_list = Db::name($tableName)->where($where)->page($page, $limit)->order(['id' => 'desc'])->withAttr('inputtime', function ($value, $data) {
                return date('Y-m-d H:i:s', $value);
            })->select();
            $result = array("code" => 0, "count" => $total, "data" => $_list);
            return json($result);
        } else {
            $fieldList = Db::name('ModelField')->where('modelid', $formid)->where('status', 1)->select();
            $this->assign('formStr', $this->getTableList($fieldList));
            $this->assign('formid', $formid);
            return $this->fetch();
        }

    }

    //删除信息
    public function del()
    {
        $formid = $this->request->param('formid/d', 0);
        $ids    = $this->request->param('ids/a', null);
        if (empty($ids) || !$formid) {
            $this->error('参数错误！');
        }
        if (!is_array($ids)) {
            $ids = array(0 => $ids);
        }
        try {
            foreach ($ids as $id) {
                $this->Formguide_Model->deleteInfo($formid, $id);
            }
        } catch (\Exception $ex) {
            $this->error($ex->getMessage());
        }
        $this->success('删除成功！');
    }

    //信息查看
    public function public_view()
    {
        $id        = $this->request->param('id', 0);
        $formid    = $this->request->param('formid', 0);
        $fieldList = $this->Formguide_Model->getFieldInfo($formid, $id);
        $this->assign([
            'fieldList' => $fieldList,
        ]);
        return $this->fetch();
    }

    public function getTableList($fieldList = [])
    {
        $htmlstr = "";
        foreach ($fieldList as $k => $v) {
            if ($v['type'] == "datetime") {
                $htmlstr .= "{ field: '" . $v['name'] . "',title: '" . $v['title'] . "',templet: function(d){ return layui.formatDateTime(d." . $v['name'] . ") } },\n";
            }if ($v['type'] == "image") {
                $htmlstr .= "{ field: '" . $v['name'] . "',title: '" . $v['title'] . "',templet: yznTable.image },\n";
            } elseif ($v['type'] != "images" && $v['type'] != "files") {
                $htmlstr .= "{ field: '" . $v['name'] . "', align: 'left',title: '" . $v['title'] . "' },\n";
            }
        }
        return $htmlstr;
    }

}
