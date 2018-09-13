<?php

namespace app\api\logic;

use app\api\controller\v1\Basetrait;
use app\api\model\MoneyLogModel;
use think\Validate;

class MoneyLogLogic
{
    use Basetrait;

    //我的账单
    public function bill($billdata)
    {
        $Products = new \app\api\model\MoneyLogModel();
        $data     = $Products->get_bill($billdata['user_id']);
        if (empty($data)) {
            return '无数据';
        } else {
            return self::showReturnCode('200', $data);
        }
        
    }

}
