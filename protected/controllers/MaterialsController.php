<?php

class MaterialsController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            // 'postOnly + delete', // uncommenting this for now . This is dangerous . I also like to live in a dangerous life. :D.
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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update','resupply','index', 'view','json'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    public function actionJson()
    {
        header("Content-Type: application/json");
        $allMaterialsObject = Materials::model()->findAll();
        echo CJSON::encode($allMaterialsObject);
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->layout = "materials";
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }
    public function actionResupply($material_id)
    {
        $model = Materials::model()->findByPk($material_id);
        if ($model) {
            if (Yii::app()->request->isPostRequest) {
                $oldQuantity = intval($model->quantity);
                $model->quantity = intval($model->quantity) + intval($_POST['quantityToBeAdded']);

                if ($model->quantity >= 0 && $model->save()) {
                    Yii::app()->user->setFlash("success","Number of available material increased : <strong>$model->name</strong> is updated . <br><small>From $oldQuantity to $model->quantity</small>");
                }else{
                    if ($model->quantity < 0) {
                        Yii::app()->user->setFlash("error","Number of available material should not be negative.");
                    }else{
                        Yii::app()->user->setFlash("error","Sorry we cant update the materials record now.Reason :" .CHtml::errorSummary($model));
                    }
                }
                $this->redirect(Yii::app()->request->requestUri);
            }
            $this->render('resupply',compact('model'));

        }else{
            throw new CHttpException(404,"Material doesnt exists in the database");
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $this->layout = "materials";
        $model = new Materials;
        if (isset($_POST['Materials'])) {
            $model->attributes = $_POST['Materials'];

            $uploadedFile = CUploadedFile::getInstance($model, 'image');

            if ($uploadedFile) {
                /*generate random name*/
                $model->image = sprintf("%s-%s", uniqid() . '-material-', $uploadedFile);
                /*save model*/
                $model->save();
                /*save the uploaded file to */
                $uploadPath = Yii::getPathOfAlias("uploadedImage") . '/' . $model->image;
                $uploadedFile->saveAs($uploadPath);
            }
            if ($model->save()) {
                Yii::app()->user->setFlash("success","New material record created");
                $this->redirect(array('view', 'id' => $model->id));
            }
        }else{
            if (empty($model->sku)) {
                $model->sku = uniqid();
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $this->layout = "materials";
        $model = $this->loadModel($id);

        if (isset($_POST['Materials'])) {
            $oldImageVal = $model->image;
            $oldQuantity = $model->quantity;
            $model->attributes = $_POST['Materials'];
            $model->oldQuantity = $oldQuantity;
            $uploadedFile = CUploadedFile::getInstance($model, 'image');
            if ($uploadedFile) {
                /*generate random name*/
                $model->image = sprintf("%s-%s", uniqid() . '-material-', $uploadedFile);
                /*save model*/
                $model->save();
                /*save the uploaded file to */
                $uploadPath = Yii::getPathOfAlias("uploadedImage") . '/' . $model->image;
                $uploadedFile->saveAs($uploadPath);
            } else {
                $model->image = $oldImageVal;
            }
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }

        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        Yii::app()->user->setFlash("success","Record deleted");
        $this->redirect($this->createAbsoluteUrl("materials/index"));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $searchModel = new Materials('search');
        $dataProvider = new CActiveDataProvider('Materials');
        if (  isset($_GET['Materials'])  ) {
            $searchModel->attributes = $_GET['Materials'];
            $dataProvider = $searchModel->search();
        }
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $this->layout = "materials";
        $model = new Materials('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Materials'])){
            $model->attributes = $_GET['Materials'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Materials the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Materials::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Materials $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'materials-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
