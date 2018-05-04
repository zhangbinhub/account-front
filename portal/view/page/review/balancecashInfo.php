<?php
/**
 * Created by PhpStorm.
 * User: zhangbin
 * Date: 2016/10/10
 * Time: 13:35
 */
require dirname(__FILE__) . '/../../common/pageHead.php';
?>
<html <?php echo $GLOBALS['html_attr'] ?>>
<head>
    <title>C户余额提现订单详情</title>
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['webroot'] . '/view/common/head.php';
    $commonTools = new \service\tools\ToolsClass();
    $orderno = $_GET['orderno'];
    $balanceCashOrder = $commonTools->getDatasBySQL("select ob.orderno,ob.businesstradeno,ob.custid,ob.actamont,ob.createdate,ob.channel,ob.description,
        ob.accountdate,b.businessname,cb.name,obc.cbindtype,obc.buyerbankname,obc.buyername,obc.buyeraccount,obc.remark,csub.balance 
        from acc_order_base ob 
        inner join acc_order_balancecash obc on ob.orderno=obc.orderno 
        inner join acc_business_account b on b.channel=ob.channel 
        inner join acc_dic_c_bindtype cb on obc.cbindtype=cb.code 
        inner join acc_cust_subaccount csub on ob.custid=csub.custid 
        where ob.orderno='" . $_GET['orderno'] . "' and csub.type='ALL'");
    ?>
</head>
<body class="<?php echo $GLOBALS['body_class']; ?>">
<div class="page-content no-padding-top">
    <?php if (count($balanceCashOrder) == 0) { ?>
        <div class="col-sm-8 col-sm-offset-2 form-horizontal">
            <div class="form-group">
                <div class="col-xs-12 red">找不到订单信息</div>
            </div>
        </div>
    <?php } else {
        $balanceCashOrder = $balanceCashOrder[0];
        ?>
        <div class="col-sm-8 col-sm-offset-2" style="padding-top: 20px;">
            <input type="hidden" id="balancecashinfo_review_orderno"
                   value="<?php echo $balanceCashOrder['orderno']; ?>"/>
            <div class="infotable">
                <div class="infotable-caption bigger-120">订单信息</div>
                <div class="infotable-row">
                    <div class="infotable-cell title">提现订单号</div>
                    <div class="infotable-cell info">
                        <span class="editable-click infocontent">
                            <?php echo $balanceCashOrder['orderno']; ?></span>
                    </div>
                </div>
                <div class="infotable-row">
                    <div class="infotable-cell title">商户交易号</div>
                    <div class="infotable-cell info">
                        <span class="editable-click infocontent">
                            <?php echo $balanceCashOrder['businesstradeno']; ?></span>
                    </div>
                </div>
                <div class="infotable-row">
                    <div class="infotable-cell title">C户客户号</div>
                    <div class="infotable-cell info">
                        <span class="editable-click infocontent">
                            <?php echo $balanceCashOrder['custid']; ?></span>
                    </div>
                </div>
                <div class="infotable-row">
                    <div class="infotable-cell title">交易渠道号</div>
                    <div class="infotable-cell info">
                    <span class="editable-click infocontent">
                            <?php echo $balanceCashOrder['channel']; ?></span>
                    </div>
                </div>
                <div class="infotable-row">
                    <div class="infotable-cell title">渠道名称</div>
                    <div class="infotable-cell info">
                    <span class="editable-click infocontent">
                            <?php echo $balanceCashOrder['businessname']; ?></span>
                    </div>
                </div>
                <div class="infotable-row">
                    <div class="infotable-cell title">提现金额</div>
                    <div class="infotable-cell info">
                    <span class="editable-click infocontent red">
                            <?php echo $balanceCashOrder['actamont']; ?></span>
                    </div>
                </div>
                <div class="infotable-row">
                    <div class="infotable-cell title">C户总余额</div>
                    <div class="infotable-cell info">
                    <span class="editable-click infocontent green">
                            <?php echo $balanceCashOrder['balance']; ?></span>
                    </div>
                </div>
                <div class="infotable-row">
                    <div class="infotable-cell title">会计日期</div>
                    <div class="infotable-cell info">
                    <span class="editable-click infocontent">
                            <?php echo $balanceCashOrder['accountdate']; ?></span>
                    </div>
                </div>
                <div class="infotable-row">
                    <div class="infotable-cell title">申请时间</div>
                    <div class="infotable-cell info">
                    <span class="editable-click infocontent">
                            <?php echo $balanceCashOrder['createdate']; ?></span>
                    </div>
                </div>
                <div class="infotable-row">
                    <div class="infotable-cell title">订单描述</div>
                    <div class="infotable-cell info">
                    <span class="editable-click infocontent">
                            <?php echo $balanceCashOrder['description']; ?></span>
                    </div>
                </div>
                <div class="infotable-row">
                    <div class="infotable-cell title">附加信息</div>
                    <div class="infotable-cell info">
                    <span class="editable-click infocontent">
                            <?php echo $balanceCashOrder['remark']; ?></span>
                    </div>
                </div>
            </div>
            <div class="infotable">
                <div class="infotable-caption bigger-120">提取账户</div>
                <div class="infotable-row">
                    <div class="infotable-cell title">账户类型</div>
                    <div class="infotable-cell info">
                        <span class="editable-click infocontent blue">
                            <?php echo $balanceCashOrder['name']; ?></span>
                    </div>
                </div>
                <?php
                if ($balanceCashOrder['name'] == 'BANKCARD') { ?>
                    <div class="infotable-row">
                        <div class="infotable-cell title">开户行</div>
                        <div class="infotable-cell info">
                        <span class="editable-click infocontent red">
                            <?php echo $balanceCashOrder['buyerbankname']; ?></span>
                        </div>
                    </div>
                <?php } ?>
                <div class="infotable-row">
                    <div class="infotable-cell title">账户名称</div>
                    <div class="infotable-cell info">
                        <span class="editable-click infocontent red">
                            <?php echo $balanceCashOrder['buyername']; ?></span>
                    </div>
                </div>
                <div class="infotable-row">
                    <div class="infotable-cell title">账号</div>
                    <div class="infotable-cell info">
                        <span class="editable-click infocontent red">
                            <?php echo $balanceCashOrder['buyeraccount']; ?></span>
                    </div>
                </div>
            </div>
            <?php
            $itemflows = $commonTools->getDatasBySQL("select * from acc_entry_itemflow where orderno='" . $orderno . "' order by balancedirect asc,businessid,createdate desc");
            if (count($itemflows) > 0) {
                ?>
                <hr>
                <div class="infotable-horizontal" style="margin-bottom: 20px">
                    <div class="infotable-caption bigger-120">科目流水</div>
                    <div class="infotable-row">
                        <div class="infotable-cell title">B户客户号</div>
                        <div class="infotable-cell title">科目名称</div>
                        <div class="infotable-cell title">科目账户</div>
                        <div class="infotable-cell title">借贷方向</div>
                        <div class="infotable-cell title">发生额</div>
                        <div class="infotable-cell title">创建时间</div>
                    </div>
                    <?php foreach ($itemflows as $itemflow) { ?>
                        <div class="infotable-row">
                            <div class="infotable-cell info">
                                <span class="editable-click infocontent">
                                    <?php echo $itemflow['businessid']; ?></span>
                            </div>
                            <div class="infotable-cell info">
                                <span class="editable-click infocontent">
                                    <?php echo $itemflow['accountitemthirdname']; ?></span>
                            </div>
                            <div class="infotable-cell info">
                                <span class="editable-click infocontent">
                                    <?php echo $itemflow['accountsubitemname']; ?></span>
                            </div>
                            <div class="infotable-cell info align-center">
                                <?php echo $itemflow['balancedirect'] == '1' ? '<span class="editable-click infocontent green">借</span>' : '<span class="editable-click infocontent red">贷</span>'; ?>
                            </div>
                            <div class="infotable-cell info align-center">
                                <span class="editable-click infocontent">
                                    <?php echo $itemflow['amont']; ?></span>
                            </div>
                            <div class="infotable-cell info align-center">
                                <span class="editable-click infocontent">
                                    <?php echo $itemflow['createdate']; ?></span>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="hr"></div>
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right"
                           for="balancecashinfo_review_result"><span class="lbl bigger-120">审核结果：</span></label>
                    <div class="col-sm-9">
                        <label class="control-label">
                            <input name="balancecashinfo_review_result" type="radio" class="ace input-lg" value="1"
                                   checked/>
                            <span class="lbl bigger-120"> 通过</span>
                        </label>
                        <label class="control-label" style="margin-left: 30px;">
                            <input name="balancecashinfo_review_result" type="radio" class="ace input-lg" value="0"/>
                            <span class="lbl bigger-120"> 不通过</span>
                        </label>
                    </div>
                </div>
                <div class="form-group hidden">
                    <label class="col-sm-3 control-label no-padding-right"
                           for="balancecashinfo_review_content">审核意见：</label>
                    <div class="col-sm-9">
                        <textarea class="form-control width-80 required autosize-transition"
                                  id="balancecashinfo_review_content"
                                  placeholder="请输入审核意见"></textarea>
                    </div>
                </div>
                <div class="form-actions center no-margin">
                    <button type="reset" class="btn btn-white btn-warning btn-bold btn-round"
                            id="balancecashinfo_review_reset_btn">
                        <i class="ace-icon fa fa-undo bigger-120 orange2"></i> 重置
                    </button>
                    &nbsp;&nbsp;
                    <?php
                    if (service\user\UserManagerClass::validatePermissions($GLOBALS['application']->getId(), $user->getId(), 'back_cust_cash')
                        && service\user\UserManagerClass::validatePermissions($GLOBALS['application']->getId(), $user->getId(), 'back_cust_canclecash')
                    ) {
                        ?>
                        <button type="button" class="btn btn-white btn-success btn-bold btn-round"
                                id="balancecashinfo_review_save_btn">
                            <i class="ace-icon fa fa-floppy-o bigger-120 green"></i> 确定
                        </button>
                        &nbsp;&nbsp;
                        <?php
                    }
                    ?>
                    <button type="button" class="btn btn-white btn-danger btn-bold btn-round"
                            id="balancecashinfo_review_cancle_btn">
                        <i class="ace-icon fa fa-times bigger-120 red2"></i> 取消
                    </button>
                </div>
            </form>
        </div>
    <?php } ?>
</div>
<?php require $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['webroot'] . '/view/common/foot.php'; ?>
<script type="text/javascript" defer async="async"
        charset="<?php echo $GLOBALS['charset']; ?>"
        src="<?php echo $GLOBALS['webroot'] . '/script/page/review/balancecashInfo.js?v=1.0.0'; ?>"></script>
</body>
</html>