<?php

// Composerのオートローダーを読み込む
require 'vendor/autoload.php';

// EasyUIBuilderの名前空間を使用
use GoldRush\EasyUIBuilder\elements\Image;
use GoldRush\EasyUIBuilder\elements\Label;
use GoldRush\EasyUIBuilder\elements\Panel;
use GoldRush\EasyUIBuilder\Root;
use GoldRush\EasyUIBuilder\utils\color\BasicColor;

// ----- ここからEasyUIBuilderのコード -----
$root = Root::create("common_test");

$panel = Panel::create("test_panel");
$panel->setSize(400, 200);
$panel->addChild(Label::create("title", "GoldRush")
    ->setFontType(Label::TYPE_MINECRAFT_TEN)
    ->setFontSize(Label::FONT_EXTRA_LARGE)
    ->setAnchorTo(Label::ANCHOR_TO_TOP_MIDDLE)
    ->setAnchorFrom(Label::ANCHOR_FROM_TOP_MIDDLE)
    ->setColor(BasicColor::yellow())
    ->setOffset(0, -45)
    ->setLayer(0)
    ->addChild(Label::create("title_shadow", "GoldRush")
        ->setFontType(Label::TYPE_MINECRAFT_TEN)
        ->setFontSize(Label::FONT_EXTRA_LARGE)
        ->setAnchorTo(Label::ANCHOR_TO_TOP_MIDDLE)
        ->setAnchorFrom(Label::ANCHOR_FROM_TOP_MIDDLE)
        ->setColor(BasicColor::black())
        ->setOffset(4, 2)
        ->setLayer(-1)
        ->setAlpha(0.7)
    )
);
$panel->addChild(Image::create("background", "textures/ui/bg")
    ->setSizePercentage(100, 100)
    ->setAlpha(0.8)
);
$root->addElement($panel);
// ----- ここまでEasyUIBuilderのコード -----


// ブラウザにContent-TypeがJSONであることを伝える
header('Content-Type: application/json; charset=utf-8');

// JSONをファイルに保存する代わりに、文字列として生成し、echoで出力する
// prettyPrint() を使うと整形されて見やすくなる
echo $root->generateJson()->prettyPrint();
