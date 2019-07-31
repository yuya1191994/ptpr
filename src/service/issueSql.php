<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/util/DB/columnNameConst.php");

/*
 * 処理に必要なSQLを発行する。
 */
class IssueSql
{
    /*
     * ログイン時のバインド前select文を返却する。
     */
    public function issueAdminLoginQuery() {
        $utilConst       = new UtilConst();
        $loginSql = "select LOGIN_ID from ".$utilConst::TBNAME_LOGIN." where `LOGIN_ID` = ? and `LOGIN_PASSWORD` = ?";
        return $loginSql;
    }

    /*
     * select文を生成する。
     * 引数なしの場合は全文検索
     */
    public function issueSelectQuery(array $wheres = null, string $orderBy = null, int $displayedResult = null, int $currentPage = null, string $roll = null) {
        // where句を生成
        $whereSql = $this->issueWhere($wheres, $roll);
        // orderby句を生成
        $orderBySql = $this->issueOrderBy($orderBy);
        // limit句を生成
        $limitSql = $this->issueLimit($displayedResult, $currentPage);

        // selectするカラム名を生成
        $columnNameConst = new ColumnNameConst();
        $utilConst       = new UtilConst();
        $columns = $columnNameConst::ROOM_INFO_PYSICAL_NAMES;
        $columns_str = implode(",", $columns);

        $sql = "select " . $columns_str . " from " . $utilConst::TBNAME_ROOM . " " . $whereSql . " " . $orderBySql. " ".$limitSql;

        return $sql;
    }

    /*
     * where句のみ生成する
     */
    private function issueWhere(array $wheres = null, string $roll = null) {
        $whereSql = '';

        // ユーザー画面のwhere文生成
        if ($roll == "user") {
            $whereSql = " where `RELEASE_FLAG` = 1 ";
            if (!empty($wheres) && count($wheres) > 0) {
                $whereSql .= ' and ';
                // パラメータ分繰り返す
                foreach ($wheres as $key => $where) {
                    // チェックボックスの配列型のパラメータはorで複数検索
                    if (gettype($where) == "array") {
                        $whereSql .= "(";
                        foreach ($where as $arridx => $whereIdx) {
                            // 建物構造の時のみlike検索
                            if ($key == "BUILDING_TYPE") {
                                $whereSql .= "`" . $key . "` like '%$whereIdx%' or ";
                            } else {
                                $whereSql .= "`" . $key . "` = '$whereIdx' or ";
                            }
                            if ($arridx == count($where) - 1) {
                                $whereSql = substr($whereSql, 0, - 4);
                                $whereSql .= ") and ";
                            }
                        }
                    } else {
                        switch($key) {
                            case "MINUTES_WALKING":
                                $whereSql.= "`" . $key . "` <= $where and ";
                                break;

                            case "BUILDING_YEAR":
                                $whereSql.= "`" . $key . "` >= $where and ";
                                break;

                            case "RENT":
                                // 家賃範囲を分割
                                $rents = explode(';', $where);
                                $whereSql.= "`" . $key . "` between  $rents[0] and $rents[1] and ";
                                break;

                            case "FREE_WORD":
                                // 単語ごとにlike検索をかける
                                $and_or = $wheres['AND_OR_SEARCH'];
                                $whereArr = explode(" ", $where);
                                $whereSql .= "(";
                                foreach ($whereArr as $i => $word) {
                                    $whereSql .= "`" . $key . "` like '%$word%' ";
                                    if ($i != count($whereArr) - 1) {
                                        $whereSql .= $and_or;
                                    }
                                }
                                $whereSql .= ") and ";
                                break;

                            case "AND_OR_SEARCH" :
                                // ただのフリーワード検索のオプション項目なので無視
                                break;

                            case "FREE_WORD_MINUS":
                                // 単語ごとにnot like検索をかける
                                $whereArr = explode(" ", $where);
                                $whereSql .= "(";
                                foreach ($whereArr as $i => $word) {
                                    $whereSql .= "`FREE_WORD` not like '%$word%' ";
                                    if ($i != count($whereArr) - 1) {
                                        $whereSql .= "and";
                                    }
                                }
                                $whereSql .= ") and ";
                                break;

                            default:
                                $whereSql .= "`" . $key . "` = '$where' and ";
                                break;
                        }

                    }
                }
                // 最後のandを削除
                $whereSql = substr($whereSql, 0, - 5);
            }
        // 管理画面のwhere文生成
        } else if ($roll == "admin") {
            if (!empty($wheres) && count($wheres) > 0) {
                $whereSql = ' where ';
                foreach ($wheres as $key => $where) {
                    if (gettype($where) == "array") {
                        $whereSql .= "(";
                        foreach ($where as $arridx => $whereIdx) {
                            $whereSql .= "`" . $key . "` = '$whereIdx' or ";
                            if ($arridx == count($where) - 1) {
                                $whereSql = substr($whereSql, 0, - 4);
                                $whereSql .= ") and ";
                            }
                        }
                    } else {
                        $whereSql .= "`" . $key . "` = '$where' and ";
                    }
                }
                // 最後のandを削除
                $whereSql = substr($whereSql, 0, - 5);
            }
        }
        return $whereSql;
    }

    private function issueOrderBy(string $orderBy = null) {
        $orderBySql = '';
        if (! empty($orderBy)) {
            if (strpos($orderBy, "ASC")) {
                $orderBy = str_replace("_ASC", "", $orderBy);
                $orderBySql = "order by `$orderBy` asc";
            }
            if (strpos($orderBy, "DESC")) {
                $orderBy = str_replace("_DESC", "", $orderBy);
                $orderBySql = "order by `$orderBy` desc";
            }
        }
        return $orderBySql;
    }

    private function issueLimit(int $displayedResult = null, int $currentPage = null) {
        $limitSql = '';
        if ($displayedResult != null && $currentPage != null) {
            $limitSql = "limit ".(($currentPage - 1) * $displayedResult).",".($currentPage * $displayedResult);
        }
        return $limitSql;
    }

    /*
     * データ洗い替えのためのSQL群を発行する。
     * 新着物件をinsertし、募集終了物件をdeleteする。
     * @return revarsalEntrieSQLArray 洗い替えのためのSQLの配列
     */
    public function issueReversalEntriesSql(array $jsonDataFromCsv, array $jsonDataFromDB)
    {
        $columnNameConst = new ColumnNameConst();
        $utilConst       = new UtilConst();
        // 戻り値として返す洗い替えSQLのマップ
        $revarsalEntrieSQLMap = array();
        // csvとDBのキーの共通項を在庫物件として取得する
        $stockProperty = array_intersect_key($jsonDataFromCsv, $jsonDataFromDB);
        // 新着物件の取得
        foreach ($jsonDataFromCsv as $key => $val) {
            if ($key == key($stockProperty)) {
                // 在庫物件は新着フラグを下ろす
                $updateSql = "update `".$utilConst::TBNAME_ROOM."` set `NEW_ARRIVAL_FLAG` = 0".
                              " where `".$columnNameConst::ROOM_INFO_PRIMARY_KEY."` = $key";
                $revarsalEntrieSQLMap[$key] = $updateSql;
                next($stockProperty);
            } else {
                $insertValStr = implode('","', $val);
                $insertSql = "insert into ".$utilConst::TBNAME_ROOM." values (\"$insertValStr\")";
                $insertSql = str_replace('""', "default", $insertSql);
                $revarsalEntrieSQLMap[$key] = $insertSql;
            }
        }
        // ポインタをリセット
        reset($stockProperty);
        // 募集終了物件の取得
        foreach ($jsonDataFromDB as $key => $val) {
            if ($key == key($stockProperty)) {
                // 在庫物件は無視
                next($stockProperty);
            } else {
                $deleteSql = 'delete from `'.$utilConst::TBNAME_ROOM.'`
                              where `'.$columnNameConst::ROOM_INFO_PRIMARY_KEY."` = $key";
                $revarsalEntrieSQLMap[$key] = $deleteSql;
            }
        }
        return $revarsalEntrieSQLMap;
    }

    /*
     * 物件情報更新時のupdateSQL群を発行する。
     * @param $propertyInfo 管理画面で入力された物件情報
     *        $pKey 更新対象のプライマリキー
     * @return $updateSQL update文
     */
    public function updatePropertyInfo(array $propertyInfo, string $pKey) {
        $updateSql = "update `ROOM_INFO` set ";
        foreach ($propertyInfo as $key => $val) {
            $updateSql .= "`$key` = '$val' ,";
        }
        // 最後のカンマを除去
        $updateSql = substr($updateSql, 0, -1);

        $updateSql .= "where `PROPERTY_ID` = $pKey";

        return $updateSql;
    }

    /*
     * 物件情報削除時のdeleteSQLを発行する。
     * @param $pKey 削除対象のプライマリキー
     * @return $deleteSQL delete文
     */
    public function deletePropertyInfo(string $pKey) {
        $deleteSql = "delete from `ROOM_INFO` where `PROPERTY_ID` = $pKey ";
        return $deleteSql;
    }
}