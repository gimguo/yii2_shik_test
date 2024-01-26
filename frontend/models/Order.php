<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property float|null $sum
 * @property string $created_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sum'], 'number'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sum' => 'Sum',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return array
     */
    public function menuArrayItems()
    {
        $rows = (new \yii\db\Query())
            ->select([
                "date_part('year', created_at) AS year",
                "date_part('month', created_at) AS month",
                "count('month') AS monthly_count"
            ])
            ->from('public.order')
            ->groupBy(['year', 'month'])
            ->orderBy('year')
            ->all();

        $ruMounth = [
            '',
            'январь',
            'февраль',
            'март',
            'апрель',
            'май',
            'июнь',
            'июль',
            'август',
            'сентябрь',
            'октябрь',
            'ноябрь',
            'декабрь'
        ];

        $result = ArrayHelper::map($rows, 'month', 'monthly_count', 'year');
        $shikMenuItems = [];

        foreach ($result as $year => $months) {
            $items = [];
            krsort($months);
            foreach ($months as $month => $count) {
                $monthName = $ruMounth[$month];
                $items[] = ['label' => $monthName . ' (' . $count . ')',
                    'url' => ['/order/index', 'OrderSearch' => [
                        'fromDate' => date("Y-m-d H:i:s", strtotime($year . "-$month-01 0:0:0")),
                        'toDate' => date("Y-m-d H:i:s", strtotime($year . "-$month-01 +1 month -1 day 23:59:59"))
                    ]]];
            }
            $shikMenuItems[] = ['label' => $year . ' (' . array_sum($months) . ')',
                'url' => ['/order/index', 'OrderSearch' => [
                    'fromDate' => date("Y-m-d H:i:s", strtotime($year . '-01-01 0:0:0')),
                    'toDate' => date("Y-m-d H:i:s", strtotime($year . '-01-01 +1 year -1 day 23:59:59'))
                ]],
                'items' => $items];
        }
        return $shikMenuItems;
    }
}
