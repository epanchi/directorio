<?php

class DiasentregaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view'),
                'roles'=>array('adm'),
                //'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
                'roles'=>array('adm'),
                //'users'=>array('@'),
			),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('createDialog'),
                'roles'=>array('adm','cons','pyme'),
            ),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
                'roles'=>array('adm'),
			),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('delete'),
                'roles'=>array('pyme'),
                //'users'=>array('admin'),
            ),
			array('deny',  // deny all users
				'users'=>array('index','*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Diasentrega;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        // Nueva líneas
        $modelRegistros = new Registros('search');
        $modelRegistros->unsetAttributes();
        if (isset($_GET['Registros']))
            $modelRegistros->attributes = $_GET['Registros'];
        // ----

		if(isset($_POST['Diasentrega']))
		{
			$model->attributes=$_POST['Diasentrega'];
			if($model->save())
            {
                Yii::app()->user->setFlash('success',Yii::app()->params['saveSuccess']);

				//CRUDMODIFICATION 
                                $this->redirect(array('view','id'=>$model->id));
                }
		}
		$this->render('create',array(
			'model'=>$model,
            'modelRegistros' => $modelRegistros,   // Nueva Línea
		));
	}

    public function actionCreateDialog($id)
    {
        $model=new Diasentrega;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);



        if(isset($_POST['Diasentrega']))
        {
            $model->attributes=$_POST['Diasentrega'];
            if($model->save())
            {
                if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status'=>'success',
                        'div'=>"Registro agregado éxitosamente"
                    ));
                    exit;
                }
                else
                //CRUDMODIFICATION
                $this->redirect(array('view','id'=>$model->id));
            }
        }
        if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'failure',
                'div'=>$this->renderPartial('_formDialog', array('model'=>$model,'id'=>$id), true)));
            exit;
        }
        else
            $this->render('create',array('model'=>$model,));

    }

    //==========================================
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Diasentrega']))
		{
			$model->attributes=$_POST['Diasentrega'];
			if($model->save())
                                 //CRUDMODIFICATION 
                $this->redirect(array('pymes/view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
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

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Diasentrega');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Diasentrega('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Diasentrega']))
			$model->attributes=$_GET['Diasentrega'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
               //CRUDMODIFICATION 
                
		$model=Diasentrega::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='diasentrega-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
