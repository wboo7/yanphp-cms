<?php
/*
 *   内容模型  动态的
 * */
namespace common\models;

use common\libs\Bridge;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\data\Pagination;
use yii\helpers\Url;
use common\models\CategoryContent;
use common\models\Model;
use common\models\Position;
use common\libs\Yanphp;
use yii\widgets\LinkPager;
use yii\base\ErrorException;
use yii\behaviors\TimestampBehavior;


/**
 * 内容模型
 */
class Content extends ActiveRecord
{

    public $file;
    public $filePhoto;

    const STATUS_ONCHECK = 0;
    const STATUS_OK = 1;
    const STATUS_UNOK = 2;


    public function rules()
    {
        return [
            //新闻表规则
            [['catid', 'title', 'content', 'status'], 'required', 'on' => 'news'],


            /* 图片表 */
            [['catid', 'title', 'status'], 'required', 'on' => 'picture'],


            /* 视频 */
            [['catid', 'title', 'status', 'videourl'], 'required', 'on' => 'video'],


            ['file', 'file', 'mimeTypes' => 'image/jpeg,image/jpg,image/png,image/gif', 'maxSize' => 2 * 1024 * 1024, 'tooBig' => '图片不能超过2M'],
            ['filePhoto', 'file', 'mimeTypes' => 'image/jpeg,image/jpg,image/png,image/gif', 'maxSize' => 2 * 1024 * 1024, 'tooBig' => '图片不能超过2M'],

            ['listorder', 'default', 'value' => 0],

            [['ext1', 'ext2', 'ext3', 'ext4', 'ext5'], 'string', 'max' => 150]

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => Yii::t('app','Author'),
            'catid' => Yii::t('app','Category'),
            'title' => Yii::t('app','Title'),
            'thumb' => Yii::t('app','Thumb'),
            'keywords' => Yii::t('app','Keyword'),
            'description' => Yii::t('app','Description'),
            'content' => Yii::t('app','Content'),
            'status' => Yii::t('app','Status'),
            'created_at' => Yii::t('app','Created_at'),
            'updated_at' =>Yii::t('app','Updated_at'),
            'listorder' => Yii::t('app','Sort'),
            'videourl' => Yii::t('app','Video Link'),
            'click' => Yii::t('app','Click'),
            'ext1' => Yii::t('app','Ext1'),
            'ext2' => Yii::t('app','Ext2'),
            'ext3' => Yii::t('app','Ext3'),
            'ext4' => Yii::t('app','Ext4'),
            'ext5' => Yii::t('app','Ext5'),
        ];
    }

    public function behaviors()
    {

        return [
            TimestampBehavior::className(),
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['news'] = [
            'id',
            'uid',
            'catid',
            'title',
            'thumb',
            'keywords',
            'description',
            'listorder',
            'status',
            'created_at',
            'updated_at',
            'content',
            'ext1',
            'ext2',
            'ext3',
            'ext4',
            'ext5',
        ];
        $scenarios['picture'] = [
            'id',
            'uid',
            'catid',
            'title',
            'thumb',
            'keywords',
            'description',
            'listorder',
            'status',
            'created_at',
            'updated_at',
            'content',
            'ext1',
            'ext2',
            'ext3',
            'ext4',
            'ext5',
        ];
        $scenarios['video'] = [
            'id',
            'uid',
            'catid',
            'title',
            'thumb',
            'videourl',
            'keywords',
            'description',
            'listorder',
            'status',
            'create_at',
            'updatet',
            'content',
            'ext1',
            'ext2',
            'ext3',
            'ext4',
            'ext5',
        ];
        return $scenarios;
    }


    public static function tableName()
    {
        return '{{%content}}';
    }

    public static function deleteModel($model)
    {

        if ($model->photos) {
            foreach ($model->photos as $photo) {
                $photo->delete();
            }
        }
        if ($model->position) {
            foreach ($model->position as $position) {
                $position->delete();
            }
        }
        $model->delete();
    }

    public function getPosition()
    {
        return $this->hasMany(Position::className(), ['contentid' => 'id']);
    }

    public function getPhotos()
    {
        return $this->hasMany(Photos::className(), ['contentid' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(CategoryContent::className(), ['id' => 'catid']);
    }

    //.标签调用 列表
    public function lists($datas)
    {
        if (!isset($datas['catid'])) {
            return [];
        }
        $ids = CategoryContent::getCatIds($datas['catid']);
        $query = self::find();
        $order = isset($datas['order']) ? $datas['order'] : 'id DESC';
        $query->andWhere(['in', 'catid', $ids]);

        $totalCount = $query->count();
        $pages = new Pagination([
            'totalCount' => $totalCount,
            'validatePage' => false
        ]);
        $num = isset($datas['num']) ? intval($datas['num']) : 20;
        $pages->setPageSize($num);

        $lists = $query
            ->asArray()
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy($order)
            ->all();


        if ($lists) {
            foreach ($lists as $k => $v) {

                $lists[$k]['category'] = CategoryContent::getInfo($v['catid']);
                $lists[$k]['url'] = Url::to(['/show/' . $v['id']]);
                $thumbFile = Bridge::getRootPath() . 'uploads/content/' . $v['thumb'];

                if (is_file($thumbFile)) {

                    $size = getimagesize($thumbFile);
                    $lists[$k]['heightWidth'] = round($size[1] / $size[0], 3);
                }
                $lists[$k]['thumb'] = Content::getThumbUrl($v['thumb']);
            }
        }

        return [
            'lists' => $lists,
            'pages' => $this->formatPageStr($pages,$datas)
        ];
    }


    //.标签调用 幻灯轮播
    public function banner($params)
    {
        $query = Banner::find()
            ->where(['status' => 1]);
        if (isset($params['listorder']) && $params['listorder']) {
            $query->orderBy($params['listorder']);
        } else {
            $query->orderBy('listorder ASC,id ASC');
        }
        $lists = $query
            ->asArray()
            ->all();
        if ($lists) {
            foreach ($lists as $k => $v) {
                $lists[$k]['img'] = Bridge::getRootUrl() . 'uploads/banner/' . $v['filepath'];
            }
        }
        return $lists;
    }

    //.标签调用 幻灯轮播
    public function friend($params)
    {
        $query = Friend::find()
            ->where(['status' => 1]);
        if (isset($params['listorder']) && $params['listorder']) {
            $query->orderBy($params['listorder']);
        } else {
            $query->orderBy('listorder ASC,id ASC');
        }
        if (isset($params['num']) && $params['num']) {
            $query->limit($params['num']);
        }
        $lists = $query
            ->asArray()
            ->all();
        if ($lists) {
            foreach ($lists as $k => $v) {
                $lists[$k]['img'] = Bridge::getRootUrl() . 'uploads/friend/' . $v['filepath'];
            }
        }
        return $lists;
    }

    //标签调用 推荐位
    public function position($datas)
    {

        $posid = intval($datas['posid']);
        $order = isset($datas['listorder']) ? $datas['listorder'] : 'id DESC';

        $query = Position::find();
        $query
            ->asArray()
            ->where(['pid' => $posid])
            ->orderBy($order);

        if (isset($datas['num']) && $datas['num'])
            $query->limit(intval($datas['num']));

        $lists = $query
            ->all();

        foreach ($lists as $k => $v) {
            $lists[$k]['url'] = Url::to(['show', 'id' => $v['contentid']]);
            $content = self::findOne($v['contentid']);
            $lists[$k]['thumb'] = $this->getThumbUrl($content->thumb);
            $lists[$k]['title'] = $content->title;
        }

        return [
            'lists' => $lists,
        ];
    }

    //.搜索
    public function s($params)
    {

        $num = isset($params['num'])?$params['num']:15;
        $query = self::find();
        if ($params['catid'])
            $query->andWhere(['catid' => $params['catid']]);
        $query->andWhere(['like', 'title', $params['title']]);
        $totalCount = $query->count();
        $pages = new Pagination(['totalCount' => $totalCount]);
        $pages->setPageSize($num);
        $lists = $query
            ->asArray()

            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('id DESC')
            ->all();
        if($lists)
        {
            foreach($lists as $k=>$v)
            {
                $lists[$k]['url'] = Url::to(['show', 'id' => $v['id']]);
                $lists[$k]['category'] = CategoryContent::getInfo($v['catid']);
            }
        }


        return [
            'lists' => $lists,
            'pages' => $this->formatPageStr($pages,$params)
        ];
    }
    protected function formatPageStr($pages,$params)
    {
        //.page
        $pageStyle = isset($params['pageStyle']) ? $params['pageStyle'] : 'pagination';
        $nextPageLabel = isset($params['nextPageLabel']) ? $params['nextPageLabel'] : '&raquo;';
        $prevPageLabel = isset($params['prevPageLabel']) ? $params['prevPageLabel'] : '&laquo;';
        return LinkPager::widget([
            'pagination' => $pages,
            'options' => ['class' => $pageStyle],
            'nextPageLabel' => $nextPageLabel,
            'prevPageLabel' => $prevPageLabel,
            'linkOptions' => isset($params['ajax']) ? ['class' => 'ajax-pagination', 'data-ajax-container' => $params['ajax']] : []
        ]);
    }

    //标签调用 get
    public function get($datas)
    {
        if (!$datas['sql'])
            return [];


        $command = Yii::$app->db->createCommand($datas['sql']);
        $lists = $command->queryAll();


//        foreach ($lists as $k => $v) {
//            $lists[$k]['url'] = Url::to(['show', 'catid' => $v['catid'], 'id' => $v['contentid']]);
//            $modelInfo = self::getModelByCatid($v['catid']);
//            Content::setTable($modelInfo['tablename']);
//            $content = Content::findOne($v['contentid']);
//            $lists[$k]['thumb'] = Url::to('@web/' . $content->thumb, true);
//        }

        return [
            'lists' => $lists,
        ];
    }

    public function show($catid, $id)
    {
        $modelInfo = self::getModelByCatid($catid);

        $query = self::find();
        $data = $query
            ->asArray()
            ->where(['id' => $id])
            ->one();
        return [
            'template' => $modelInfo['show_template'],
            'data' => $data
        ];
    }


    public function category($datas)
    {
        $ismenu = (isset($datas['ismenu']) && $datas['ismenu']) ? true : false;
        if (!isset($datas['pid']))
            throw new ErrorException('缺少pid参数');
        $datas['pid'] = str_replace('，', ',', $datas['pid']);

        $result = CategoryContent::getConstruct();


        foreach ($result as $k => $v) {
            if ($ismenu && !$v['ismenu']) {
                unset($result[$k]);
            }
        }


        $lists = [];

        if (strpos($datas['pid'], ',') !== false) {

            $pids = explode(',', $datas['pid']);
            foreach ($pids as $v) {
                foreach ($result as $v2) {
                    if ($v2['id'] == $v)
                        $lists[] = $v2;
                }
            }
        } else {

            foreach ($result as $v2) {
                if ($datas['pid'] == 0) {
                    if ($v2['parentid'] == $datas['pid'])
                        $lists[] = $v2;
                } else {
                    if ($v2['parentid'] == $datas['pid'])
                        $lists[] = $v2;
                }

            }

        }

        return [
            'lists' => $lists
        ];


    }

    public static function getModelByCatid($catid)
    {
        $info = (new Query())
            ->from(['a' => CategoryContent::tableName()])
            ->select(['a.modelid', 'a.catname', 'b.tablename', 'b.*'])
            ->leftJoin(['b' => Model::tableName()], 'a.modelid = b.id')
            ->where(['a.id' => $catid])
            ->one();
        return $info;

    }


    /*
     * 搜索
     * */
    public static function search($catid)
    {
        $data = Yii::$app->request->get();
        $search_type = Yii::$app->request->get('search_type');
        $q = Yii::$app->request->get('q');
        $status = Yii::$app->request->get('status', '');
        $start_time = Yii::$app->request->get('start_time');
        $end_time = Yii::$app->request->get('end_time');
        $query = self::find();
        $query->where(['catid' => $catid]);

        if ($start_time) {
            $query->andWhere(['>', 'created_at', strtotime($start_time)]);
        }
        if ($end_time) {
            $query->andWhere(['<', 'created_at', strtotime($end_time)]);
        }

        switch ($search_type) {
            case 1:
                if ($q)
                    $query->andWhere(['like', 'title', $q]);
                break;
            case 2;
                if ($q)
                    $query->andWhere(['id' => $data['q']]);
                break;
        }

        if ($status !== '')
            $query->andWhere(['status' => $status]);

        $count = $query->count();


        $pages = new Pagination(['totalCount' => $count]);
        $pages->setPageSize(10);

        $lists = $query
            ->asArray()
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->with('position')
            ->orderBy('listorder DESC,id DESC')
            ->all();

        return [

            'lists' => $lists,
            'pages' => $pages,
            'count' => $count
        ];


    }

    /**
     * 分页统计
     * @param $data
     */
    public function count($data)
    {
        if ($data['action'] == 'lists') {
            $catid = intval($data['catid']);
            $modelInfo = self::getModelByCatid($catid);
            $query = new Query();

            $total = $query
                ->from('{{%' . $modelInfo['tablename'] . '}}')
                ->where(['catid' => $data['catid']])
                ->count();
            return $total;
        }
    }

    public static function findModel($id, $modelInfo)
    {
        self::setTable($modelInfo['tablename']);
        return self::findOne($id);
    }

    /*-- 模块 留言 --*/
    public function msg()
    {
        $connection = Yii::$app->db;
        $listData = $connection->createCommand("SHOW full FIELDS FROM {{%msg}}")->queryAll();
        return $listData ? $listData : [];

    }

    public static function getThumbUrl($path, $default = 'statics/admin/images/thumb.png')
    {
        $rootUrl = Bridge::getRootUrl();
        if ($path) {
            if (strncmp($path, 'data', 4) == 0) {
                return $rootUrl . $path;
            } else {
                return $rootUrl . 'uploads/content/' . $path;
            }
        } else {
            return Yii::getAlias('@web/') . $default;
        }

    }

    public function getBannerImg($path, $default = 'statics/common/images/thumb.png')
    {
        $rootUrl = Bridge::getRootUrl();
        if ($path) {
            if (strncmp($path, 'data', 4) == 0) {
                return $rootUrl . $path;
            } else {
                return $rootUrl . 'uploads/banner/' . $path;
            }
        } else {
            return $rootUrl . $default;
        }
    }


}
