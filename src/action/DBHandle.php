<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/src/util/DB/connectDatabase.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/src/util/DB/utilConst.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/src/util/DB/columnNameConst.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/src/action/csvHandle.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/src/service/issueSql.php");

class DBHandle extends ConnectDatabase
{
    /*
     * ログイン用のクエリ。
     * IDとパスワードが合致すれば1を返す。
     * @param $count 合致したデータの個数
     */
    public function adminLogin(string $sql, array $wheres) {
        try {
            $columnNameConst = new ColumnNameConst();
            $utilConst = new UtilConst();
            $conn = $this->db_connect($utilConst::DB_NAME);
            if ($stmt = mysqli_prepare($conn, $sql)) {
                // バインド
                mysqli_stmt_bind_param($stmt, 'ss', $wheres['login-id'], $wheres['login-password']);
                // 実行
                mysqli_execute($stmt);
                // 結果を転送
                mysqli_stmt_store_result($stmt);
                // 結果の行数カウント
                $count = mysqli_stmt_num_rows($stmt);
                // psを閉じる
                mysqli_stmt_close($stmt);
                return $count;
            }
        } catch(exception $e) {
            echo $e;
        } finally {
            $this->db_close($conn, $utilConst::DB_NAME);
        }
    }
    /*
     * 物件を検索し、JSON形式で返却する。
     */
    public function selectReturnJson(string $sql)
    {
        try {
            $columnNameConst = new ColumnNameConst();
            $utilConst = new UtilConst();
            $columns = $columnNameConst::ROOM_INFO_PYSICAL_NAMES;
            $conn = $this->db_connect($utilConst::DB_NAME);

            if (! mysqli_set_charset($conn, 'utf8')) die('指定した文字コードは使用できません') . msqli_error($conn);

            $result = mysqli_query($conn, $sql);
            if (! $result) die('クエリ失敗 : ' . mysqli_error());

            $resultJson = array();
            while ($row = mysqli_fetch_array($result)) {
                $resultRow = array();
                for ($i = 0; $i < count($columns); $i ++) {
                    $resultRow[$columns[$i]] = $row[$i];
                }
                // 現在行のデータを格納する。添字キーはプライマリキー
                $resultJson[$resultRow[$columnNameConst::ROOM_INFO_PRIMARY_KEY]] = $resultRow;
            }
            return $resultJson;
        } catch (exception $e) {
            echo $e;
        } finally {
            $this->db_close($conn, $utilConst::DB_NAME);
        }
    }

    /*
     * 引数に渡されたSQLの全物件数を取得する
     */
    public function countProperties(string $sql) {
        try {
            $columnNameConst = new ColumnNameConst();
            $utilConst = new UtilConst();
            $conn = $this->db_connect($utilConst::DB_NAME);
            // 文字セットをUTF-8に変換
            if (! mysqli_set_charset($conn, 'utf8')) {
                die('指定した文字コードは使用できません') . msqli_error($conn);
            }
            $result = mysqli_query($conn, $sql);
            if (! $result) {
                die ("クエリ失敗 : ".mysqli_error($conn));
            }
            // 全件数を返す
            return mysqli_num_rows($result);
        } catch (exeption $e) {
            echo $e;
        } finally {
            $this->db_close($conn, $utilConst::DB_NAME);
        }
    }

    /*
     * csvで取り込んだデータ洗い替えのSQL群を実行する
     */
    public function doQuerys(array $sqls)
    {
        $utilConst = new UtilConst();
        $errMsg = '';
        try {
            $conn = $this->db_connect($utilConst::DB_NAME);
            foreach ($sqls as $sql) {
                $result = mysqli_query($conn, $sql);
                if (! $result) {
                    $errMsg .= "【エラー】一部クエリに失敗しました。　対象SQL： $sql " . mysqli_error($conn) . "<br><br>";
                }
            }
        } catch (Exception $e) {
            echo $e;
        } finally {
            $this->db_close($conn, $utilConst::DB_NAME);
        }
        return $errMsg;
    }

    /*
     * 単数行のSQLを実行する
     */
    public function doQuery(string $sql)
    {
        $utilConst = new UtilConst();
        try {
            $conn = $this->db_connect($utilConst::DB_NAME);
            $result = mysqli_query($conn, $sql);
            if (! $result) {
                die('クエリに失敗しました。' . mysqli_error($conn));
            }
        } catch (Exception $e) {
            echo $e;
        } finally {
            $this->db_close($conn, $utilConst::DB_NAME);
        }
    }

    /*
     * 従業員情報を検索し、JSON形式で返却する。
     */
    public function selectEmployeeReturnJson()
    {
        try {
            $columnNameConst = new ColumnNameConst();
            $utilConst = new UtilConst();
            $columns = $columnNameConst::EMPLOYEE_LIST_PYSICAL_NAMES;
            $conn = $this->db_connect($utilConst::DB_NAME);

            // 文字セットをUTF-8に変換
            if (! mysqli_set_charset($conn, 'utf8')) {
                die('指定した文字コードは使用できません') . msqli_error($conn);
            }

            $sql = "select `EMPLOYEE_ID`, `EMPLOYEE_NAME`, `EMPLOYEE_YOMI`, `EMPLOYEE_JOB`, `EMPLOYEE_CELLPHONE` from `EMPLOYEE_LIST`";

            $result = mysqli_query($conn, $sql);

            $resultJson = array();

            if (! $result) {
                die('クエリ失敗 : ' . mysqli_error());
            }

            while ($row = mysqli_fetch_array($result)) {
                $resultRow = array();
                for ($i = 0; $i < count($columns); $i ++) {
                    $resultRow[$columns[$i]] = $row[$i];
                }
                // 現在行のデータを格納する。添字キーはプライマリキー
                $resultJson[$resultRow[$columnNameConst::EMPLOYEE_LIST_KEY]] = $resultRow;
            }
            return $resultJson;
        } catch (exception $e) {
            echo $e;
        } finally {
            $this->db_close($conn, $utilConst::DB_NAME);
        }
    }
}
