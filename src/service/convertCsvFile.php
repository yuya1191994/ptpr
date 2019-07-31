<?php

class ConvertCsvData
{

    public function convertColumnData(string $currentColumnHeader, string $currentColumnData)
    {
        switch ($currentColumnHeader) {
            case '現況':
                switch ($currentColumnData) {
                    case '1':
                        $currentColumnData = '居住中';
                        break;
                    case '2':
                        $currentColumnData = '空室';
                        break;
                    case '3':
                        $currentColumnData = '-';
                        break;
                    case '4':
                        $currentColumnData = '未完成物件';
                        break;
                }
                return $currentColumnData;

            case '入居旬':
                switch ($currentColumnData) {
                    case '1':
                        $currentColumnData = '上旬';
                        break;
                    case '2':
                        $currentColumnData = '中旬';
                        break;
                    case '3':
                        $currentColumnData = '下旬';
                        break;
                }
                return $currentColumnData;

            case '入居時期':
                switch ($currentColumnData) {
                    case '1':
                        $currentColumnData = '即';
                        break;
                    default:
                        $currentColumnData = '';
                }
                return $currentColumnData;

            case '間取タイプ（1）':
                switch ($currentColumnData) {
                    case '1':
                        $currentColumnData = 'R';
                        break;
                    case '2':
                        $currentColumnData = 'K';
                        break;
                    case '3':
                        $currentColumnData = 'DK';
                        break;
                    case '4':
                        $currentColumnData = 'LK';
                        break;
                    case '5':
                        $currentColumnData = 'LDK';
                        break;
                    case '6':
                        $currentColumnData = 'SK';
                        break;
                    case '7':
                        $currentColumnData = 'SDK';
                        break;
                    case '8':
                        $currentColumnData = 'SLK';
                        break;
                    case '9':
                        $currentColumnData = 'SLDK';
                        break;
                }
                return $currentColumnData;

            case '建物構造':
                switch ($currentColumnData) {
                    case '1':
                        $currentColumnData = '木造';
                        break;
                    case '2':
                        $currentColumnData = '';
                        break;
                    case '3':
                        $currentColumnData = '鉄骨';
                        break;
                    case '4':
                        $currentColumnData = 'RC';
                        break;
                    case '5':
                        $currentColumnData = 'SRC';
                        break;
                    case '6':
                        $currentColumnData = '';
                        break;
                    case '7':
                        $currentColumnData = '';
                        break;
                    case '8':
                        $currentColumnData = '軽量鉄骨';
                        break;
                    case '9':
                        $currentColumnData = 'ALC';
                        break;
                }
                return $currentColumnData;

            default:
                return $currentColumnData;
        }
    }
}
?>