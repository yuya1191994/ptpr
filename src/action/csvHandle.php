<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/src/util/DB/columnNameConst.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/src/service/convertCsvFile.php");

class CsvHandle
{

    // public $insertFlg = false;
    public function extractCsvFile(array $filePaths)
    {
        if (empty($filePaths[0])) {
            return;
        }

        // csvデータを最終的な形で格納する配列
        $fileDataList = array();
        // csvファイルが格納されているパス
        $prefixPath = $_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/csv/";

        foreach ($filePaths as $filePath) {
            if (! empty($filePath)) {
                $filePath = $prefixPath . $filePath;

                // csvファイルの読み込み
                $file = new SplFileObject($filePath, 'rb');
                $file->setFlags(SplFileObject::READ_CSV);
                // カラムヘッダ名を格納する配列
                $columnHeaderList = array();

                // 現在行番号
                $currentRow = 0;

                // 1行ずつ値を取得する
                foreach ($file as $key => $line) {
                    if (empty($line[0])) {
                        continue;
                    }
                    // SJIS->UTF8にエンコード
                    $line = mb_convert_encoding($line, 'UTF-8', 'SJIS');

                    // カラムに漢数字の一と十が単一文字で存在していたら勝手にエスケープされて不具合を起こすので、
                    // それが存在するレコードは削除して無視。
                    if (preg_grep("/^―\"/", $line) || preg_grep("/^十\"/", $line)) {
                        unset($line);
                        continue;
                    }

                    // 1行のカラム数
                    $cnt = count($line);
                    // カラムのヘッダ名を取得する
                    if ($currentRow == 0) {
                        for ($i = 0; $i < $cnt; $i ++) {
                            array_push($columnHeaderList, $line[$i]);
                        }
                        $currentRow ++;
                        continue;
                    }
                    // 現在行のデータを格納する連想配列
                    $currentRowDataMap = array();
                    $columnNameConst = new ColumnNameConst();
                    $convertCsvFile = new ConvertCsvData();

                    for ($i = 0; $i < $cnt; $i ++) {
                        if (array_search($i, $columnNameConst::USE_COLUMN) !== FALSE) {
                            $line[$i] = $convertCsvFile->convertColumnData($columnHeaderList[$i], $line[$i]);
                            if ($columnHeaderList[$i] == "間取タイプ（1）") {
                                // 間取部屋数と間取タイプを結合して間取を示す
                                $currentRowDataMap[$columnHeaderList[$i]] = $line[$i + 1] . $line[$i];
                            } else {
                                $currentRowDataMap[$columnHeaderList[$i]] = $line[$i];
                            }
                        }
                    }

                    // 敷金・礼金・補償金なしの物件のみ格納する
                    if (empty($currentRowDataMap["礼金1（額）"]) && empty($currentRowDataMap["礼金2（ヶ月）"]) && empty($currentRowDataMap["敷金1（額）"]) && empty($currentRowDataMap["敷金2（ヶ月）"]) && empty($currentRowDataMap["保証金1（額）"]) && empty($currentRowDataMap["保証金2（ヶ月）"])) {
                        $currentRowDataMap["FAX番号"] = null;
                        $currentRowDataMap["画像データ"] = 0;
                        $currentRowDataMap["掲載フラグ"] = 0;
                        $currentRowDataMap["ADフラグ"] = 0;
                        $currentRowDataMap["新着フラグ"] = 1;
                        $currentRowDataMap["おすすめフラグ"] = 0;
                        $currentRowDataMap["いいね数"] = 0;
                        $currentRowDataMap["メモ"] = null;
                        $currentRowDataMap["登録日"] = date("Y-m-d H:i:s");
                        $currentRowDataMap["最終更新日"] = date("Y-m-d H:i:s");
                        $currentRowDataMap["フリーワード検索"] = $currentRowDataMap["都道府県名"].$currentRowDataMap["所在地名1"].$currentRowDataMap["所在地名2"].$currentRowDataMap["所在地名3"].$currentRowDataMap["建物名"].$currentRowDataMap["沿線略称（1）"].$currentRowDataMap["駅名（1）"].$currentRowDataMap["建物構造"].$currentRowDataMap["備考2"];
                        // キー名を論理名から物理名に書き換える
                        $replaceMap = array();
                        $pysicalName = $columnNameConst::ROOM_INFO_PYSICAL_NAMES;
                        $arrayValue = array_values($currentRowDataMap);
                        for ($i = 0; $i < count($currentRowDataMap); $i ++) {
                            $replaceMap[$pysicalName[$i]] = $arrayValue[$i];
                        }
                        // 現在行のデータを格納する。添字キーはプライマリキー
                        $fileDataList[$replaceMap[$columnNameConst::ROOM_INFO_PRIMARY_KEY]] = $replaceMap;
                    }
                }
                $file = null;
            }
            // var_export($fileDataList);
            return $fileDataList;
        }
    }
}
