<?php
namespace app\api\controller\v1;

use think\Controller;
use app\api\logic\MoneyLogLogic;

class MoneyLogController extends Controller
{
	use Basetrait;


    //我的账单
    /**
     *  时间、总收入、
     *  商品、时间、收入
     */
    public function bill(){
        $billdata['user_id'] = $this->user_id;
        $address = new MoneyLogLogic();
        return $address->bill($billdata);
    }


   

}
