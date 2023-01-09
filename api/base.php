<?php
session_start();
date_default_timezone_set("Asia/Taipei");
class DB
{
    protected $table;
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db15_2";
    protected $pdo;
    function __construct($table)
    {
        $this->pdo = new PDO($this->dsn, 'root', '');
        $this->table = $table;
    }

    private function arrayToSqlArray($array)
    {
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }
        return $tmp;
    }

    function mathSql($math, $col, ...$args)
    {
        $sql = "select $math($col) from $this->table";
        if (isset($args[0])) {
            if (is_array($args[0])) {
                $tmp = $this->arrayToSqlArray($args[0]);
                $sql .= " where " . join(" && ", $tmp);
            } else {
                $sql .= $args[0];
            }
        }
        if (isset($args[1])) {
            $sql .= $args[1];
        }
        return $sql;
    }

    function all(...$args)
    {
        $sql = "select * from $this->table";
        if (isset($args[0])) {
            if (is_array($args[0])) {
                $tmp = $this->arrayToSqlArray($args[0]);
                $sql .= " where " . join(" && ", $tmp);
            } else {
                $sql .= $args[0];
            }
        }
        if (isset($args[1])) {
            $sql .= $args[1];
        }
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function find($id)
    {
        $sql = "select * from $this->table";
        if (is_array($id)) {
            $tmp = $this->arrayToSqlArray($id);
            $sql .= " where " . join(" && ", $tmp);
        } else {
            $sql .= " where `id` =$id";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    function del($id)
    {
        $sql = "delete from $this->table";
        if (is_array($id)) {
            $tmp = $this->arrayToSqlArray($id);
            $sql .= " where " . join(" && ", $tmp);
        } else {
            $sql .= " where `id` =$id";
        }
        return $this->pdo->exec($sql);
    }
    function save($array)
    {
        if (isset($array['id'])) {
            $id = $array['id'];
            unset($array['id']);
            $tmp = $this->arrayToSqlArray($array);
            $sql = "update $this->table set ";
            $sql .= join(",", $tmp);
            $sql .= " where `id` =$id";
        } else {
            $cols = array_keys($array);
            $sql = "insert into $this->table (`" . join("`,`", $cols) . "`)
            values ('" . join("','", $array) . "')";
        }
        return $this->pdo->exec($sql);
    }

    function count(...$arg)
    {
        $sql = $this->mathSql("count", "*", ...$arg);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function min($col, ...$arg)
    {
        $sql = $this->mathSql("min", $col, ...$arg);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function max($col, ...$arg)
    {
        $sql = $this->mathSql("max", $col, ...$arg);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function sum($col, ...$arg)
    {
        $sql = $this->mathSql("sum", $col, ...$arg);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function avg($col, ...$arg)
    {
        $sql = $this->mathSql("avg", $col, ...$arg);
        return $this->pdo->query($sql)->fetchColumn();
    }
}

//這裡是第二題 :
$Bottom=new DB('bottom');
$User=new DB('user');
$admin=new DB('admin');
$Total=new DB('total');


function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
function to($url){
   header("location:".$url);
}
function q($sql){
    $pdo =  new PDO("mysql:host=localhost;charset=utf8;dbname=db15_2",'root','');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
//今日瀏覽人氣 :
if(!isset($_SESSION['total'])){
    $today=$Total->find(['date'=>date("Y-m-d")]);//看今天有無符合資料庫的資料
    // echo "total=";
    // dd($today); 
    if(empty($today)){
        $today=['date'=>date("Y-m-d"),'total'=>1];
        //如果沒有 寫入date()與total+1 資料庫
        //$Total->$save(['date'=>date("Y-m-d"),'total'=>1]);
    }else{
        $today['total']++;//如果有把 total +1 寫入 :
    }
    $Total->save($today);
    $_SESSION['total']=1;
}
