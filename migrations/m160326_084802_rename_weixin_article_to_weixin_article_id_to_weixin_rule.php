<?php

use yii\db\Migration;

class m160326_084802_rename_weixin_article_to_weixin_article_id_to_weixin_rule extends Migration
{
    public function up()
    {
        $this->renameColumn('weixinRule', 'weixinArticle', 'weixinArticleId');
        $this->addColumn('weixinRule', 'updatedAt', $this->dateTime());
    }

    public function down()
    {
        $this->renameColumn('weixinRule', 'weixinArticleId', 'weixinArticle');
        $this->dropColumn('weixinRule', 'updatedAt');

        return true;
    }
}
