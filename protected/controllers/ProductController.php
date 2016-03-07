<?php

class ProductController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
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
                'actions' => array('create', 'update', 'index', 'view', 'admin', 'delete','json','resupply','requirement'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    public function actionJson()
    {
        header("Content-Type: application/json");
        $criteria = new CDbCriteria;
        $criteria->select = "id,sku,name,description,quantity,price";
        $jsonresultarr = array();
        $allProducts = Product::model()->findAll($criteria);
        foreach ($allProducts as $key => $value) {
            $jsonresultarr[] = array(
                    "product_name"=>$value->name,
                    "description"=>$value->description,
                    "quantity"=>intval($value->quantity),
                    "unit_price"=>doubleval($value->price),
            );
        }
        echo CJSON::encode($jsonresultarr);
    }
    public function actionResupply($product_id)
    {
        $model = Product::model()->findByPk($product_id);
        if ($model) {
            if (Yii::app()->request->isPostRequest) {
                $oldQuantity = intval($model->quantity);
                /*run for n specified number off quantity to be added*/
                for ($i=0; $i < intval($_POST['quantityToBeAdded']); $i++) {
                    $productRequirements = ProductRequirement::model()->findAllByAttributes(array('product_id'=>$product_id));
                    $updateMaterialsLater = array();
                    foreach ($productRequirements as $key => $currentProductRequirement) {
                        $currentMaterial = $currentProductRequirement->material;
                        if ($currentMaterial) {
                            $currentMaterial->quantity = intval($currentMaterial->quantity) - $currentProductRequirement->quantity;
                            if ($currentMaterial->validate()) {
                                $updateMaterialsLater[] = $currentMaterial;
                            }else{
                                if ($i !== 0) {
                                    $neededMaterialsQuantity = intval($currentProductRequirement->quantity) * intval($_POST['quantityToBeAdded']);
                                    $tempMessage = sprintf("We can't continue updating the quantity there seem to have a shortage in %s. To continue please update quantity of %s to atleast %s piece(s)", $currentMaterial->name,$currentMaterial->name,$neededMaterialsQuantity);
                                    Yii::app()->user->setFlash("info",$tempMessage);
                                    $this->redirect(Yii::app()->request->requestUri);                                    
                                }else{
                                    $neededMaterialsQuantity = intval($currentProductRequirement->quantity) * intval($_POST['quantityToBeAdded']);
                                    Yii::app()->user->setFlash("error","<strong>Insufficient materials </strong>: More $currentMaterial->name is required. You need atleast ".$neededMaterialsQuantity ." piece(s)");
                                    $this->redirect(Yii::app()->request->requestUri);
                                }
                            }
                        }else{
                            /*if material doesnt exists anymore , delete this requirement also*/
                            $currentProductRequirement->delete();//continue as usual
                        }
                    }
                    foreach ($updateMaterialsLater as $key => $value) {
                        $value->save();//finally update the quantity of materials
                    }
                    $model->quantity = intval($model->quantity) + 1;
                    $model->save();
                }
                Yii::app()->user->setFlash("success","Number of available $model->name is updated :<br>From $oldQuantity to $model->quantity");
                $this->redirect(Yii::app()->request->requestUri);
            }
            $this->render('resupply',compact('model'));
        }else{
            throw new CHttpException(404,"Material doesnt exists in the database");
        }        
    }
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->layout = "product";
        $requiredMaterials = ProductRequirement::model()->findAllByAttributes(array("product_id"=>$id));
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'requiredMaterials' => $requiredMaterials,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $this->layout = "product";
        $model = new Product;

        if (isset($_POST['Product'])) {
            $model->attributes = $_POST['Product'];
            $uploadedFile = CUploadedFile::getInstance($model, 'image');
            if ($uploadedFile) {
                $model->image = sprintf("%s-%s", uniqid() . '-product-', $uploadedFile);
                /*save the uploaded file to */
                $uploadPath = Yii::getPathOfAlias("uploadedImage") . '/' . $model->image;
                $uploadedFile->saveAs($uploadPath);
            }
            if ($model->isNewRecord && $model->save()) {
                $this->redirect(array('/product/requirement', 'product_id' => $model->id));
            }else if ($model->save()) {
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

        if (isset($_POST['Product'])) {
            $oldImageVal = $model->image;
            $model->attributes = $_POST['Product'];
            $uploadedFile = CUploadedFile::getInstance($model, 'image');
            if ($uploadedFile) {
                /*generate random name*/
                $model->image = sprintf("%s-%s", uniqid() . '-product-', $uploadedFile);
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
        $this->redirect($this->createAbsoluteUrl("product/index"));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $this->layout = "column1";
        $searchModel = new Product('search');       
        $dataProvider = new CActiveDataProvider('Product');
        if (isset($_GET['Product'])) {
            $searchModel->attributes = $_GET['Product'];
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
        $this->layout = "product";
        $model = new Product('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Product']))
            $model->attributes = $_GET['Product'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }
    /**
     * Allow user to define what materials are needed to create a product
     */
    public function actionRequirement($product_id)
    {
        $model = Product::model()->findByPk($product_id);
        if ($model) {
            if (Yii::app()->request->isPostRequest) {
                if (isset($_POST['required_material_id'])) {
                    foreach ($_POST['required_material_id'] as $key => $value) {
                        $new_product_requirement = new ProductRequirement;
                        $new_product_requirement->product_id = intval($model->id);
                        $new_product_requirement->material_id = intval($_POST['required_material_id'][$key]);
                        $new_product_requirement->quantity = intval($_POST['required_material_quantity'][$key]);
                        // var_dump($new_product_requirement->attributes);
                        // die();
                        /* check if product requirement exists  with record material_id and product_id*/
                        $criteria = new CDbCriteria;
                        $criteria->compare("product_id",$model->id);
                        $criteria->compare("material_id",$_POST['required_material_id'][$key]);
                        /*if exists , update the quantity instead*/
                        if (ProductRequirement::model()->exists($criteria)) {
                            $oldProductRequirement = ProductRequirement::model()->find($criteria);
                            $oldProductRequirement->quantity += intval($_POST['required_material_quantity'][$key]);
                            $oldProductRequirement->save();
                        }else{
                            /*else save new */
                            $new_product_requirement->save();
                        }
                    }                
                }
                Yii::app()->user->setFlash("success","Settings saved!");
                $this->redirect(array('view', 'id' => $model->id));
            }
        }else{
            throw new CHttpException(404,"Product doesnt exists in the database");
        }
        $this->render('requirement', compact('model'));
    }
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Product the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Product::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Product $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
