<?php

class mssql_odbc
{

    function __construct ()
    {
        $this->CI = &get_instance();
        $this->server = "122.224.170.165";
        $this->user = "K3connet";
        $this->pwd = "K3connet112233";
        $this->database = "yccy";
        $this->port = "1433";
    }

    function connect ()
    {
        
        if (PATH_SEPARATOR == ':') {
            // linux
            $ms_connect = mssql_connect($this->server . ":" . $this->port, $this->user, $this->pwd) or die("Couldn't connect to SQL Server on " . $this->server);
            $ms_select = mssql_select_db($this->database, $ms_connect) or die("Couldn't open database " . $this->database);
            return $ms_select;
        } else {
             // xp
             $connstr = "Driver={SQL Server};Server=$this->server;Database=$this->database";
             $connid = odbc_connect($connstr, $this->user,  $this->pwd, SQL_CUR_USE_ODBC);
             if (! $connid) {
                  echo "Couldn't connect to SQL Server on $this->server";
             } else {
                  return $connid;
             }
        }
    }

    function query ($sql){
        if (PATH_SEPARATOR == ':') {
             // linux
             $this->connect();
             $res = mssql_query($sql);
             $i = 0;
             while ($row = mssql_fetch_array($res)) {
                  $result[$i] = $row;
                  $i ++;
             }
        } else {
             // xp
             $query = odbc_do($this->connect(), $sql);
             $i = 0;
             while ($row = odbc_fetch_array($query)) {
                    $result[$i] = $row;
                    $i ++;
             }
             odbc_close_all();
        }
        return $result;
   }

   function dosql ($sql){
        if (PATH_SEPARATOR == ':') {
             // linux
             mssql_query($sql);
             return true;
        } else {
             // xp
             $odbc_exec = odbc_exec($this->connect(), $sql);
             odbc_close_all();
             return $odbc_exec;
        }
   }
                
}
                
?>