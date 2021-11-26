<?php
namespace app\controllers;

use app\models\Activity;
use JsonRpc2\Controller;
use JsonRpc2\Exception;
use yii\db\Expression;

class ApiController extends Controller
{
    /**
     * @param string $url
     * @param string $date
     *
     * @return bool
     * @throws Exception
     */
    public function actionLogActivity($url, $date)
    {
        $model = new Activity();
        $model->setAttributes(['url' => $url, 'date' => $date]);

        if (!$model->validate()) {
            throw new Exception('Invalid parameters', Exception::INVALID_PARAMS, $model->getErrors());
        }

        $model->save();

        return true;
    }

    /**
     * @param int $page
     */
    public function actionGetActivities($page)
    {
        $limit = 5;

        if ($page < 1) {
            $page = 1;
        }

        $query = Activity::find()
            ->select(['url', new Expression('MAX(`date`) as lastVisit'), new Expression('COUNT(*) as count')])
            ->groupBy('url');

        return [
            'total' => $query->count(),
            'items' => $query->limit($limit)
                ->offset($limit * $page - $limit)
                ->asArray()->all()
        ];
    }
}
