<?php

namespace frontend\controllers;

use common\models\User;
use common\models\Visit;
use DateTime;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * VisitController implements the CRUD actions for Visit model.
 */
class VisitController extends Controller
{

	/**
	 * @return array|\string[][]|\string[][][][]
	 */
    public function behaviors(): array
	{
		return array_merge(
			parent::behaviors(),
			[
				'verbs' => [
					'class' => VerbFilter::class,
					'actions' => [
						'delete' => ['POST'],
					],
				],
				'access' => [
					'class' => AccessControl::class,
					'rules' => [
						[
							'actions' => ['logout', 'index', 'create', 'view', 'update', 'delete'],
							'allow' => true,
							'roles' => ['@'],
						],
					],
				],
			]
		);
    }

    /**
     * Lists all Visit models.
     *
     * @return string
     */
    public function actionIndex(): string
	{
        $dataProvider = new ActiveDataProvider([
			'query' => Visit::find(),
			'pagination' => [
				'pageSize' => 50,
			],
			'sort' => [
				'defaultOrder' => [
					'id' => SORT_DESC,
				],
			],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
//		$searchModel = new VisitSearch();
//		$dataProvider = $searchModel->search($this->request->queryParams);
//		return $this->render('index', [
//				'searchModel' => $searchModel,
//				'dataProvider' => $dataProvider,
//		]);

    }

    /**
     * Displays a single Visit model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id): string
	{
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Visit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Visit();

		if ($this->request->isPost) {
			if ($model->load($this->request->post())) {
				$objDate = DateTime::createFromFormat(User::FORMAT_DATE, date(User::FORMAT_DATE));
				$model->visit_date = $objDate->format('U');

//				myDebug($model);

				if ($model->save()) {
					return $this->redirect(['view', 'id' => $model->id]);
				}
			}
		} else {
			$model->loadDefaultValues();
		}

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Visit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id ID
     *
	 * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Visit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Visit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Visit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Visit::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
