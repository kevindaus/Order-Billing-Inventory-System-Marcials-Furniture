<?php


class InvoiceController extends Controller
{

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index','list','create','save','print','view','getCustomerInfo','allOldCustomers'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Show list of issued invoices
     */
    public function actionIndex()
    {
        $this->redirect("list");
    }

    /**
     * List all orders and
     */
    public function actionList()
    {
        $this->layout = "column2";
        $model= new Orders;
        $model->unsetAttributes();
        $listDataProvider = null;
        if (isset($_POST['Orders'])) {
            $model->attributes = $_POST['Orders'];
        }
        if (isset($_POST['searchWhat'])) {
            $criteria = new CDbCriteria;
            if ($_POST['searchWhat'] === 'name') {
                $criteria->compare("tbl_customer.title",$_POST['searchName'],true,"OR");
                $criteria->compare("tbl_customer.firstname",$_POST['searchName'],true,"OR");
                $criteria->compare("tbl_customer.middlename",$_POST['searchName'],true,"OR");
                $criteria->compare("tbl_customer.lastname",$_POST['searchName'],true,"OR");
                $criteria->join = "left join tbl_customer on tbl_customer.id = t.customer_id";
                // $criteria->compare
            }else if ($_POST['searchWhat'] === 'order_date') {
                $dateFormatted = date("Y-m-d", strtotime($_POST['searchOrderDate']));
                $criteria->addCondition("date(order_date) = '".$dateFormatted."'");
            }
            $listDataProvider = new CActiveDataProvider('Orders',array(
                    'criteria'=>$criteria,
                    'pagination'=>false,
                ));
            // print_r($listDataProvider->criteria);
            // print_r($listDataProvider->data);
            // die();
        }else{
            $listDataProvider = $model->search();
        }
        $this->render('list', array('model'=>$model,'listDataProvider'=>$listDataProvider));
    }
    public function actionAllOldCustomers()
    {
        header("Content-Type: application/json");
        $criteria = new CDbCriteria;
        $criteria->distinct = true;
        $allRes = Yii::app()->db->createCommand("select * from tbl_customer group by concat(title,' ',firstname,' ',middlename,' ',lastname)")->queryAll();
        // $allOldCustomers = Customer::model()->findAll($criteria);
        echo CJSON::encode($allRes);
    }
    public function actionCreate(){
        $this->layout = "invoice";

        $customerModels = Customer::model()->findAll();
        $customerNames = array();
        foreach ($customerModels as $key => $value) {
            $customerNames[] = array(
                    'id'=>$value->id,
                    'label'=>sprintf("%s %s %s %s" , $value->title , $value->firstname , $value->middlename , $value->lastname)
                );
        }
        $this->render('create',compact('customerNames'));
    }
    public function actionGetCustomerInfo($customerName)
    {
        $criteria = new CDbCriteria;
        $criteria->compare("concat(title,' ',firstName,' ',middleName,' ',lastName)",$customerName);
        $model = Customer::model()->find($criteria);
        if ($model) {
            header("Content-Type: application/json");
            echo json_encode($model->attributes);
        }else{
            throw new CHttpException(404,"Customer doesnt exists");
        }
    }
    public function actionForm()
    {
        $this->layout = "empty";
        $this->render('form');
    }

    public function actionSave()
    {
        header("Content-Type: application/json");
        $jsonResult = array(
                "status"=>"",
                "message"=>""
            );
        $rawPostedData = file_get_contents("php://input");
        $_POST = json_decode($rawPostedData, true);
        $persistorObj = new InvoiceDataPersistor($_POST);
        try {
            $persistorObj->save();
            $jsonResult = array(
                    "status"=>"success",
                    "message"=>"Invoice created"
                );            
        } catch (Exception $e) {
            $jsonResult = array(
                "status"=>"failed",
                "message"=>$e->getMessage()
            );
        }
        echo json_encode($jsonResult);
    }
    /**
     * @todo  - Generates pdf and redirect the user to the generate pdf
     * @param  string $id The invoice number
     */
    public function actionPrint($id)
    {
        $ordermodel = Orders::model()->findByAttributes(array('invoice_number'=>$id));
        if (!$ordermodel) {
            throw new CHttpException(404,"Sorry we cant find that invoice number. Cause : it doesnt exists in our record");
        }else{
            $dompdf = new DOMPDF();
            $htmlOutput = $this->renderPartial('view', array('model'=>$ordermodel),true);
            $dompdf->load_html($htmlOutput);
            $dompdf->render();
            $fileName= sys_get_temp_dir().uniqid("invoice").".pdf";
            file_put_contents($fileName , $dompdf->output());
            $outputFile = Yii::app()->assetManager->publish($fileName);
            $this->redirect($outputFile);            
        }

    }

}