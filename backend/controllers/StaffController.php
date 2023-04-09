<?php

namespace backend\controllers;

use common\models\Staff;
use common\models\User;
use DateTime;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * StaffController implements the CRUD actions for Staff model.
 */
class StaffController extends Controller
{
	/**
	 * @return array|\bool[][][][]|\string[][]|\string[][][][]|\string[][][][][]|\yii\filters\AccessControl[][]
	 */
    public function behaviors(): array
	{
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
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
     * Lists all Staff models.
     *
     * @return string
	 */
    public function actionIndex(): string
	{
        $dataProvider = new ActiveDataProvider([
            'query' => Staff::find(),
            'pagination' => [
				'pageSize' => 50
			],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Staff model.
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
     * Creates a new Staff model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Staff();

        if ($this->request->isPost) {
			if ($model->load($this->request->post())) {
				$objDate = DateTime::createFromFormat(User::FORMAT_DATE,date(User::FORMAT_DATE));
				$model->created_at = $objDate->format('U');
				$model->updated_at = (int)$objDate->format('U');
				$model->generateAuthKey();
				$model->setPassword($model->password);
				$model->generateEmailVerificationToken();
				if ($model->save()) {
					$this->sendEmail($model);
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
     * Updates an existing Staff model.
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

		if ($this->request->isPost) {
			if ($model->load($this->request->post())) {
				$objDate = DateTime::createFromFormat(User::FORMAT_DATE,date(User::FORMAT_DATE));
				$model->updated_at = (int)$objDate->format('U');
				if ($model->save()) {
					return $this->redirect(['view', 'id' => $model->id]);
				}
			}
		}

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Staff model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id): Response
	{
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Staff model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Staff the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Staff
	{
        if (($model = Staff::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

	/**
	 * Sends confirmation email to user
	 * @param User $user user model to with email should be send
	 * @return bool whether the email was sent
	 */
	public function sendEmail(User $user): bool
	{
		return Yii::$app
			->mailer
			->compose(
				['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
				['user' => $user]
			)
			->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
			->setTo($user->email)
			->setSubject('Регистрация аккаунта ' . Yii::$app->name)
			->send();
	}
}
