<?php
$zip = new ZipArchive();
$res = $zip->open('test.zip', ZipArchive::CREATE);

if ($res === TRUE) {
    $zip->addFromString('test.txt', 'テスト');
    $zip->close();
    echo 'ZIPファイルの作成に成功しました。';
} else {
    echo 'ZIPファイルの作成に失敗しました。';
}
?>