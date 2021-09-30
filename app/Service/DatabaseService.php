<?php

namespace App\Service;


use Illuminate\Support\Facades\DB;
use PDO;

class DatabaseService
{


    /**
     * author: mtg
     * time: 2021/7/15   11:38
     * function description: 运行原生sql
     * @param string $sql
     * @return int
     */
    static public function sqlExecute(string $sql): array
    {
        $sqlContents   = explode(';', $sql);
        $db            = DB::connection();
        $successAmount = 0;
        $errorAmount   = 0;
        foreach ($sqlContents as $sql) {

            $sql = trim($sql);
            if (!$sql) {
                continue;
            }

            try {
                $db->getPdo()->exec($sql);
                $successAmount++;
            } catch (\Exception $e) {

                $errorAmount++;
                common_log(full_error_msg($e));
            }
        }
        return [$successAmount, $errorAmount];
    }

    /**
     * author: mtg
     * time: 2021/7/15   11:37
     * function description: 导出数据库指定表到sql文件中
     * @param string $tables
     * @param string $file
     */
    public static function exportDatabase($tables = '*', $file = "")
    {


        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        $connection = new PDO('mysql:host=' . config('database.connections.mysql.host') . ';dbname=' . config('database.connections.mysql.database') . ';charset=utf8', config('database.connections.mysql.username'), config('database.connections.mysql.password'), $opt);


        if ($file == "") {
            $file = storage_path('migration/data.sql');
        }

        if (file_exists($file)) {
            unlink($file);
        }

        $data = "";

        //get all of the tables
        if ($tables == '*') {
            $tables        = array();
            $tableInstance = $connection->prepare('SHOW TABLES');
            $tableInstance->execute();
            while ($row = $tableInstance->fetch(PDO::FETCH_NUM)) {
                $tables[] = $row[0];
            }

        } else {
            $tables = is_array($tables) ? $tables : explode(',', $tables);
        }


        foreach ($tables as $table) {
            $recordAmountInstance = $connection->prepare('SELECT count(*) FROM ' . $table);
            $recordAmountInstance->execute();
            $recordAmount = $recordAmountInstance->fetch(PDO::FETCH_NUM);
            $recordAmount = $recordAmount[0];


            $recordInstance = $connection->prepare('SELECT * FROM ' . $table);
            $recordInstance->execute();

            $data .= 'DROP TABLE ' . $table . ';';

            $tableStructureInstance = $connection->prepare('SHOW CREATE TABLE ' . $table);
            $tableStructureInstance->execute();

            $tableStructure = $tableStructureInstance->fetch(PDO::FETCH_NUM);

            $data .= "\n\n" . $tableStructure[1] . ";\n\n";


            for ($i = 0; $i < $recordAmount; $i++) {

                while ($row = $recordInstance->fetch(PDO::FETCH_NUM)) {

                    $data .= 'INSERT INTO ' . $table . ' VALUES(';

                    $fieldAmount = count($row);
                    for ($j = 0; $j < $fieldAmount; $j++) {


                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n", "\\n", $row[$j]);
                        if (isset($row[$j])) {
                            $data .= "'" . $row[$j] . "'";
                        } else {
                            $data .= "''";
                        }
                        if ($j < ($fieldAmount - 1)) {
                            $data .= ',';
                        }
                    }
                    $data .= ");\n";
                }
            }
            $data .= "\n\n\n";

            self::writeFile($file, $data);
            force_notify(sprintf('%s导出完成', $table));

        }


        $connection = null;
    }


    public static function writeFile($file, $content)
    {  /* save as utf8 encoding */

        if (!is_file($file)) {
            FileService::createFile($file);
        }

        $f = fopen($file, "w+");
        # Now UTF-8 - Add byte order mark
//        fwrite($f, pack("CCC", 0xef, 0xbb, 0xbf));
        fwrite($f, $content);
        fclose($f);

    }
}
