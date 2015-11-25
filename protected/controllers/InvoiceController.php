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
                'actions' => array('index','list','create','save','print','view'),
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
        if (isset($_POST['Orders'])) {
            $model->attributes = $_POST['Orders'];
        }
        $this->render('list', array('model'=>$model));
    }

    public function actionCreate(){

        $this->render('create');
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
            echo "generating pdf please wait <br>";
            echo "$id";            
        }

    }
    public function actionView()
    {
        $model = Orders::model()->find();
        $this->layout = "empty";


        // $this->render('view', array('model'=>$model));
        // Yii::app()->end();
        // 


        /*prepare DOM pdf*/
        $dompdf = new DOMPDF();
        // $dompdf->set_paper("a4", "landscape");
        $htmlOutput = $this->renderPartial('view', array('model'=>$model),true);
        $dompdf->load_html($htmlOutput);
        $dompdf->render();
        $fileName= sys_get_temp_dir().uniqid("asdasd").".pdf";
        file_put_contents($fileName , $dompdf->output());
        $outputFile = Yii::app()->assetManager->publish($fileName);
        $this->redirect($outputFile);
        /*output pdf*/
    }


}