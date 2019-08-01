<?php

class ConnectDatabase
{

//     const HN = "mysql1014.db.sakura.ne.jp";
//     const UN = "jokyo";
//     const PW = "stage0000";

    const HN = "localhost";
    const UN = "root";
    const PW = "dev";

    public function db_connect(string $dbName)
    {
        $conn = @mysqli_connect($this::HN, $this::UN, $this::PW, $dbName);
        if (mysqli_connect_errno()) {
            die('データベースに接続できませんでした : ' . mysqli_connect_error());
        }
        // ユーザーに相違があった場合
        if (!$conn) {
            echo mysqli_connect_errno($conn) . " : " . mysqli_connect_errou($conn) . "\n";
        }
        if (!mysqli_set_charset($conn, 'utf8')) {
            die ('指定した文字コードは使用できません。'.mysqli_error($conn));
        }
        return $conn;
    }

    public function db_close($conn, string $dbName)
    {
        $conn = mysqli_connect($this::HN, $this::UN, $this::PW, $dbName);

        mysqli_close($conn);
        if (mysqli_connect_errno()) {
            die('データベースを切断できませんでした : ' . mysqli_connect_error());
        }
    }
}